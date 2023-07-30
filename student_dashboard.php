<?php
    
    include 'check_login.php';

    if (!isset($_SESSION['regNo'])) {
        header("Location: student_login.php");
        exit;
    }

    include 'db.php';

    $regNo = $_SESSION['regNo'];
    $query = "SELECT firstName FROM student WHERE regNo = '$regNo'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $studentName = $row['firstName'];
    } 
    else 
    {
        echo "<h1>Error: Student information not found!</h1>";
    }

    mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard - Hostel Management System</title>
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
        .main {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .dashboard-home {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 1px;
        }

        .container {
            max-width: 1600px;
            min-height: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
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
            overflow: hidden;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar li {
            margin-bottom: 10px;
        }

        .sidebar a {
            text-decoration: none;
            color: #333;
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #4CAF50;
            color: #fff;
        }

        .sidebar h3 {
            margin-bottom: 10px;
            color: #4CAF50;
        }

        /* Custom icons */
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
            transform: rotate(360deg);
        }

        /* Custom link styles */
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
            background-color: #f0f0f0;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .dashboard-item:hover {
            transform: scale(1.05);
        }

        .dashboard-item h3 {
            margin-top: 0;
            color: #333;
            text-align: center;
        }

        .dashboard-item p {
            margin-bottom: 0;
            font-size: 18px;
            color: #666;
            text-align: center;
        }

        .student-icon {
            position: relative;
            display: inline-block;
            cursor: pointer;
            float: right;
        }

        .dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            z-index: 1;
            display: none;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            /* Add animation properties */
            opacity: 0;
            transform: translateY(-10px);
            transition: opacity 0.3s ease, transform 0.3s ease;
            animation: fadeInDown 0.3s cubic-bezier(0.68, -0.55, 0.27, 1.55) both;
        }

        .student-icon:hover .dropdown {
            display: block;
            /* Add animation properties */
            opacity: 1;
            transform: translateY(0);
            animation: fadeInDown 0.3s cubic-bezier(0.68, -0.55, 0.27, 1.55) both;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Additional styles for a cool look */
        .student-icon {
            position: relative;
            display: inline-flex;
            align-items: center;
            cursor: pointer;
        }

        .student-icon .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #4CAF50;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 10px;
            color: #fff;
        }

        .student-icon .avatar i {
            font-size: 24px;
        }

        .dropdown ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .dropdown li {
            padding: 10px;
            border-bottom: 1px solid #f0f0f0;
        }

        .dropdown li:last-child {
            border-bottom: none;
        }

        .dropdown li a {
            text-decoration: none;
            color: #333;
            display: flex;
            align-items: center;
            transition: color 0.3s ease;
        }

        .dropdown li a i {
            margin-right: 10px;
        }

        .dropdown li a:hover {
            color: #4CAF50;
        }

        .about-us {
            margin-top: 20px;
            margin-left: 20px;
            height:200px;
            text-align: center;
            background-color: #f9f9f9;
            border-radius: 5px;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .about-us h2 {
            color: #333;
            margin-bottom: 10px;
        }

        .about-us p {
            color: #666;
            line-height: 1.6;
        }

    </style>
    <script>
        // This JavaScript code is optional and used to close the dropdown when clicking outside it
        document.addEventListener("click", function(event) {
            const dropdowns = document.querySelectorAll(".dropdown");
            dropdowns.forEach(function(dropdown) {
                if (!dropdown.contains(event.target)) {
                    dropdown.style.display = "none";
                }
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <h1><center><i class="fas fa-home"></i> HOSTEL MANAGEMENT SYSTEM</center></h1>

        
        <h2><center>Welcome, <?php echo "$studentName " ?>Have a Nice Day!<center></h2>
        <div class="welcome">
            <div class="student-icon">
                <?php echo $studentName; ?>
                <i class="fas fa-user-graduate"></i>
                <div class="dropdown">
                    <ul>
                        <li><a href="view_profile.php"><i class="fas fa-user-circle"></i> View Profile</a></li>
                        <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                    </ul>
                </div>
            </div>


            <div class="content">
                <div class="sidebar">
                    <h3>Dashboard</h3>
                    <ul>

                        <li><a href="book_hostel.php" class="register"><i class="fas fa-user-graduate"></i> Book Hostel</a></li>
                        <li><a href="room_details.php" class="manage"><i class="fas fa-users"></i> My Room Details</a></li>

                    </ul>
                </div>
                <div class="main">
                    <h1>Student Dashboard Home</h1>

                    <div class="dashboard-home">
                        <div class="about-us">
                            <h2>About Us</h2>
                            <p>Welcome to the Hostel Management System! This system is designed to provide easy management and access to hostel facilities for students. Through this system, you can book hostels, manage your room details, and more.</p>
                            <p>If you have any questions or need assistance, feel free to contact ARUNABH (7004396959).</p>
                        </div>
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
