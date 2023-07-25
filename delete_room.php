<?php

include 'db.php';

if (isset($_GET['id'])) {
    $roomId = $_GET['id'];

    $sql = "DELETE FROM rooms WHERE roomId = '$roomId'";
    if ($conn->query($sql) === TRUE) {

        header("Location: manage_room.php");
        exit();
    } else {

        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {

    echo "Room ID not provided.";
}

$conn->close();
?>
