<?php
session_start();

// If not logged in at all, go to login
if (!isset($_SESSION['temp_user_id'])) {
    header("Location: Login.php");
    exit;
}

// If already verified, go home
if (isset($_SESSION['verified']) && $_SESSION['verified'] === true) {
    header("Location: ../index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification - FoodFusion</title>
    <link rel="stylesheet" href="../style.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        // Automatic submission when reCAPTCHA is completed
        function onCaptchaSuccess() {
            document.getElementById('verify-form').submit();
        }
    </script>
</head>
<body>
    <div class="Login_body">
        <div class="login-container">
            <h2>Security Verification</h2>
            <p class="welcome-text">Please complete the reCAPTCHA to continue to your account.</p>

            <?php
            if (isset($_GET['error'])) {
                echo '<div class="alert alert-error">' . htmlspecialchars($_GET['error']) . '</div>';
            }
            ?>

            <form action="../Process/verify_process.php" method="POST" id="verify-form">
                <div class="captcha-container">
                    <!-- Official Google Test Site Key with callback -->
                    <div class="g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI" data-callback="onCaptchaSuccess"></div>
                </div>

                <p class="verification-status-text">Verifying automatically...</p>
                <button type="submit" class="login-btn" style="display: none;">Verify and Continue</button>
            </form>

            <div class="footer-links">
                <p><a href="../logout.php">Cancel and Logout</a></p>
            </div>
        </div>
    </div>
</body>
</html>
