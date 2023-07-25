<?php

include 'db.php';

if (isset($_POST['roomNumber'])) {
    // Get the room number from the request
    $roomNumber = $_POST['roomNumber'];

    $sql = "SELECT capacity, price FROM rooms WHERE roomNumber = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $roomNumber);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();

        $roomDetails = array(
            'capacity' => $row['capacity'],
            'price' => $row['price']
        );

        echo json_encode($roomDetails);
    } else {
        echo json_encode(array('error' => 'Room not found'));
    }
    $stmt->close();
    $conn->close();
} 
else {
    echo json_encode(array('error' => 'Missing roomNumber parameter'));
}
?>
