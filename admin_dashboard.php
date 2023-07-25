<?php

include 'db.php';

$sql = "SELECT * FROM student";
$result = $conn->query($sql);

$studentCount = $result->num_rows;

$sql = "SELECT COUNT(*) AS hostelCount FROM hostel";
$result = $conn->query($sql);

$row = $result->fetch_assoc();
$hostelCount = $row['hostelCount'];

$sql = "SELECT COUNT(*) AS totalRooms FROM rooms";
$result = $conn->query($sql);

$row = $result->fetch_assoc();
$totalRooms = $row['totalRooms'];

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - Hostel Management System</title>
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
        max-width: 1600px;
        min-height: 600px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .main {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center; 
        text-align: center;
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        margin-left:10px;
    }

    .dashboard-home {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        margin-top: 20px;
    }


    h1 {
            margin: 0;
            padding-bottom: 10px;
            border-bottom: 1px solid #ccc;
            text-align: center;
            color: #d40f2c;
    }

    .welcome {
            text-align: center;
            margin-bottom: 20px;
            padding-top: 20px;
    }

    .logout {
            color: #4CAF50;
            text-decoration: none;
    }

    .logout:hover {
            text-decoration: underline;
    }

    .content {
            display: flex;
            justify-content: space-between;
    }

    .sidebar {
            max-width: 1300px;
            min-height: 600px;
        padding: 10px;
        background-color: #f0f0f0;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        overflow: hidden; /* Add this to hide overflowing content */
    }

    .sidebar ul {
        list-style: none;
        padding: 0;
    }

    .sidebar li {
        margin-bottom: 10px;
    }

    .sidebar a {
        position: relative;
        overflow: hidden;
        color: #333;
        display: flex;
        align-items: center;
        padding: 10px;
        border-radius: 5px;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .sidebar a:hover {
        background-color: #4CAF50;
        color: #fff;
        transform: scale(1.1);
    }

    .sidebar a::before {
        content: "";
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.1);
        transition: left 0.3s ease;
    }

    .sidebar a:hover::before {
        left: 0;
    }

    .sidebar a .icon {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 30px;
        height: 30px;
        margin-right: 10px;
        border-radius: 50%;
        background-color: #4CAF50;
        color: #fff;
        transition: transform 0.3s ease;
    }

    .sidebar a:hover .icon {
        transform: rotate(360deg) scale(1.2);
    }

    .sidebar a.register {
        background-color: #2196F3;
    }

    .sidebar a.manage {
        background-color: #FF9800;
    }

    .sidebar a.book {
        background-color: #9C27B0;
    }

    .sidebar a.hostel {
        background-color: #E91E63;
    }

    .sidebar a.manage-room {
        background-color: #607D8B;
    }

    .sidebar h3 {
        margin-bottom: 10px;
        color: #4CAF50;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 16px;
    }

    .sidebar a .icon {
        font-size: 20px;
    }

    .sidebar a:hover .icon {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    }

    .sidebar a::after {
        content: "";
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.1);
        animation: slideInLeft 0.3s forwards;
    }

    @keyframes slideInLeft {
        100% {
            left: 0;
        }
    }

    .sidebar a:hover::after {
        animation: slideInRight 0.3s forwards;
    }

    @keyframes slideInRight {
        100% {
            left: 100%;
        }
    }
        .card {
            padding: 20px;
            background-color: #f0f0f0;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card h4 {
            margin-top: 0;
            color: #333;
        }

        .card p {
            margin-bottom: 0;
            font-size: 24px;
            color: #666;
        }

        .card-icon {
            font-size: 60px;
            margin-right: 20px;
        }

        .dashboard-home {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .dashboard-item {
            width: 300px;
            margin: 10px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .dashboard-item::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: linear-gradient(to bottom, #4CAF50, #45A25D);
            opacity: 0.8;
            z-index: -1;
            transition: opacity 0.3s ease;
        }

        .dashboard-item:hover::before {
            opacity: 1;
        }

        .dashboard-item h3 {
            margin-top: 0;
            margin-bottom: 10px;
            color: #fff;
            text-align: center;
            font-size: 24px;
            text-transform: uppercase;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        .dashboard-item p {
            margin-bottom: 0;
            font-size: 18px;
            color: #fff;
            text-align: center;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

            .card-icon {
            font-size: 60px;
            margin-bottom: 20px;
            color: #fff;
        }

        .dashboard-home {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .dashboard-item:nth-child(odd) {
            background-color: #4CAF50;
        }

        .dashboard-item:nth-child(even) {
            background-color: #45A25D;
        }

        .dashboard-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .admin-icon {
            position: relative;
            display: inline-block;
            cursor: pointer;
            float:right;
        }

        .dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            z-index: 1;
            display: none;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .admin-icon:hover .dropdown {
                display: block;
        }

        .dropdown ul {
                list-style: none;
                margin: 0;
                padding: 0;
        }

        .dropdown li {
                padding: 10px;
        }

        .dropdown li a {
                display: block;
                text-decoration: none;
                color: #333;
        }

        .dropdown li a:hover {
                background-color: #f0f0f0;
        }

    </style>
</head>
<body>
    <div class="container">
    <h1><center><i class="fas fa-home"></i> HOSTEL MANAGEMENT SYSTEM</center></h1>

        
            <h2><center>Welcome, Admin!<center></h2>
            <div class="welcome">
    <div class="admin-icon">Admin
        <i class="fas fa-user"></i>
        <div class="dropdown">
            <ul>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</div>

        <div class="content">
            <div class="sidebar">
                <h3>Dashboard</h3>
                <ul>
  
                <li><a href="register_student.php" class="register"><i class="fas fa-user-graduate"></i> Register Student</a></li>
                <li><a href="manage_students.php" class="manage"><i class="fas fa-users"></i> Manage Students</a></li>
                <li><a href="book_hostel.php" class="book"><i class="fas fa-building"></i> Book Hostel</a></li>
                <li><a href="manage_hostel_students.php" class="hostel"><i class="fas fa-user-friends"></i> Hostel Students</a></li>
                <li><a href="manage_room.php" class="manage-room"><i class="fas fa-bed"></i> Manage Rooms</a></li>

                </ul>
            </div>
            <div class="main">
            <h1><center>Admin Dashboard Home</center></h1>
    <div class="dashboard-home">
        <div class="dashboard-item">
            <h3>Registered Students</h3>
            <div class="card-icon"><i class="fas fa-user-graduate"></i></div>
            <p><?php echo $studentCount; ?></p>
        </div>
        <div class="dashboard-item">
            <h3>Hostel Bookings</h3>
            <div class="card-icon"><i class="fas fa-hotel"></i></div>
            <p><?php echo $hostelCount; ?></p>
        </div>
        <div class="dashboard-item">
            <h3>Total Rooms</h3>
            <div class="card-icon"><i class="fas fa-bed"></i></div>
            <p><?php echo $totalRooms; ?></p>
        </div>
    </div>
            </div>
        </div>
    </div>
    <footer>
        <?php include 'footer.php'; ?>
    </footer>
</body>
</html>
