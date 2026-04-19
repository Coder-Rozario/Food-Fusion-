<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - FoodFusion</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body class="Login_body">

    <div class="login-container">
        <h2>Login to FoodFusion</h2>

        <?php
        // Display error or success messages from URL
        if (isset($_GET['error'])) {
            echo '<div class="auth-message auth-error">' . htmlspecialchars($_GET['error']) . '</div>';
        }
        if (isset($_GET['success'])) {
            echo '<div class="auth-message auth-success">' . htmlspecialchars($_GET['success']) . '</div>';
        }
        ?>

        <form action="../Process/login_process.php" method="POST">
            <?php if(isset($_GET['redirect'])): ?>
                <input type="hidden" name="redirect" value="<?php echo htmlspecialchars($_GET['redirect']); ?>">
            <?php endif; ?>
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" placeholder="Enter your email" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter your password" required>
            </div>

            <button type="submit" class="login-btn">Login</button>
        </form>

        <div class="footer-links">
            <p>Don't have an account? <a href="Registration Form.php">Register here</a></p>
            <p><a href="../index.php" style="color: rgba(102, 102, 102, 1); font-size: 0.9rem;">← Back to Home</a></p>
        </div>
    </div>

</body>
</html>