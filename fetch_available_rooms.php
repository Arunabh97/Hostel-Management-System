<?php
// fetch_available_rooms.php

// Include the database connection file (db.php or the relevant file)
include 'db.php';

// Fetch available room numbers from the "manage_rooms" table
$sql = "SELECT roomNumber FROM rooms";
$result = $conn->query($sql);

$roomNumbers = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $roomNumbers[] = $row['roomNumber'];
    }
}

$conn->close();

// Return the room numbers as a JSON response
echo json_encode($roomNumbers);
?>
