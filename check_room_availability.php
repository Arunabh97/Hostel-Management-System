<?php
// check_room_availability.php

// Database connection
include 'db.php';

// Ensure the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the roomNumber parameter is set
    if (isset($_POST['roomNumber'])) {
        // Sanitize and store the room number from the POST data
        $roomNumber = mysqli_real_escape_string($conn, $_POST['roomNumber']);

        // Perform a SELECT query to check room availability
        $sql = "SELECT capacity, price FROM rooms WHERE roomNumber = '$roomNumber'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Room exists, check if it is available (not fully booked)
            $row = $result->fetch_assoc();
            $capacity = $row['capacity'];
            $price = $row['price'];

            // Check if the room is fully booked
            $sql = "SELECT COUNT(*) AS bookedCount FROM hostel WHERE roomNumber = '$roomNumber' AND regNo IS NOT NULL";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $bookedCount = $row['bookedCount'];
            
            $available = ($bookedCount < $capacity);

            // Return the room details and availability status in JSON format
            $response = array(
                'available' => $available,
                'capacity' => $capacity,
                'price' => $price,
            );

            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            // Room does not exist
            $response = array(
                'available' => false,
                'capacity' => '',
                'price' => '',
            );

            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }
}
