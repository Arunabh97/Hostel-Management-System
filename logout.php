<?php
session_start();

if (isset($_SESSION['admin_id'])) {
    
    session_destroy();

    header("Location: index.php");
    exit();
}

if (isset($_SESSION['regNo'])) {
   
    session_destroy();

    header("Location: student_login.php");
    exit();
}

header("Location: index.php");
exit();
?>
?>
