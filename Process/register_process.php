<?php
// Include database connection
include '../Components/db.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get form data and sanitize
    $first = mysqli_real_escape_string($con, $_POST['firstname']);
    $last = mysqli_real_escape_string($con, $_POST['lastname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $pwd = $_POST['password'];

    // Basic validation
    if (empty($first) || empty($last) || empty($email) || empty($pwd)) {
        header("Location: ../Components/Registration Form.php?error=Fill everything!");
        exit;
    }

    // Check if email already exists
    $check = "SELECT id FROM Users WHERE email = '$email'";
    $res = mysqli_query($con, $check);
    
    if (mysqli_num_rows($res) > 0) {
        header("Location: ../Components/Registration Form.php?error=Email already taken!");
        exit;
    }

    // Securely hash the password
    $hashed = password_hash($pwd, PASSWORD_DEFAULT);

    // Insert user into database
    $sql = "INSERT INTO Users (firstname, lastname, email, password) VALUES ('$first', '$last', '$email', '$hashed')";

    if (mysqli_query($con, $sql)) {
        header("Location: ../Components/Login.php?success=Registration successful!");
    } else {
        header("Location: ../Components/Registration Form.php?error=Registration failed!");
    }
}
?>
