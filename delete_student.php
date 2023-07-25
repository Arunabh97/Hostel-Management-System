<?php

if (isset($_GET['regNo'])) {

    $regNo = $_GET['regNo'];

    include 'db.php';

    $sql = "DELETE FROM student WHERE regNo = '$regNo'";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Student deleted successfully.");</script>';
    } else {
        echo '<script>alert("Error deleting student: ' . $conn->error . '");</script>';
    }

    $conn->close();

    echo '<script>window.location.href = "manage_students.php";</script>';
} else {
    echo '<script>window.location.href = "manage_students.php";</script>';
}
?>
