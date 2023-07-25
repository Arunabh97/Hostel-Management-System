<!DOCTYPE html>
<html>
<head>
    <title>Edit Hostel</title>
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
        .card select,
        .card input[type="date"],
        .card input[type="number"] {
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
        .card select:focus,
        .card input[type="date"]:focus,
        .card input[type="number"]:focus {
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
        select,
        input[type="date"],
        input[type="number"] {
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

        .submit-button {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            float: right;
        }

        .submit-button:hover {
            background-color: #45a049;
        }
        .back-button {
        background-color: #337ab7;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        margin-right: 10px;
        text-decoration: none;
        display: inline-block;
        transition: background-color 0.3s;
    }

    .back-button:hover {
        background-color: #45a049;
    }
    </style>
</head>
<body>
    <h2><i class="fas fa-edit"></i> Edit Hostel</h2>
    <?php
    include 'db.php';

    // Check if the hostel ID is provided in the query string
    if (isset($_GET['hostelId'])) {
        $hostelId = $_GET['hostelId'];

        // Retrieve the hostel information from the database
        $sql = "SELECT * FROM hostel WHERE hostelId = '$hostelId'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $regNo = $row['regNo'];
            $firstName = $row['firstName'];
            $lastName = $row['lastName'];
            $gender = $row['gender'];
            $course = $row['course'];
            $contact = $row['contact'];
            $email = $row['email'];
            $roomNumber = $row['roomNumber'];
            $capacity = $row['capacity'];
            $totalPrice = $row['totalPrice'];
            $bookingDate = $row['bookingDate'];
            $duration = $row['duration'];

            echo '<form method="post" action="">';
            echo '<input type="hidden" name="hostelId" value="' . $hostelId . '">';

            echo '<div class="card">';
            echo '<label for="regNo"><i class="fas fa-id-card"></i> Registration Number:</label>';
            echo '<input type="text" name="regNo" id="regNo" value="' . $regNo . '" readonly required>';
            echo '</div>';

            echo '<div class="card">';
            echo '<label for="firstName"><i class="fas fa-user"></i> First Name:</label>';
            echo '<input type="text" name="firstName" id="firstName" value="' . $firstName . '" required>';
            echo '</div>';

            echo '<div class="card">';
            echo '<label for="lastName"><i class="fas fa-user"></i> Last Name:</label>';
            echo '<input type="text" name="lastName" id="lastName" value="' . $lastName . '" required>';
            echo '</div>';

            echo '<div class="card">';
            echo '<label for="gender"><i class="fas fa-venus-mars"></i> Gender:</label>';
            echo '<select name="gender" id="gender" required>';
            echo '<option value="male" ' . ($gender == 'male' ? 'selected' : '') . '>Male</option>';
            echo '<option value="female" ' . ($gender == 'female' ? 'selected' : '') . '>Female</option>';
            echo '<option value="other" ' . ($gender == 'other' ? 'selected' : '') . '>Other</option>';
            echo '</select>';
            echo '</div>';

            echo '<div class="card">';
            echo '<label for="course"><i class="fas fa-book"></i> Course:</label>';
            echo '<input type="text" name="course" id="course" value="' . $course . '" required>';
            echo '</div>';

            echo '<div class="card">';
            echo '<label for="contact"><i class="fas fa-phone"></i> Contact Number:</label>';
            echo '<input type="text" name="contact" id="contact" value="' . $contact . '" required>';
            echo '</div>';

            echo '<div class="card">';
            echo '<label for="email"><i class="fas fa-envelope"></i> Email ID:</label>';
            echo '<input type="email" name="email" id="email" value="' . $email . '" required>';
            echo '</div>';

            echo '<div class="card">';
            echo '<label for="roomNumber"><i class="fas fa-door-open"></i> Room Number:</label>';
            echo '<input type="text" id="roomNumber" name="roomNumber" value="' . $roomNumber . '" required>';
            echo '</div>';

            echo '<div class="card">';
            echo '<label for="capacity"><i class="fas fa-users"></i> Capacity:</label>';
            echo '<input type="text" id="capacity" name="capacity" value="' . $capacity . '" required>';
            echo '</div>';

            echo '<div class="card">';
            echo '<label for="totalPrice"><i class="fas fa-dollar-sign"></i> Total Price:</label>';
            echo '<input type="text" id="totalPrice" name="totalPrice" value="' . $totalPrice . '" readonly required>';
            echo '</div>';

            echo '<div class="card">';
            echo '<label for="bookingDate"><i class="fas fa-calendar-alt"></i> Booking Date:</label>';
            echo '<input type="date" name="bookingDate" id="bookingDate" value="' . $bookingDate . '" required>';
            echo '</div>';

            echo '<div class="card">';
            echo '<label for="duration"><i class="fas fa-clock"></i> Duration (months):</label>';
            echo '<input type="number" name="duration" id="duration" min="1" value="' . $duration . '" readonly required>';
            echo '</div>';

            echo '<input type="submit" name="updateHostel" value="Update Hostel">';
            echo '<br><br>';
            echo '<a class="back-button" href="manage_hostel_students.php"><i class="fas fa-arrow-left"></i> Back to Manage Hostel Students</a>';
            
        } else {
            echo '<p>No hostel found with the provided ID.</p>';
        }
    } else {
        echo '<p>Hostel ID is not provided.</p>';
    }

    if (isset($_POST['updateHostel'])) {

        $hostelId = $_POST['hostelId'];
        $regNo = isset($_POST['regNo']) ? $_POST['regNo'] : '';
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $gender = $_POST['gender'];
        $course = $_POST['course'];
        $contact = $_POST['contact'];
        $email = $_POST['email'];
        $roomNumber = $_POST['roomNumber'];
        $capacity = $_POST['capacity'];
        $totalPrice = $_POST['totalPrice'];
        $bookingDate = $_POST['bookingDate'];
        $duration = $_POST['duration'];

        // Perform validations (you can add more validations as per your requirements)
        $errors = array();


        if (empty($errors)) {

            $sql = "UPDATE hostel SET regNo = '$regNo', firstName = '$firstName', lastName = '$lastName', 
                    gender = '$gender', course = '$course', contact = '$contact', email = '$email', roomNumber = '$roomNumber', 
                    capacity = '$capacity', totalPrice = '$totalPrice', bookingDate = '$bookingDate', duration = '$duration' 
                    WHERE hostelId = '$hostelId'";

            if ($conn->query($sql) === TRUE) {
                echo "<b><p>Hostel information updated successfully!</p></b>";
                echo "<p>Hostel Id: " . $hostelId . "</p>";
                echo "<p>Registration Number: " . $regNo . "</p>";
                echo "<p>Name: " . $firstName . " " . $lastName . "</p>";
                echo "<p>Gender: " . $gender . "</p>";
                echo "<p>Course: " . $course . "</p>";
                echo "<p>Contact: " . $contact . "</p>";
                echo "<p>Email: " . $email . "</p>";
                echo "<p>RoomNumber: " . $roomNumber . "</p>";
                echo "<p>Capacity: " . $capacity . "</p>";
                echo "<p>Total Price: " . $totalPrice . "</p>";
                echo "<p>Booking Date: " . $bookingDate . "</p>";
                echo "<p>Duration: " . $duration . " months</p>";
            } else {
                echo "Error updating hostel information: " . $conn->error;
            }
        } else {
            
            echo '<div class="error-message">';
            foreach ($errors as $error) {
                echo '<p>' . $error . '</p>';
            }
            echo '</div>';
        }
    }
    echo '</form>';

    $conn->close();
    ?>
</body>
</html>
