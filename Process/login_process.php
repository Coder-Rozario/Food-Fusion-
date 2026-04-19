<?php
session_start();
// Include database connection
include '../Components/db.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Check if account is locked
    if (isset($_COOKIE['lockout'])) {
        header("Location: ../Components/Login.php?error=Locked. Try after 3 mins.");
        exit;
    }

    // Get input and sanitize
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $pass = $_POST['password'];

    // Find user in database
    $sql = "SELECT * FROM Users WHERE email = '$email'";
    $res = mysqli_query($con, $sql);
    $user = mysqli_fetch_assoc($res);

    if (!$user) {
        header("Location: ../Components/Login.php?error=Email not found!");
        exit;
    }

    // Verify password
    if (password_verify($pass, $user['password'])) {
        // Success: Reset attempts and set temp session
        setcookie('attempts', '', time() - 3600, "/");
        
        $_SESSION['temp_user_id'] = $user['id'];
        $_SESSION['temp_user_name'] = $user['firstname'] . ' ' . $user['lastname'];
        $_SESSION['temp_user_email'] = $user['email'];
        $_SESSION['verified'] = false;
        
        if (isset($_POST['redirect'])) {
            $_SESSION['redirect_after_login'] = $_POST['redirect'];
        }

        header("Location: ../Components/verification.php");
    } else {
        // Failure: Track failed attempts
        $attempts = (isset($_COOKIE['attempts']) ? $_COOKIE['attempts'] : 0) + 1;

        if ($attempts >= 3) {
            // Lock for 3 minutes
            setcookie('lockout', '1', time() + 180, "/");
            setcookie('attempts', '', time() - 3600, "/");
            $msg = "Too many fails! Locked for 3 mins.";
        } else {
            setcookie('attempts', $attempts, time() + 3600, "/");
            $left = 3 - $attempts;
            $msg = "Wrong password! $left attempts left.";
        }

        header("Location: ../Components/Login.php?error=$msg");
    }
}
?>
