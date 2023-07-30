<!DOCTYPE html>
<html>
<head>
    <title>Register Student</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>

        body {
            font-family: 'Roboto', Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #4CAF50;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
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
            width: 100%;
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
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        input[type="submit"],
        input[type="reset"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-right: 10px;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: #45a049;
        }

        .error-message {
            color: red;
            margin-bottom: 10px;
        }
        
        .dashboard-button {
            display: inline-block;
            background-color: #337ab7;
            color: white;
            padding: 10px 20px;
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
<h2><i class="fas fa-user-plus"></i> REGISTER STUDENT</h2>

    <?php include 'db.php'; ?>
    <form method="post" action="">
    <div class="card">
    <label for="regNo"><i class="fas fa-id-card"></i> Registration Number:</label>
    <input type="text" name="regNo" id="regNo" required placeholder="Enter registration number">
</div>

<div class="card">
    <label for="firstName"><i class="fas fa-user"></i> First Name:</label>
    <input type="text" name="firstName" id="firstName" required placeholder="Enter first name">
</div>

<div class="card">
    <label for="lastName"><i class="fas fa-user"></i> Last Name:</label>
    <input type="text" name="lastName" id="lastName" required placeholder="Enter last name">
</div>

<div class="card">
    <label for="gender"><i class="fas fa-venus-mars"></i> Gender:</label>
    <select name="gender" id="gender" required>
        <option value="">Select Gender</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Other">Other</option>
    </select>
</div>

<div class="card">
    <label for="course"><i class="fas fa-book"></i> Course:</label>
    <input type="text" name="course" id="course" required placeholder="Enter course">
</div>

<div class="card">
    <label for="contact"><i class="fas fa-phone"></i> Contact Number:</label>
    <input type="text" name="contact" maxlength="10" id="contact" required placeholder="Enter contact number">
</div>

<div class="card">
    <label for="email"><i class="fas fa-envelope"></i> Email ID:</label>
    <input type="email" name="email" id="email" required placeholder="Enter email ID">
</div>

<div class="card">
    <label for="password"><i class="fas fa-lock"></i> Password:</label>
    <input type="password" name="password" id="password" required placeholder="Enter password">
</div>

<div class="card">
    <label for="confirmPassword"><i class="fas fa-lock"></i> Confirm Password:</label>
    <input type="password" name="confirmPassword" id="confirmPassword" required placeholder="Confirm password">
</div>


    <input type="submit" name="register" value="Register">
    <input type="reset" value="Reset">
    <a class="dashboard-button" href="admin_dashboard.php">Back to Dashboard</a>

    <?php 


if (isset($_POST['register'])) {

    $regNo = $_POST['regNo'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $gender = $_POST['gender'];
    $course = $_POST['course'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    $errors = array();

    if ($password !== $confirmPassword) {
        $errors[] = "Passwords do not match.";
    }

    $checkQuery = "SELECT * FROM student WHERE regNo = '$regNo'";
    $checkResult = $conn->query($checkQuery);
    if ($checkResult->num_rows > 0) {
        $errors[] = "Registration number already exists.";
    }

    if (!empty($errors)) {
        echo '<div class="error-message">';
        foreach ($errors as $error) {
            echo '<p>' . $error . '</p>';
        }
        echo '</div>';
    } else {
      
        $sql = "INSERT INTO student (regNo, firstName, lastName, gender, course, contact, email, password) 
                VALUES ('$regNo', '$firstName', '$lastName', '$gender', '$course','$contact', '$email', '$password')";

        if ($conn->query($sql) === TRUE) {
  
            echo "<b><p>Registration successful!</p></b>";
            echo "<p>Registration Number: " . $regNo . "</p>";
            echo "<p>Name: " . $firstName . " " . $lastName . "</p>";
            echo "<p>Gender: " . $gender . "</p>";
            echo "<p>Course: " . $course . "</p>";
            echo "<p>Contact: " . $contact . "</p>";
            echo "<p>Email: " . $email . "</p>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

</form>
</body>
</html>