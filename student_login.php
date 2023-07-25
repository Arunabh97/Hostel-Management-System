<?php
        include 'db.php'; 
        include 'check_login.php'; 
    
        if (isset($_SESSION['regNo'])) {
        header("Location: student_dashboard.php");
        exit;
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: 'Roboto', Arial, sans-serif;
            background-image: linear-gradient(to bottom, #78D7FF, #3B70FF);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 400px;
            padding: 40px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        h1 {
            margin-top: 0;
            color: #6C63FF;
            font-size: 32px;
            letter-spacing: 2px;
        }

        .logo {
            width: 100px;
            height: 100px;
            margin-bottom: 20px;
            border-radius: 50%;
            background-color: #6C63FF;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 40px;
            color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .logo i {
            transform: rotate(-20deg);
        }

        .card {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .card i {
            margin-right: 10px;
            color: #777;
        }

        .card input[type="text"],
        .card input[type="password"] {
            flex: 1;
            padding: 8px;
            border: none;
            background-color: transparent;
            color: #555;
        }

        .card input[type="text"]::placeholder,
        .card input[type="password"]::placeholder {
            color: #ccc;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            background-color: #6C63FF;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #4238FF;
        }

        .error {
            color: red;
            margin-top: 10px;
            font-size: 14px;
            text-align: center;       
        }

        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #555;
        }

        .footer a {
            color: #6C63FF;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
    <h1><i class="fas fa-home"></i> HOSTEL MANAGEMENT SYSTEM</h1>
        <div class="logo">
            <i class="fas fa-graduation-cap"></i> <!-- Update with your desired logo icon -->
        </div>
        <h2>Student Login</h2>

        <form method="post" action="">
            <div class="card">
                <i class="fas fa-user"></i>
                <label for="regNo">Registration Number:</label>
                <input type="text" name="regNo" id="regNo" placeholder="Enter your registration number" required>
            </div>

            <div class="card">
                <i class="fas fa-lock"></i>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" placeholder="Enter your password" required>
            </div>

            <input type="submit" name="login" value="Login">
        </form>

        <div class="footer">
            <h3>Admin Login Panel</h3>
            <p>If you are an Admin, please <a href="index.php">click here</a> to login.</p>
        </div>
        <?php
            
            if (isset($_SESSION['login_errors'])) {
                $errors = $_SESSION['login_errors'];
                
                foreach ($errors as $error) {
                    echo '<p class="error">' . $error . '</p>';
                }
                
                unset($_SESSION['login_errors']);
            }
            ?>
    </div>

 
</body>
</html>
