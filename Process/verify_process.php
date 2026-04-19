<?php
session_start();

// Check if user is coming from login
if (!isset($_SESSION['temp_user_id'])) {
    header("Location: ../Components/Login.php");
    exit;
}

// Check if verification form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get Recaptcha response
    $recaptcha_res = $_POST['g-recaptcha-response'];
    $secret = "6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe";
    
    // Verify with Google API
    $google_url = "https://www.google.com/recaptcha/api/siteverify";
    $response = file_get_contents($google_url . "?secret=" . $secret . "&response=" . $recaptcha_res);
    $data = json_decode($response);

    // If verified successfully
    if ($data->success) {
        // Transfer data to permanent session
        $_SESSION['user_id'] = $_SESSION['temp_user_id'];
        $_SESSION['user_name'] = $_SESSION['temp_user_name'];
        $_SESSION['user_email'] = $_SESSION['temp_user_email'];
        $_SESSION['verified'] = true;

        // Clear temporary data
        unset($_SESSION['temp_user_id'], $_SESSION['temp_user_name'], $_SESSION['temp_user_email']);

        if (isset($_SESSION['redirect_after_login'])) {
            $redirect = $_SESSION['redirect_after_login'];
            unset($_SESSION['redirect_after_login']);
            header("Location: ../" . $redirect);
        } else {
            header("Location: ../index.php");
        }
    } else {
        header("Location: ../Components/verification.php?error=Captcha failed!");
    }
} else {
    header("Location: ../Components/verification.php");
}
?>
