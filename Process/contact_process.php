<?php
session_start();
// Include database connection
include '../Components/db.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $reason = $_POST['reason'];
    $msg = $_POST['message'];
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'NULL';

    // Basic validation
    if (empty($name) || empty($email) || empty($reason) || empty($msg)) {
        header("Location: ../Contact us.php?error=All fields are required!");
        exit;
    }

    // Protect against SQL injection
    $name = mysqli_real_escape_string($con, $name);
    $email = mysqli_real_escape_string($con, $email);
    $reason = mysqli_real_escape_string($con, $reason);
    $msg = mysqli_real_escape_string($con, $msg);

    // Save message to database
    $sql = "INSERT INTO ContactMessages (user_id, name, email, reason, message) VALUES ($user_id, '$name', '$email', '$reason', '$msg')";

    if (mysqli_query($con, $sql)) {
        header("Location: ../Contact us.php?success=1");
    } else {
        header("Location: ../Contact us.php?error=Database error!");
    }
}
?>
