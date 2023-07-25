<?php
session_start();

if (isset($_SESSION['admin_id'])) {
    header("Location: admin_dashboard.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'hostel_manage';

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin_t WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {

        $admin = mysqli_fetch_assoc($result);
        $_SESSION['admin_id'] = $admin['id'];
        header("Location: admin_dashboard.php");
        exit();
    } 
    else {
        $error_message = "Invalid username or password";
    }
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hostel Management System - Login</title>
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
        <i class="fas fa-user-shield"></i> <!-- Update with the desired admin logo icon -->
    </div>
        <h2><i class="fas fa-user-shield"></i>Admin Login</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="card">
                <i class="fas fa-user"></i>
                <input type="text" id="admin-username" name="username" placeholder="Username" required>
            </div>
            <div class="card">
                <i class="fas fa-lock"></i>
                <input type="password" id="admin-password" name="password" placeholder="Password" required>
            </div>
            <input type="submit" value="Login">
        </form>
        <div class="footer">
            <h3>Student Login Panel</h3>
            <p>If you are an Student, please <a href="student_login.php">click here</a> to login.</p>
        </div>
        <?php
        if (isset($error_message)) {
            echo '<p class="error">' . $error_message . '</p>';
        }
        ?>
    </div>
</body>
</html>



