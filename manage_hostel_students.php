<!DOCTYPE html>
<html>
<head>
    <title>Manage Hostel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            width: 1800px; 
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

        .edit-button, .delete-button ,.add-button{
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

        .edit-button:hover, .delete-button:hover .add-button:hover{
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
            float:right;
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
        <h2><i class="fas fa-users"></i> MANAGE HOSTEL STUDENTS</h2><br>
        <a class="dashboard-button" href="admin_dashboard.php"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
        <div class="search-form">
            <input type="text" class="search-input" id="searchInput" placeholder="Search by Registration Number, Name, Course..." autocomplete="off">
        </div>
        
        <?php
    
        include 'db.php';

        $sql = "SELECT * FROM hostel";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
           
            echo '<table>';
            echo '<tr>';
            echo '<th><i class="fas fa-id-card"></i> HostelId</th>';
            echo '<th><i class="fas fa-id-badge"></i> Registration Number</th>';
            echo '<th><i class="fas fa-user"></i> Name</th>';
            echo '<th><i class="fas fa-venus-mars"></i> Gender</th>';
            echo '<th><i class="fas fa-book"></i> Course</th>';
            echo '<th><i class="fas fa-phone"></i> Contact</th>';
            echo '<th><i class="fas fa-envelope"></i> Email</th>';
            echo '<th><i class="fas fa-door-open"></i> RoomNumber</th>';
            echo '<th><i class="fas fa-users"></i> Capacity</th>';
            echo '<th><i class="fas fa-dollar-sign"></i> Price</th>';
            echo '<th><i class="fas fa-calendar-alt"></i> Booking Date</th>';
            echo '<th><i class="fas fa-clock"></i> Duration (months)</th>';
            echo '<th><i class="fas fa-cog"></i> Actions</th>';
            echo '</tr>';

            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['hostelId'] . '</td>';
                echo '<td>' . $row['regNo'] . '</td>';
                echo '<td>' . $row['firstName'] . ' ' . $row['lastName'] . '</td>';
                echo '<td>' . $row['gender'] . '</td>';
                echo '<td>' . $row['course'] . '</td>';
                echo '<td>' . $row['contact'] . '</td>';
                echo '<td>' . $row['email'] . '</td>';
                echo '<td>' . $row['roomNumber'] . '</td>';
                echo '<td>' . $row['capacity'] . '</td>';
                echo '<td>' . $row['totalPrice'] . '</td>';
                echo '<th>' . $row['bookingDate'] . '</th>';
                echo '<th>' . $row['duration'] . '</th>';
                echo '<td>';
                echo '<a class="edit-button" href="edit_hostel.php?hostelId=' . $row['hostelId'] . '"><i class="fas fa-edit"></i> Edit</a>';
                echo '<a class="delete-button" href="delete_hostel.php?hostelId=' . $row['hostelId'] . '"><i class="fas fa-trash"></i> Delete</a>';
                echo '</td>';
                echo '</tr>';
            }

            echo '</table>';
        } else {
            echo 'No hostel bookings found.';
        }

        $conn->close();
        ?>
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
