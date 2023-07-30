<!DOCTYPE html>
<html>
<head>
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
            max-width: 420px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 4px;
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

        .form-group {
            margin-bottom: 20px;
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
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 7px;
        }

        .submit-button {
            display: block;
            width: 100%;
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

        .submit-button:hover {
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
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #286090;
        }
        p{
            color:red;
        }
    </style>
    <title>Add New Room</title>
</head>
<body>
    <h2><i class="fas fa-plus-circle"></i> Add New Room</h2>
    <div class="form-container">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                

            <div class="form-group">
                <div class="card">
                    <label for="roomNumber"><i class="fas fa-door-closed"></i> Room Number:</label>
                    <input type="text" id="roomNumber" name="roomNumber" required placeholder="Enter room number">
                </div>
            </div>

            <div class="form-group">
                <div class="card">
                    <label for="capacity"><i class="fas fa-users"></i> Capacity:</label>
                    <input type="number" id="capacity" name="capacity" required placeholder="Enter capacity">
                </div>
            </div>

            <div class="form-group">
                <div class="card">
                    <label for="price"><i class="fas fa-dollar-sign"></i> Price:</label>
                    <input type="number" id="price" name="price" required placeholder="Enter price">
                </div>
            </div>

            <button class="submit-button" type="submit"><i class="fas fa-plus"></i> Add Room</button>
            <a class="back-button" href="manage_room.php"><i class="fas fa-arrow-left"></i> Back</a>
        </form>
    </div>

    <?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Generate Room ID dynamically using PHP (e.g., increment from the last room ID in the database)
    // Replace this example with your own method of generating the Room ID
    $lastRoomIdQuery = "SELECT MAX(roomId) AS maxRoomId FROM rooms";
    $result = $conn->query($lastRoomIdQuery);
    $row = $result->fetch_assoc();
    $lastRoomId = $row['maxRoomId'];
    $newRoomId = $lastRoomId + 1;

    // Retrieve other form data
    $roomNumber = $_POST['roomNumber'];
    $capacity = $_POST['capacity'];
    $price = $_POST['price'];

    // Insert the data into the database with the generated Room ID
    $sql = "INSERT INTO rooms (roomId, roomNumber, capacity, price) VALUES ('$newRoomId', '$roomNumber', '$capacity', '$price')";
    if ($conn->query($sql) === TRUE) {
        echo '<p><center>Room added successfully.</center></p>';
    } else {
        echo '<p>Error: ' . $conn->error . '</p>';
    }

    $conn->close();
}
?>
</body>
</html>
