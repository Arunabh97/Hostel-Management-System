<?php

include 'db.php';


if (isset($_GET['regNo'])) {
    $regNo = $_GET['regNo'];

    $sql = "SELECT * FROM student WHERE regNo='$regNo'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
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
    
    header("Location: manage_students.php");
    exit();
}

if (isset($_POST['update'])) {

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $gender = $_POST['gender'];
    $course = $_POST['course'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];

    $sql = "UPDATE student SET firstName='$firstName', lastName='$lastName', gender='$gender', course='$course', contact='$contact', email='$email' WHERE regNo='$regNo'";

    if ($conn->query($sql) === TRUE) {
        header("Location: manage_students.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
$conn->close();
?>

<html>
<head>
    <title>Edit Student</title>
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
        
        .back-button {
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

        .back-button:hover {
            background-color: #286090;
        }
    </style>
</head>
<body>
    <h2><i class="fas fa-edit"></i> Edit Student</h2>
    <form method="post" action="">
        <div class="card">
            <label for="regNo"><i class="fas fa-id-card"></i> Registration Number:</label>
            <input type="text" name="regNo" id="regNo" value="<?php echo $regNo; ?>" readonly>
        </div>

        <div class="card">
            <label for="firstName"><i class="fas fa-user"></i> First Name:</label>
            <input type="text" name="firstName" id="firstName" value="<?php echo $firstName; ?>" required>
        </div>

        <div class="card">
            <label for="lastName"><i class="fas fa-user"></i> Last Name:</label>
            <input type="text" name="lastName" id="lastName" value="<?php echo $lastName; ?>" required>
        </div>

        <div class="card">
            <label for="gender"><i class="fas fa-venus-mars"></i> Gender:</label>
            <select name="gender" id="gender" required>
                <option value="Male" <?php if ($gender == 'Male') echo 'selected'; ?>>Male</option>
                <option value="Female" <?php if ($gender == 'Female') echo 'selected'; ?>>Female</option>
                <option value="Other" <?php if ($gender == 'Other') echo 'selected'; ?>>Other</option>
            </select>
        </div>

        <div class="card">
            <label for="course"><i class="fas fa-book"></i> Course:</label>
            <input type="text" name="course" id="course" value="<?php echo $course; ?>" required>
        </div>

        <div class="card">
            <label for="contact"><i class="fas fa-phone"></i> Contact Number:</label>
            <input type="text" name="contact" id="contact" maxlength="10" value="<?php echo $contact; ?>" required>
        </div>

        <div class="card">
            <label for="email"><i class="fas fa-envelope"></i> Email ID:</label>
            <input type="email" name="email" id="email" value="<?php echo $email; ?>" required>
        </div>

        <input type="submit" name="update" value="Update">
        <a class="back-button" href="manage_students.php"><i class="fas fa-arrow-left"></i> Back to Manage Students</a>

    </form>
</body>
</html>
