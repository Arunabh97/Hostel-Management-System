<?php
session_start();

if (isset($_SESSION['admin_id'])) {
    $userRole = 'admin'; 
} else if (isset($_SESSION['regNo'])) {
    $userRole = 'student'; 
} else {
    header('Location: login.php'); 
    exit; 
}

$dashboardURL = ($userRole === 'admin') ? 'admin_dashboard.php' : 'student_dashboard.php';

include 'db.php'; 

if ($userRole === 'student' && isset($_SESSION['regNo'])) {
    $regNo = $_SESSION['regNo'];

    $sql = "SELECT * FROM hostel WHERE regNo = '$regNo'";
    $result = $conn->query($sql);
    $studentData = $result->fetch_assoc();

    if ($studentData) {
        $hostelId = $studentData['hostelId'];
        $firstName = $studentData['firstName'];
        $lastName = $studentData['lastName'];
        $gender = $studentData['gender'];
        $course = $studentData['course'];
        $contact = $studentData['contact'];
        $email = $studentData['email'];
        $roomNumber = $studentData['roomNumber'];
        $capacity = $studentData['capacity'];
        $price = $studentData['price'];
        $bookingDate = $studentData['bookingDate'];
        $duration = $studentData['duration'];
        $totalPrice = $studentData['totalPrice'];
    }
}

$message = '';
if ($userRole === 'student' && isset($_SESSION['regNo'])) {
    $regNo = $_SESSION['regNo'];

    $sql = "SELECT COUNT(*) AS count FROM hostel WHERE regNo = '$regNo'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $bookingCount = $row['count'];

    if ($bookingCount > 0) {
        // The student has already booked a hostel
        $message = "You have already made a booking.";
        $showForm = false; // Set this flag to prevent showing the form
    } else {
        // The student has not booked a hostel, show the form
        $showForm = true;
    }
}

