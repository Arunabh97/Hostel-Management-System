<?php

    include 'check_login.php';

    if (!isset($_SESSION['regNo'])) {
        header("Location: student_login.php");
        exit;
    }

    include 'db.php';

    $regNo = $_SESSION['regNo'];
    $query = "SELECT * FROM hostel WHERE regNo = '$regNo'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Room Details - Hostel Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap">
    <style>

        body {
            font-family: 'Roboto', Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .header h1 {
            color: #333;
            margin: 0;
            padding: 0;
            font-size: 36px;
            letter-spacing: 2px;
        }

        .cards-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
        }

        .card h4 {
            margin: 0;
            color: #333;
            font-size: 20px;
            letter-spacing: 1px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .card p {
            margin: 0;
            font-size: 28px;
            color: #666;
            font-weight: bold;
            line-height: 1.2;
        }

        .card-icon {
            font-size: 50px;
            margin-bottom: 20px;
            color: #333;
        }

        .back-btn {
            text-align: center;
            margin-top: 30px;
        }

        .back-btn a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .back-btn a:hover {
            background-color: #555;
        }

        .print-btn {
            text-align: center;
            margin-top: 10px;
        }

        .print-btn a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .print-btn a:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>ROOM DETAILS</h1>
        </div>
        <div class="cards-container">
            <div class="card">
                <i class="fas fa-building card-icon"></i>
                <h4>Hostel ID</h4>
                <p><?php echo $row['hostelId']; ?></p>
            </div>
            <div class="card">
                <i class="fas fa-user card-icon"></i>
                <h4>Registration Number</h4>
                <p><?php echo $row['regNo']; ?></p>
            </div>
            <div class="card">
                <i class="fas fa-user card-icon"></i>
                <h4>Name</h4>
                <p><?php echo $row['firstName'] . ' ' . $row['lastName']; ?></p>
            </div>
            <div class="card">
                <i class="fas fa-venus-mars card-icon"></i>
                <h4>Gender</h4>
                <p><?php echo $row['gender']; ?></p>
            </div>
            <div class="card">
                <i class="fas fa-graduation-cap card-icon"></i>
                <h4>Course</h4>
                <p><?php echo $row['course']; ?></p>
            </div>
            <div class="card">
                <i class="fas fa-phone card-icon"></i>
                <h4>Contact</h4>
                <p><?php echo $row['contact']; ?></p>
            </div>
            <div class="card">
                <i class="fas fa-envelope card-icon"></i>
                <h4>Email</h4>
                <p><?php echo $row['email']; ?></p>
            </div>
            <div class="card">
                <i class="fas fa-bed card-icon"></i>
                <h4>Room Number</h4>
                <p><?php echo $row['roomNumber']; ?></p>
            </div>
            <div class="card">
                <i class="fas fa-users card-icon"></i>
                <h4>Capacity</h4>
                <p><?php echo $row['capacity']; ?></p>
            </div>
            <div class="card">
                <i class="fas fa-dollar-sign card-icon"></i>
                <h4>Total Price</h4>
                <p><?php echo $row['totalPrice']; ?></p>
            </div>
            <div class="card">
                <i class="fas fa-calendar-alt card-icon"></i>
                <h4>Booking Date</h4>
                <p><?php echo $row['bookingDate']; ?></p>
            </div>
            <div class="card">
                <i class="fas fa-clock card-icon"></i>
                <h4>Duration (months)</h4>
                <p><?php echo $row['duration']; ?></p>
            </div>
        </div>
        <div class="back-btn">
            <a href="student_dashboard.php">Back to Dashboard</a>
        </div>
        <div class="print-btn">
            <a href="print.php">Print Details</a>
        </div>
    </div>
</body>
</html>



<?php
    } else {
        echo "<h1>Error: Room details not found!</h1>";
    }

    mysqli_close($conn);
?>
