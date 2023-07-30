<!DOCTYPE html>
<html>

<head>
    <title>Delete Hostel</title>
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
    include 'db.php';

    if (isset($_GET['hostelId'])) {
        $hostelId = $_GET['hostelId'];

        if (isset($_GET['confirm'])) {
            if ($_GET['confirm'] === 'yes') {
                $sql = "DELETE FROM hostel WHERE hostelId = '$hostelId'";
                if ($conn->query($sql) === TRUE) {
                    echo '
                        <div class="modal-container">
                            <div class="modal" id="successModal">
                                <div class="modal-content">
                                    <h2>Hostel Deleted</h2>
                                    <p>Hostel has been deleted successfully.</p>
                                    <div class="modal-buttons">
                                        <button class="cancel" onclick="redirectToManage()">OK</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            function redirectToManage() {
                                window.location.href = "manage_hostel_students.php";
                            }

                            var modal = document.getElementById("successModal");
                            modal.style.display = "block";
                        </script>
                    ';
                } else {
                    echo '
                        <div class="modal-container">
                            <div class="modal" id="errorModal">
                                <div class="modal-content">
                                    <h2>Error</h2>
                                    <p>There was an error deleting the hostel: ' . $conn->error . '</p>
                                    <div class="modal-buttons">
                                        <button class="cancel" onclick="redirectToManage()">OK</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            function redirectToManage() {
                                window.location.href = "manage_hostel_students.php";
                            }

                            var modal = document.getElementById("errorModal");
                            modal.style.display = "block";
                        </script>
                    ';
                }
            } else {
                echo '<script>window.location.href = "manage_hostel_students.php";</script>';
            }
        } else {
            $sql = "SELECT hostelId, regNo, firstName FROM hostel WHERE hostelId = '$hostelId'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $hostel = $result->fetch_assoc();
                $hostelId = $hostel['hostelId'];
                $regNo = $hostel['regNo'];
                $name = $hostel['firstName'];
                echo '
                    <div class="modal-container">
                        <div class="modal" id="confirmationModal">
                            <div class="modal-content">
                                <h2>Confirm Deletion</h2>
                                <p class="student-info">Hostel ID: ' . $hostelId . '</p>
                                <p class="student-info">Registration Number: ' . $regNo . '</p>
                                <p class="student-info">Name: ' . $name . '</p>
                                <p>Are you sure you want to delete this hostel?</p>
                                <div class="modal-buttons">
                                    <button class="delete" onclick="deleteHostel()">Delete</button>
                                    <button class="cancel" onclick="cancel()">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        function deleteHostel() {
                            window.location.href = "delete_hostel.php?hostelId=' . $hostelId . '&confirm=yes";
                        }

                        function cancel() {
                            window.location.href = "manage_hostel_students.php";
                        }

                        var modal = document.getElementById("confirmationModal");
                        modal.style.display = "block";
                    </script>
                ';
            } else {
                echo '<script>alert("Hostel not found."); window.location.href = "manage_hostel_students.php";</script>';
            }
        }
    } else {
        echo '<script>window.location.href = "manage_hostel_students.php";</script>';
    }

    $conn->close();
    ?>
</body>


</html>
