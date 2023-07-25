<?php
session_start();

include 'db.php';

if (isset($_POST['login'])) {

    $regNo = $_POST['regNo'];
    $password = $_POST['password'];

    // Perform validations (you can add more validations as per your requirements)
    $errors = array();

    $sql = "SELECT * FROM student WHERE regNo = '$regNo' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {

        $row = $result->fetch_assoc();

        $_SESSION['regNo'] = $row['regNo'];
        $_SESSION['firstName'] = $row['firstName'];

        header("Location: student_dashboard.php");
        exit;
    } else {

        $errors[] = "<center>Invalid registration number or password.</center>";
    }

    if (!empty($errors)) {
        $_SESSION['login_errors'] = $errors;
        header("Location: student_login.php");
        exit;
    }
}

$conn->close();
?>
