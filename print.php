<?php

    session_start();

    include 'db.php'; 

    if (isset($_SESSION['regNo'])) {
        $regNo = $_SESSION['regNo'];
        $query = "SELECT * FROM hostel WHERE regNo = '$regNo'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            require_once('TCPDF-main/tcpdf.php');

            $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');

            $pdf->SetCreator('Hostel Management System');
            $pdf->SetAuthor('Your Name');
            $pdf->SetTitle('Room Details');
            $pdf->SetSubject('Room Details');
            $pdf->SetKeywords('Room, Details, Hostel');

            $pdf->SetHeaderData('', 0, '', '', array(0, 0, 0), array(255, 255, 255));
            $pdf->setHeaderFont(Array('helvetica', '', 12));
            $pdf->setFooterFont(Array('helvetica', '', 10));

            $pdf->SetMargins(15, 15, 15);
            $pdf->SetHeaderMargin(5);
            $pdf->SetFooterMargin(10);

            $pdf->SetAutoPageBreak(TRUE, 20);

            $pdf->AddPage();

            $pdf->SetFont('helvetica', 'B', 14);

            $pdf->Cell(0, 10, 'Room Details', 0, 1, 'C');
            $pdf->Ln(10);

            $pdf->SetFont('helvetica', 'B', 12);
            $pdf->Cell(0, 10, 'Student Details', 0, 1);
            $pdf->Ln(5);

            $pdf->SetFont('helvetica', 'B', 12);
            $pdf->Cell(40, 10, 'Reg Number:', 0, 0);
            $pdf->SetFont('helvetica', '', 12);
            $pdf->Cell(0, 10, $row['regNo'], 0, 1);

            $pdf->SetFont('helvetica', 'B', 12);
            $pdf->Cell(40, 10, 'Name:', 0, 0);
            $pdf->SetFont('helvetica', '', 12);
            $pdf->Cell(0, 10, $row['firstName'] . ' ' . $row['lastName'], 0, 1);

            $pdf->SetFont('helvetica', 'B', 12);
            $pdf->Cell(40, 10, 'Gender:', 0, 0);
            $pdf->SetFont('helvetica', '', 12);
            $pdf->Cell(0, 10, $row['gender'], 0, 1);

            $pdf->SetFont('helvetica', 'B', 12);
            $pdf->Cell(40, 10, 'Course:', 0, 0);
            $pdf->SetFont('helvetica', '', 12);
            $pdf->Cell(0, 10, $row['course'], 0, 1);

            $pdf->SetFont('helvetica', 'B', 12);
            $pdf->Cell(40, 10, 'Contact:', 0, 0);
            $pdf->SetFont('helvetica', '', 12);
            $pdf->Cell(0, 10, $row['contact'], 0, 1);

            $pdf->SetFont('helvetica', 'B', 12);
            $pdf->Cell(40, 10, 'Email:', 0, 0);
            $pdf->SetFont('helvetica', '', 12);
            $pdf->Cell(0, 10, $row['email'], 0, 1);

            $pdf->SetLineWidth(0.2);
            $pdf->Line(10, $pdf->GetY() + 5, 200, $pdf->GetY() + 5);
            $pdf->Ln(10);

            $pdf->SetFont('helvetica', 'B', 12);
            $pdf->Cell(0, 10, 'Hostel Details', 0, 1);
            $pdf->Ln(5);

            $pdf->SetFont('helvetica', 'B', 12);
            $pdf->Cell(40, 10, 'Room Number:', 0, 0);
            $pdf->SetFont('helvetica', '', 12);
            $pdf->Cell(0, 10, $row['roomNumber'], 0, 1);

            $pdf->SetFont('helvetica', 'B', 12);
            $pdf->Cell(40, 10, 'Capacity:', 0, 0);
            $pdf->SetFont('helvetica', '', 12);
            $pdf->Cell(0, 10, $row['capacity'], 0, 1);

            $pdf->SetFont('helvetica', 'B', 12);
            $pdf->Cell(40, 10, 'Total Price:', 0, 0);
            $pdf->SetFont('helvetica', '', 12);
            $pdf->Cell(0, 10, $row['totalPrice'], 0, 1);

            $pdf->SetFont('helvetica', 'B', 12);
            $pdf->Cell(40, 10, 'Booking Date:', 0, 0);
            $pdf->SetFont('helvetica', '', 12);
            $pdf->Cell(0, 10, $row['bookingDate'], 0, 1);

            $pdf->SetFont('helvetica', 'B', 12);
            $pdf->Cell(40, 10, 'Duration (months):', 0, 0);
            $pdf->SetFont('helvetica', '', 12);
            $pdf->Cell(0, 10, $row['duration'], 0, 1);

            $pdf->Output('room_details.pdf', 'I');
        } else {
            echo "<h1>Error: Room details not found!</h1>";
        }
    } else {
        echo "<h1>Error: User not logged in!</h1>";
    }
?>
