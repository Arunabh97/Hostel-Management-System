<?php

include 'db.php';

$roomId = "";
$row = array();

if (isset($_GET['id'])) {
    $roomId = $_GET['id'];

    $sql = "SELECT * FROM rooms WHERE roomId = '$roomId'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $roomNumber = $_POST['roomNumber'];
            $capacity = $_POST['capacity'];
            $price = $_POST['price'];

            $sql = "UPDATE rooms SET roomNumber = '$roomNumber', capacity = '$capacity', price = '$price' WHERE roomId = '$roomId'";
            if ($conn->query($sql) === TRUE) {

                header("Location: manage_room.php");
                exit();
            } else {

                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    } else {

        echo "Room not found.";
    }
} else {

    echo "Room ID not provided.";
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Room</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 4px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .card {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .card label {
            display: block;
            margin-bottom: 10px;
            font-weight: normal;
            color: #333;
        }

        .card input[type="text"],
        .card input[type="email"],
        .card input[type="password"],
        .card select {
            width: 95%;
            padding: 10px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            background-color: #f9f9f9;
            box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .card input[type="text"]:focus,
        .card input[type="email"]:focus,
        .card input[type="password"]:focus,
        .card select:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.7);
        }

        .card input[type="submit"],
        .card input[type="reset"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }

        .card input[type="submit"]:hover,
        .card input[type="reset"]:hover {
            background-color: #45a049;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"] {
            width: 95%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            display: block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            margin-top: 10px;
            transition: background-color 0.3s;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .back-button {
            display: inline-block;
            background-color: #337ab7;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            margin-top: 10px;
            margin-right: 5px;
            transition: background-color 0.3s;
            float: right;
        }

        .back-button:hover {
            background-color: #286090;
        }
        .form-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .form-actions input[type="submit"],
    .form-actions a.back-button {
        margin-right: 5px;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 4px;
        text-align: center;
    }

    .form-actions a.back-button {
        background-color: #337ab7;
        color: white;
        transition: background-color 0.3s;
        float: right;
    }

    .form-actions a.back-button:hover {
        background-color: #286090;
    }
    </style>
</head>
<body>
    <h2><i class="fas fa-edit"></i> Edit Room</h2>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $roomId; ?>">
        <div class="form-container">
            <div class="form-group">
                <div class="card">
                    <label for="roomNumber"><i class="fas fa-door-closed"></i> Room Number:</label>
                    <input type="text" name="roomNumber" value="<?php echo $row['roomNumber']; ?>" required placeholder="Enter room number">
                </div>
            </div>

            <div class="form-group">
                <div class="card">
                    <label for="capacity"><i class="fas fa-users"></i> Capacity:</label>
                    <input type="number" name="capacity" value="<?php echo $row['capacity']; ?>" required placeholder="Enter capacity">
                </div>
            </div>

            <div class="form-group">
                <div class="card">
                    <label for="price"><i class="fas fa-dollar-sign"></i> Price:</label>
                    <input type="text" name="price" value="<?php echo $row['price']; ?>" required placeholder="Enter price">
                </div>
            </div>

            <div class="form-actions">
                <input type="submit" value="Update Room">
                <a class="back-button" href="manage_room.php"><i class="fas fa-arrow-left"></i> Back to Manage Room</a>
            </div>
        </div>
            
        </form>
    </div>
</body>
</html>
