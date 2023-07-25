<?php
    include 'check_login.php';

    if (!isset($_SESSION['regNo'])) {
        header("Location: student_login.php");
        exit;
    }

    include 'db.php';

    $regNo = $_SESSION['regNo'];
    $query = "SELECT * FROM student WHERE regNo = '$regNo'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        
        if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
            $firstName = $row['firstName'];
            $lastName = $row['lastName'];
            $gender = $row['gender'];
            $course = $row['course'];
            $contact = $row['contact'];
            $email = $row['email'];
        } else {
            header("Location: manage_students.php");
            exit();
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $gender = $_POST['gender'];
        $course = $_POST['course'];
        $contact = $_POST['contact'];
        $email = $_POST['email'];

        $profileUpdateQuery = "UPDATE student SET firstName='$firstName', lastName='$lastName', gender='$gender', course='$course', contact='$contact', email='$email' WHERE regNo='$regNo'";

        if ($conn->query($profileUpdateQuery) === TRUE) {
        } else {
            echo "Error updating profile: " . $conn->error;
        }
        if (isset($_POST['changePassword'])) {
            $currentPassword = $_POST['currentPassword'];
            $newPassword = $_POST['newPassword'];
            $confirmPassword = $_POST['confirmPassword'];

            // Check if the current password is correct
            $passwordQuery = "SELECT password FROM student WHERE regNo = '$regNo'";
            $passwordResult = mysqli_query($conn, $passwordQuery);
            $passwordRow = mysqli_fetch_assoc($passwordResult);
            $storedPassword = $passwordRow['password'];

            if ($currentPassword === $storedPassword) {
                // Check if the new password and confirm password match
                if ($newPassword === $confirmPassword) {
                    // Update the password in the database
                    $passwordUpdateQuery = "UPDATE student SET password='$newPassword' WHERE regNo='$regNo'";
                    if ($conn->query($passwordUpdateQuery) === TRUE) {
                        // Password update successful
                    } else {
                        echo "Error updating password: " . $conn->error;
                    }
                } else {
                    echo "New password and confirm password do not match.";
                }
            } else {
                echo "Current password is incorrect.";
            }
        }
        $row['firstName'] = $firstName;
        $row['lastName'] = $lastName;
        $row['gender'] = $gender;
        $row['course'] = $course;
        $row['contact'] = $contact;
        $row['email'] = $email;
    }
    $conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Profile - Hostel Management System</title>
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
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
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
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .form-group label {
            display: inline-block;
            font-weight: bold;
            margin-right: 10px;
            color: #333;
            font-size: 18px;
            flex: 0 0 150px;
        }

        .form-group input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .form-group button:hover {
            background-color: #45a049;
        }

        .back-button {
            margin-top: 20px;
            text-align: center;
        }

        .back-button a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .back-button a:hover {
            background-color: #45a049;
        }

        .icon {
            display: inline-block;
            margin-right: 10px;
        }

        .icon-lg {
            font-size: 24px;
        }
        
        .container {
            position: relative;
            overflow: hidden;
        }
        
        .header {
            position: relative;
            z-index: 1;
        }
        
        .header::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(0,0,0,0.4) 0%, rgba(0,0,0,0) 100%);
            z-index: -1;
        }
        
        .header h1 {
            color: #fff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
        
        .form-group label {
            color: #555;
        }
        
        .form-group input {
            background-color: #f8f8f8;
        }
        
        .form-group button {
            background-color: #6ab04c;
            transition: background-color 0.3s ease;
        }
        
        .form-group button:hover {
            background-color: #5e9841;
        }
        
        .back-button a {
            background-color: #6ab04c;
            transition: background-color 0.3s ease;
        }
        
        .back-button a:hover {
            background-color: #5e9841;
        }
        
        .icon {
            color: #555;
        }
        
        .icon-lg {
            font-size: 28px;
        }

        .container::before {
            content: "";
            position: absolute;
            top: -20px;
            left: -20px;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #6ab04c;
            z-index: -1;
            transform: rotate(45deg);
        }

        .container::after {
            content: "";
            position: absolute;
            bottom: -20px;
            right: -20px;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #6ab04c;
            z-index: -1;
            transform: rotate(45deg);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-user icon icon-lg"></i> VIEW PROFILE</h1>
        </div>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="firstName"><i class="fas fa-user icon"></i> First Name:</label>
                <input type="text" id="firstName" name="firstName" value="<?php echo $firstName; ?>" required>
            </div>
            <div class="form-group">
                <label for="lastName"><i class="fas fa-user icon"></i> Last Name:</label>
                <input type="text" id="lastName" name="lastName" value="<?php echo $lastName; ?>" required>
            </div>
            <div class="form-group">
                <label for="gender"><i class="fas fa-venus-mars icon"></i> Gender:</label>
                <input type="text" id="gender" name="gender" value="<?php echo $gender; ?>" required>
            </div>
            <div class="form-group">
                <label for="course"><i class="fas fa-graduation-cap icon"></i> Course:</label>
                <input type="text" id="course" name="course" value="<?php echo $course; ?>" required>
            </div>
            <div class="form-group">
                <label for="contact"><i class="fas fa-phone icon"></i> Contact:</label>
                <input type="text" id="contact" name="contact" value="<?php echo $contact; ?>" required>
            </div>
            <div class="form-group">
                <label for="email"><i class="fas fa-envelope icon"></i> Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>
            </div>
            <button type="submit" name="update"><i class="fas fa-check-circle icon"></i> Update Profile</button>
        </form>
        <hr>
        <h2><i class="fas fa-key icon"></i> Change Password</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="currentPassword"><i class="fas fa-lock icon"></i> Current Password:</label>
                <input type="password" id="currentPassword" name="currentPassword" required>
            </div>
            <div class="form-group">
                <label for="newPassword"><i class="fas fa-lock icon"></i> New Password:</label>
                <input type="password" id="newPassword" name="newPassword" required>
            </div>
            <div class="form-group">
                <label for="confirmPassword"><i class="fas fa-lock icon"></i> Confirm Password:</label>
                <input type="password" id="confirmPassword" name="confirmPassword" required>
            </div>
            <button type="submit" name="changePassword"><i class="fas fa-key icon"></i> Change Password</button>
        </form>
        <div class="back-button">
            <a href="student_dashboard.php"><i class="fas fa-arrow-left icon"></i> Back to Dashboard</a>
        </div>
    </div>
</body>
</html>
