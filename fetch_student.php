<?php
include 'db.php';

if (isset($_POST['regNo'])) {
    $regNo = $_POST['regNo'];
    $sql = "SELECT * FROM student WHERE regNo = '$regNo'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $studentData = array(
            'firstName' => $row['firstName'],
            'lastName' => $row['lastName'],
            'gender' => $row['gender'],
            'course' => $row['course'],
            'contact' => $row['contact'],
            'email' => $row['email']
        );
        echo json_encode($studentData);
    } else {
        echo json_encode(null);
    }
}

$conn->close();
?>
