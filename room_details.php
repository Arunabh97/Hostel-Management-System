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
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 80%;
            max-width: 900px;
        }

        .heading {
            text-align: center;
            margin-bottom: 20px;
        }

        .heading h1 {
            font-size: 48px;
            letter-spacing: 2px;
            color: #007bff;
            background: linear-gradient(45deg, #007bff, #00cccc);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .card {
            width: 200px;
            height: 190px;
            background: linear-gradient(135deg, #007bff, #00cccc);
            border-radius: 20px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
            margin: 15px;
            position: relative;
            transition: transform 0.3s ease;
            cursor: pointer;
            overflow: hidden;
            transform-style: preserve-3d;
        }

        .card:hover {
            transform: translateY(-10px) rotateX(15deg) rotateY(-15deg);
            background: linear-gradient(135deg, #00cccc, #007bff);
        }

        .card-icon {
            font-size: 36px;
            margin-bottom: 15px;
            color: #fff;
        }

        .card h4 {
            font-size: 18px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .card p {
            font-size: 24px;
            font-weight: bold;
        }

        .background-circle {
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, #007bff, #00cccc);
            border-radius: 50%;
            opacity: 0.1;
        }

        .print-btn:hover {
            transform: rotate(360deg);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            animation: pulseAnimation 0.5s infinite;
        }

        /* Additional Creative Styles */
        .btn-container {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            position: relative;
            z-index: 1;
        }

        .btn-container .btn {
            border: none;
            border-radius: 5px;
            padding: 15px 25px;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            z-index: 1;
        }

        .btn-container .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .print-btn {
            background: linear-gradient(135deg, #007bff, #00cccc);
            color: #fff;
        }

        .print-btn:before {
            content: "";
            position: absolute;
            top: -10px;
            left: -10px;
            right: -10px;
            bottom: -10px;
            background: linear-gradient(135deg, #007bff, #00cccc);
            border-radius: 50%;
            z-index: -1;
        }

        .print-btn:hover:before {
            animation: pulseAnimation 1s infinite;
        }

        .dashboard-btn {
            background: linear-gradient(135deg, #ff9900, #ff4d4d);
            color: #fff;
        }

        .dashboard-btn:before {
            content: "";
            position: absolute;
            top: -10px;
            left: -10px;
            right: -10px;
            bottom: -10px;
            background: linear-gradient(135deg, #ff9900, #ff4d4d);
            border-radius: 50%;
            z-index: -1;
        }

        .dashboard-btn:hover:before {
            animation: pulseAnimation 1s infinite;
        }

        @keyframes pulseAnimation {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(0, 123, 255, 0.9), rgba(0, 204, 204, 0.9));
            opacity: 0;
            transition: opacity 0.3s ease;
            border-radius: 20px;
        }

        .card-container .card:hover .overlay {
            opacity: 1;
        }
    </style>
</head>
<body>
<div class="container">
        <div class="heading">
            <h1>ROOM DETAILS</h1>
        </div>
        <div class="card-container">
            <div class="card">
                <div class="background-circle"></div>
                <i class="fas fa-building card-icon"></i>
                <h4>Hostel ID</h4>
                <p><?php echo $row['hostelId']; ?></p>
            </div>
            <div class="card">
            <div class="background-circle"></div>
                <i class="fas fa-user card-icon"></i>
                <h4>Registration Number</h4>
                <p><?php echo $row['regNo']; ?></p>
            </div>
            <div class="card">
            <div class="background-circle"></div>
            <div class="background-circle"></div>
                <i class="fas fa-user card-icon"></i>
                <h4>Name</h4>
                <p><?php echo $row['firstName'] . ' ' . $row['lastName']; ?></p>
            </div>
            <div class="card">
            <div class="background-circle"></div>
                <i class="fas fa-venus-mars card-icon"></i>
                <h4>Gender</h4>
                <p><?php echo $row['gender']; ?></p>
            </div>
            <div class="card">
            <div class="background-circle"></div>
                <i class="fas fa-graduation-cap card-icon"></i>
                <h4>Course</h4>
                <p><?php echo $row['course']; ?></p>
            </div>
            <div class="card">
            <div class="background-circle"></div>
                <i class="fas fa-phone card-icon"></i>
                <h4>Contact</h4>
                <p><?php echo $row['contact']; ?></p>
            </div>
            <div class="card">
            <div class="background-circle"></div>
                <i class="fas fa-envelope card-icon"></i>
                <h4>Email</h4>
                <p><?php echo $row['email']; ?></p>
            </div>
            <div class="card">
            <div class="background-circle"></div>
                <i class="fas fa-bed card-icon"></i>
                <h4>Room Number</h4>
                <p><?php echo $row['roomNumber']; ?></p>
            </div>
            <div class="card">
            <div class="background-circle"></div>
                <i class="fas fa-users card-icon"></i>
                <h4>Capacity</h4>
                <p><?php echo $row['capacity']; ?></p>
            </div>
            <div class="card">
            <div class="background-circle"></div>
                <i class="fas fa-dollar-sign card-icon"></i>
                <h4>Total Price</h4>
                <p><?php echo $row['totalPrice']; ?></p>
            </div>
            <div class="card">
            <div class="background-circle"></div>
                <i class="fas fa-calendar-alt card-icon"></i>
                <h4>Booking Date</h4>
                <p><?php echo $row['bookingDate']; ?></p>
            </div>
            <div class="card">
            <div class="background-circle"></div>
                <i class="fas fa-clock card-icon"></i>
                <h4>Duration (months)</h4>
                <p><?php echo $row['duration']; ?></p>
            </div>
        </div>
        <div class="btn-container">
            <a class="btn print-btn" href="print.php">
                <i class="fas fa-print"></i>
                <span class="print-btn-text">Print Details</span>
            </a>
            <a class="btn dashboard-btn" href="student_dashboard.php">Back to Dashboard</a>
        </div>
    </div>
</body>
</html>

<?php
    } else {
        echo '<!DOCTYPE html>
        <html>
        <head>
            <title>Room Details - Hostel Management System</title>
            <!-- Add any necessary meta tags and stylesheets -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
            <style>
                body {
                    font-family: "Roboto", Arial, sans-serif;
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
        
                .error-message-container {
                    text-align: center;
                    padding: 30px;
                    background-color: #FF7F50;
                    border-radius: 10px;
                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
                }
        
                .error-icon {
                    font-size: 70px;
                    color: #fff;
                    margin-bottom: 20px;
                }
        
                .error-message {
                    color: #fff;
                    font-size: 28px;
                    margin: 0;
                    margin-bottom: 10px;
                }
        
                .apology-message {
                    color: #fff;
                    font-size: 18px;
                    line-height: 1.5;
                    margin: 0;
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
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <h1>ROOM DETAILS</h1>
                </div>
                <div class="error-message-container">
                    <div class="error-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <h2 class="error-message">Oops! Room details not found</h2>
                    <p class="apology-message">Were sorry, but it seems that the room details for your registration number are not available at the moment. Please contact the hostel management for assistance.</p>
                </div>
                <div class="back-btn">
                    <a href="student_dashboard.php">Back to Dashboard</a>
                </div>
            </div>
        </body>
        </html>
        ';
    }
    mysqli_close($conn);
?>