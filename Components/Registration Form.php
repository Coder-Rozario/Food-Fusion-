<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Us - FoodFusion</title>
    <!-- CSS link -->
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div class="Login_body">
        <div class="login-container">
            <h2>Join FoodFusion</h2>
            <?php
            // error messages if any
            if (isset($_GET['error'])) {
                echo '<div class="auth-message auth-error">' . $_GET['error'] . '</div>';
            }
            ?>
            <p class="welcome-text">
                Join our community and share recipes!
            </p>

            <form action="../Process/register_process.php" method="POST">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="firstname" placeholder="First Name" required>
                </div>

                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="lastname" placeholder="Last Name" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Your Email" required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Create Password" required>
                </div>

                <button type="submit" class="login-btn">Sign Up</button>
            </form>

            <div class="footer-links">
                <p>Already joined? <a href="Login.php">Login here</a></p>
            </div>
        </div>
    </div>

</body>
</html>