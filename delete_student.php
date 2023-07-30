<!DOCTYPE html>
<html>
<head>
    <title>Delete Student</title>
    <style>
                body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .modal-container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .modal {
            display: none;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            animation: fadeInScaleUp 0.3s ease;
            max-width: 400px;
        }

        .modal-content {
            padding: 30px;
        }

        .modal h2 {
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .modal p {
            margin: 0 0 20px;
            font-size: 16px;
            color: #555;
        }

        .modal-buttons {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }

        .modal button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-left: 10px;
            transition: background-color 0.3s ease;
        }

        .modal button.delete {
            background-color: #e74c3c;
            color: #fff;
        }

        .modal button.cancel {
            background-color: #3498db;
            color: #fff;
        }

        .student-info {
            font-size: 18px;
            margin-bottom: 20px;
            color: #333;
        }

        @keyframes fadeInScaleUp {
            0% {
                opacity: 0;
                transform: scale(0.8);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

    </style>
</head>

<body>
    <?php
    if (isset($_GET['regNo'])) {
        $regNo = $_GET['regNo'];

        if (isset($_GET['confirm'])) {
            if ($_GET['confirm'] === 'yes') {
                include 'db.php';

                $sql = "DELETE FROM student WHERE regNo = '$regNo'";

                if ($conn->query($sql) === TRUE) {
                    // Student deleted successfully
                    echo '
                        <div class="modal-container">
                            <div class="modal" id="successModal">
                                <div class="modal-content">
                                    <h2>Student Deleted</h2>
                                    <p>Student has been successfully deleted.</p>
                                    <div class="modal-buttons">
                                        <button class="cancel" onclick="redirectToManage()">OK</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            function redirectToManage() {
                                window.location.href = "manage_students.php";
                            }

                            var modal = document.getElementById("successModal");
                            modal.style.display = "block";
                        </script>
                    ';
                } else {
                    // Error deleting student
                    echo '
                        <div class="modal-container">
                            <div class="modal" id="errorModal">
                                <div class="modal-content">
                                    <h2>Error</h2>
                                    <p>Error deleting student: ' . $conn->error . '</p>
                                    <div class="modal-buttons">
                                        <button class="cancel" onclick="redirectToManage()">OK</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            function redirectToManage() {
                                window.location.href = "manage_students.php";
                            }

                            var modal = document.getElementById("errorModal");
                            modal.style.display = "block";
                        </script>
                    ';
                }

                $conn->close();
            } else {
                // User canceled the deletion
                echo '<script>window.location.href = "manage_students.php";</script>';
            }
        } else {
            include 'db.php';

            // Fetch student details from the database
            $sql = "SELECT regNo, firstName FROM student WHERE regNo = '$regNo'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $student = $result->fetch_assoc();
                $name = $student['firstName'];
                echo '
                    <div class="modal-container">
                        <div class="modal" id="confirmationModal">
                            <div class="modal-content">
                                <h2>Confirm Deletion</h2>
                                <p class="student-info">Student Name: ' . $name . '</p>
                                <p class="student-info">Registration Number: ' . $regNo . '</p>
                                <p>Are you sure you want to delete this student?</p>
                                <div class="modal-buttons">
                                    <button class="delete" onclick="deleteStudent()">Delete</button>
                                    <button class="cancel" onclick="cancel()">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        function deleteStudent() {
                            window.location.href = "delete_student.php?regNo=' . $regNo . '&confirm=yes";
                        }

                        function cancel() {
                            redirectToManage();
                        }

                        function redirectToManage() {
                            window.location.href = "manage_students.php";
                        }

                        var modal = document.getElementById("confirmationModal");
                        modal.style.display = "block";
                    </script>
                ';
            } else {
                // Student not found
                echo '<script>window.location.href = "manage_students.php";</script>';
            }

            $conn->close();
        }
    } else {
        // If no regNo provided
        echo '<script>window.location.href = "manage_students.php";</script>';
    }
    ?>
</body>

</html>
