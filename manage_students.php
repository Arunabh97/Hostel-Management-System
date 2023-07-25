<!DOCTYPE html>
<html>
<head>
    <title>Manage Students</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>

        body {
            font-family: 'Roboto', Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }

        .container {
            width: 1600px;
            margin: 0 auto;
        }

        h2 {
            color: #4CAF50;
            margin-bottom: 20px;
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 4px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background-color: #f2f2f2;
            color: #666;
            font-weight: bold;
        }

        td {
            color: #333;
        }

        .edit-button,
        .delete-button,
        .add-button {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            margin-right: 5px;
            transition: background-color 0.3s;
        }

        .edit-button:hover,
        .delete-button:hover,
        .add-button:hover {
            background-color: #45a049;
        }

        .no-rooms {
            color: #888;
            text-align: center;
            margin-top: 20px;
        }

        .dashboard-button {
            display: inline-block;
            background-color: #337ab7;
            color: white;
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            margin-right: 5px;
            transition: background-color 0.3s;
            float: right;
        }

        .dashboard-button:hover {
            background-color: #286090;
        }

        .search-form {
            text-align: left;
            margin-bottom: 20px;
        }

        .search-input {
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
            width: 300px;
        }

        .success-message {
            color: #fff;
            background-color: #4CAF50;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
        }

        .error-message {
            color: #fff;
            background-color: #f44336;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2><i class="fas fa-users"></i> MANAGE STUDENTS</h2>
        <a class="dashboard-button" href="admin_dashboard.php">Back to Dashboard</a>
        <div class="search-form">
            <input type="text" class="search-input" id="searchInput" placeholder="Search by Registration Number, Name, Course..." autocomplete="off">
        </div>
        <table>
            <tr>
                <th><i class="fas fa-id-card"></i> Registration Number</th>
                <th><i class="fas fa-user"></i> Name</th>
                <th><i class="fas fa-venus-mars"></i> Gender</th>
                <th><i class="fas fa-book"></i> Course</th>
                <th><i class="fas fa-phone"></i> Contact Number</th>
                <th><i class="fas fa-envelope"></i> Email ID</th>
                <th><i class="fas fa-cog"></i> Action</th>
            </tr>
            
            <?php
            
            include 'db.php';

            $sql = "SELECT * FROM student";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                
                while ($row = $result->fetch_assoc()) {
                    $regNo = $row['regNo'];
                    $firstName = $row['firstName'];
                    $lastName = $row['lastName'];
                    $gender = $row['gender'];
                    $course = $row['course'];
                    $contact = $row['contact'];
                    $email = $row['email'];

                    echo '<tr>';
                    echo '<td>' . $regNo . '</td>';
                    echo '<td>' . $firstName . ' ' . $lastName . '</td>';
                    echo '<td>' . $gender . '</td>';
                    echo '<td>' . $course . '</td>';
                    echo '<td>' . $contact . '</td>';
                    echo '<td>' . $email . '</td>';
                    echo '<td>';
                    echo '<a href="edit_student.php?regNo=' . $regNo . '" class="edit-button"><i class="fas fa-edit"></i> Edit</a>';
                    echo '<a href="delete_student.php?regNo=' . $regNo . '" class="delete-button"><i class="fas fa-trash"></i> Delete</a>';
                    echo '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="7">No students found.</td></tr>';
            }

            $conn->close();
            ?>
        </table>
    </div>

    <script>

        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const table = document.querySelector('table');

            searchInput.addEventListener('input', handleSearch);

            function handleSearch() {
                const searchKeyword = searchInput.value.toLowerCase();
                const rows = table.getElementsByTagName('tr');

                for (let i = 1; i < rows.length; i++) {
                    const cells = rows[i].getElementsByTagName('td');
                    let foundMatch = false;

                    for (let j = 0; j < cells.length; j++) {
                        const cellText = cells[j].textContent.toLowerCase();

                        if (cellText.includes(searchKeyword)) {
                            foundMatch = true;
                            break;
                        }
                    }

                    if (foundMatch) {
                        rows[i].style.display = '';
                    } else {
                        rows[i].style.display = 'none';
                    }
                }
            }
        });
    </script>
</body>
</html>