if (isset($_POST['bookHostel'])) {
    if (!empty($message)) {
        $message = "You have already made a booking.";
    } else {
        // Fetch the last Hostel ID from the database and increment it
        $sql = "SELECT MAX(hostelId) AS maxHostelId FROM hostel";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $lastHostelId = $row['maxHostelId'];
        $newHostelId = $lastHostelId + 1;
        $regNo = $_POST['regNo'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $gender = $_POST['gender'];
        $course = $_POST['course'];
        $contact = $_POST['contact'];
        $email = $_POST['email'];
        $roomNumber = $_POST['roomNumber'];
        $capacity = $_POST['capacity'];
        $price = $_POST['price'];
        $bookingDate = $_POST['bookingDate'];
        $duration = $_POST['duration'];
        $totalPrice = $_POST['totalPrice'];

        
        $sql = "SELECT COUNT(*) AS count FROM hostel WHERE regNo = '$regNo'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $bookingCount = $row['count'];

        if ($bookingCount > 0) {
            $message = "You have already made a booking.";
        } else {
            
            $errors = array();

            if (empty($bookingDate)) {
                $errors[] = "Please select a booking date.";
            }

            if (empty($duration)) {
                $errors[] = "Please select the duration.";
            }

            if (!empty($duration)) {
                $durationMonths = intval($duration);
                if ($durationMonths <= 0) {
                    $errors[] = "Invalid duration.";
                }
            }

            $sql = "SELECT COUNT(*) AS count FROM hostel WHERE roomNumber = '$roomNumber'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $bookedCount = $row['count'];

            if ($bookedCount >= $capacity) {
                $errors[] = "The selected room is fully booked. Please choose another room.";
            }

            if (empty($errors)) {
                $sql = "INSERT INTO hostel (hostelId, regNo, firstName, lastName, gender, course, contact, email, roomNumber, capacity, price, bookingDate, duration, totalPrice) 
                VALUES ('$newHostelId', '$regNo', '$firstName', '$lastName', '$gender', '$course', '$contact', '$email', '$roomNumber', '$capacity', '$price', '$bookingDate', '$duration', '$totalPrice')";

                if ($conn->query($sql) === TRUE) {
                    $message = "Hostel booking successful!";
                } else {
                    $message = "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                $message = implode('<br>', $errors);
            }
        }
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Book Hostel</title>
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
            color: #4CAF50;
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
        input[type="password"],
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
            margin-right: 5px;
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
        .dashboard-button {
            display: inline-block;
            background-color: #337ab7;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            margin-right: 3px;
            transition: background-color 0.3s;
            float:right;
        }

        .dashboard-button:hover {
            background-color: #286090;
        }
        .message {
        background-color: #4CAF50;
        color: #fff;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 4px;
    }
    #availabilityStatus {
        /* Your default text color, e.g., black */
        color: red;
    }
        
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
        // Function to fetch student details based on registration number
        function fetchStudentDetails(regNo) {
            $.ajax({
                url: 'fetch_student.php',
                type: 'POST',
                data: { regNo: regNo },
                dataType: 'json',
                success: function(response) {
                    $('#firstName').val(response.firstName);
                    $('#lastName').val(response.lastName);
                    $('#gender').val(response.gender);
                    $('#course').val(response.course);
                    $('#contact').val(response.contact);
                    $('#email').val(response.email);
                }
            });
        }

        // Fetch student details automatically when logged in as a student
        <?php if ($userRole === 'student') { ?>
            var regNo = '<?php echo $_SESSION['regNo']; ?>';
            fetchStudentDetails(regNo);
        <?php } ?>

        // Bind change event to the regNo input field
        $('#regNo').change(function() {
            var regNo = $(this).val();
            fetchStudentDetails(regNo);
        });

            // Fetch room details based on room number
            $('#roomNumber').change(function() {
    var roomNumber = $(this).val();
    if (roomNumber !== '') {
        $.ajax({
            url: 'check_room_availability.php', // Replace with the actual URL to fetch room availability
            type: 'POST',
            data: { roomNumber: roomNumber },
            dataType: 'json',
            success: function(response) {
                console.log(response); // Check the response data in the browser console
                if (response.available) {
                    console.log('Room is Available'); // Verify this message is logged when the room is available
                    $('#availabilityStatus').html('Room is Available');
                    $('#capacity').val(response.capacity);
                    $('#price').val(response.price);
                } else {
                    console.log('Room is Fully Booked'); // Verify this message is logged when the room is fully booked
                    $('#availabilityStatus').html('Room is Fully Booked. Please choose another room.');
                    $('#capacity').val('');
                    $('#price').val('');
                }
            },
            error: function() {
                console.log('Error: Failed to check room availability.'); // Verify this message is logged in case of an error
                $('#availabilityStatus').html('Failed to check room availability. Please try again later.');
                $('#capacity').val('');
                $('#price').val('');
            }
        });
    } else {
        $('#availabilityStatus').html(''); // Clear the availability status if no room is selected
        $('#capacity').val('');
        $('#price').val('');
    }
});
            
            $('#duration').change(function() {
                calculatePrice(); 
            });

            function calculatePrice() {
                var duration = parseInt($('#duration').val());
                var price = parseFloat($('#price').val());
                var totalPrice = duration * price;
                $('#totalPrice').val(totalPrice.toFixed(2));
            }
        });
    </script>
</head>
<?php
if (!isset($firstName)) {
    $firstName = '';
}
if (!isset($lastName)) {
    $lastName = '';
}
if (!isset($gender)) {
    $gender = '';
}
if (!isset($course)) {
    $course = '';
}
if (!isset($contact)) {
    $contact = '';
}
if (!isset($email)) {
    $email = '';
}
if (!isset($roomNumber)) {
    $roomNumber = '';
}
if (!isset($capacity)) {
    $capacity = '';
}
if (!isset($price)) {
    $price = '';
}
if (!isset($bookingDate)) {
    $bookingDate = '';
}
if (!isset($duration)) {
    $duration = '';
}
if (!isset($totalPrice)) {
    $totalPrice = '';
}
?>
<body>
    <h2><i class="fas fa-hotel"></i> BOOK HOSTEL</h2>
    
    <form method="post" action="">
        <?php if ($userRole === 'student') { ?>
            <input type="hidden" name="regNo" value="<?php echo $_SESSION['regNo']; ?>">
        <?php } ?>
        <?php if (!empty($message)): ?>
    <div class="message">
        <?php echo $message; ?>
    </div>
<?php endif; ?>

        <div class="card">
            <label for="regNo"><i class="fas fa-id-badge"></i> Registration Number:</label>
            <input type="text" name="regNo" id="regNo" required placeholder="Enter registration number" <?php if ($userRole === 'student') { echo 'value="' . $_SESSION['regNo'] . '" readonly'; } ?>>
        </div>

        <div class="card">
            <label for="firstName"><i class="fas fa-user"></i> First Name:</label>
            <input type="text" name="firstName" id="firstName" required placeholder="Enter first name" <?php if ($userRole === 'student') { echo 'value="' . $firstName . '"'; } ?>>
        </div>

        <div class="card">
            <label for="lastName"><i class="fas fa-user"></i> Last Name:</label>
            <input type="text" name="lastName" id="lastName" required placeholder="Enter last name" <?php if ($userRole === 'student') { echo 'value="' . $lastName . '"'; } ?>>
        </div>

        <div class="card">
            <label for="gender"><i class="fas fa-venus-mars"></i> Gender:</label>
            <select name="gender" id="gender" required>
                <option value="">Select Gender</option>
                <option value="Male" <?php if ($userRole === 'student' && $gender === 'Male') { echo 'selected'; } ?>>Male</option>
                <option value="Female" <?php if ($userRole === 'student' && $gender === 'Female') { echo 'selected'; } ?>>Female</option>
                <option value="Other" <?php if ($userRole === 'student' && $gender === 'Other') { echo 'selected'; } ?>>Other</option>
            </select>
        </div>

        <div class="card">
            <label for="course"><i class="fas fa-book"></i> Course:</label>
            <input type="text" name="course" id="course" required placeholder="Enter course" <?php if ($userRole === 'student') { echo 'value="' . $course . '"'; } ?>>
        </div>

        <div class="card">
            <label for="contact"><i class="fas fa-phone"></i> Contact Number:</label>
            <input type="text" name="contact" id="contact" required placeholder="Enter contact number" <?php if ($userRole === 'student') { echo 'value="' . $contact . '"'; } ?>>
        </div>

        <div class="card">
            <label for="email"><i class="fas fa-envelope"></i> Email ID:</label>
            <input type="email" name="email" id="email" required placeholder="Enter email ID" <?php if ($userRole === 'student') { echo 'value="' . $email . '"'; } ?>>
        </div>

        <div class="card">
            <label for="roomNumber"><i class="fas fa-door-open"></i> Room Number:</label>
            <input type="text" id="roomNumber" name="roomNumber" required placeholder="Enter room number">
            <div id="availabilityStatus"></div>
        </div>

        <div class="card">
            <label for="capacity"><i class="fas fa-users"></i> Capacity:</label>
            <input type="text" id="capacity" name="capacity" required placeholder="Enter capacity" readonly>
        </div>

        <div class="card">
            <label for="price"><i class="fas fa-dollar-sign"></i> Price:</label>
            <input type="text" id="price" name="price" required placeholder="Enter price" readonly>
        </div>

        <div class="card">
            <label for="bookingDate"><i class="far fa-calendar-alt"></i> Booking Date:</label>
            <input type="date" name="bookingDate" id="bookingDate" required>
        </div>

        <div class="card">
            <label for="duration"><i class="fas fa-clock"></i> Duration (in months):</label>
            <select name="duration" id="duration" required>
                <option value="">Select Duration</option>
                <option value="1">1 Month</option>
                <option value="2">2 Months</option>
                <option value="3">3 Months</option>
                <option value="4">4 Months</option>
                <option value="5">5 Months</option>
                <option value="6">6 Months</option>
                <option value="7">7 Months</option>
                <option value="8">8 Months</option>
                <option value="9">9 Months</option>
                <option value="10">10 Months</option>
                <option value="11">11 Months</option>
                <option value="12">12 Months</option>     
            </select>
        </div>

        <div class="card">
            <label for="totalPrice"><i class="fas fa-dollar-sign"></i> Total Price:</label>
            <input type="text" id="totalPrice" name="totalPrice" readonly>
        </div>

        <input type="submit" name="bookHostel" value="Book Hostel">
        <input type="reset" value="Reset">
        
        <a class="dashboard-button" href="<?php echo $dashboardURL; ?>"> Back to Dashboard</a>
        
    </form>
    
</body>
</html>

