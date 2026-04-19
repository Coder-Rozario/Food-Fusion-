<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Redirect if logged in but not verified
if (isset($_SESSION['temp_user_id']) && !isset($_SESSION['user_id'])) {
    header("Location: Components/verification.php");
    exit;
}
?>
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
<header>
    <nav>
        <div class="logo"><h1>FoodFusion</h1>
        <span id="menu-toggle">
<i class="fa-solid fa-bars navbar-toggle-icon"></i>
        </span></div>
        <div class="overlay"></div>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="About us.php">About Us</a></li>
                <li><a href="Recipe Collection.php">Recipe Collection</a></li>
                <li><a href="Community Cookbook.php">Community Cookbook</a></li>
                <li><a href="Culinary Resources.php">Culinary Resources</a></li>
                <li><a href="Educational Resources.php"> Educational Resources</a></li>
                <li><a href="Contact us.php">Contact Us</a></li>
                <?php if(isset($_SESSION['user_id'])): ?>
                    <li><a href="logout.php">Logout (<?php echo explode(' ', $_SESSION['user_name'])[0]; ?>)</a></li>
                <?php else: ?>
                    <li><a href="Components/Login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <script>
        document.getElementById('menu-toggle').addEventListener('click', function() {
            const navUl = document.querySelector('nav ul');
            const overlay = document.querySelector('.overlay');
            const icon = document.querySelector('#menu-toggle i');
            navUl.classList.toggle('menu-open');
            overlay.classList.toggle('menu-open');
            icon.classList.toggle('fa-bars');
            icon.classList.toggle('fa-times');
        });

        document.querySelector('.overlay').addEventListener('click', function() {
            const navUl = document.querySelector('nav ul');
            const overlay = document.querySelector('.overlay');
            const icon = document.querySelector('#menu-toggle i');
            navUl.classList.remove('menu-open');
            overlay.classList.remove('menu-open');
            icon.classList.remove('fa-times');
            icon.classList.add('fa-bars');
        });
    </script>