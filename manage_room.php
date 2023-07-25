<!DOCTYPE html>
<html>
<head>
    <title>Room Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            width: 1500px; 
            margin: 0 auto; 
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }
        h1{
            color: #4CAF50;
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
    </style>
</head>
<body>
    <div class="container">
        <h1><center><i class="fas fa-door-open"></i> ROOM MANAGEMENT</center></h1><br>
        <a class="add-button" href="add_room.php"><i class="fas fa-plus-circle"></i> Add New Room</a>
        <a class="dashboard-button" href="admin_dashboard.php"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
        <br><br>

        <?php

        include 'db.php';

        $sql = "SELECT * FROM rooms";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<table>';
            echo '<tr>
                    <th><i class="fas fa-id-badge"></i> Room ID</th>
                    <th><i class="fas fa-door-closed"></i> Room Number</th>
                    <th><i class="fas fa-users"></i> Capacity</th>
                    <th><i class="fas fa-dollar-sign"></i> Price</th>
                    <th><i class="fas fa-cogs"></i> Actions</th>
                  </tr>';

            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['roomId'] . '</td>';
                echo '<td>' . $row['roomNumber'] . '</td>';
                echo '<td>' . $row['capacity'] . '</td>';
                echo '<td>' . $row['price'] . '</td>';
                echo '<td>
                        <a class="edit-button" href="edit_room.php?id=' . $row['roomId'] . '"><i class="fas fa-edit"></i> Edit</a>
                        <a class="delete-button" href="delete_room.php?id=' . $row['roomId'] . '"><i class="fas fa-trash-alt"></i> Delete</a>
                      </td>';
                echo '</tr>';
            }

            echo '</table>';
        } else {
            echo '<p class="no-rooms"><i class="fas fa-exclamation-circle"></i> No rooms found.</p>';
        }

        $conn->close();
        ?>
    </div>
</body>
</html>