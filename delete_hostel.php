<?php

include 'db.php';

if (isset($_GET['hostelId'])) {
    $hostelId = $_GET['hostelId'];

    $sql = "DELETE FROM hostel WHERE hostelId = '$hostelId'";
    if ($conn->query($sql) === TRUE) {

        header("Location: manage_hostel_students.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {

    echo "Hostel ID not provided.";
}

$conn->close();
?>
