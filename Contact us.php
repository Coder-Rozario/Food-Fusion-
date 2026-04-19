<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - FoodFusion</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<?php include 'Components/navbar.php'; ?>

    <section class="section-padding">
        <?php
        // messages if form was sent
        if (isset($_GET['success'])) {
            echo '<div class="alert alert-success contact-alert">
                    <b>Message sent!</b> We will get back to you soon.
                  </div>';
        }
        if (isset($_GET['error'])) {
            echo '<div class="alert alert-error contact-alert">
                    <b>Error:</b> ' . $_GET['error'] . '
                  </div>';
        }
        ?>
        <div class="contact-wrapper">
            <div class="contact-info">
                <h2>Get in Touch</h2>
                <p>Have a question about a recipe? Or maybe you want to share your culinary feedback with the FoodFusion community? We are here to help!</p>
                
                <div class="info-item">
                    <h4>Our Office</h4>
                    <p>123 Culinary Road, Foodie City, FC 456</p>
                </div>
                <div class="info-item">
                    <h4>Email Us</h4>
                    <p>support@foodfusion.com</p>
                </div>
                <div class="social-links">
                    <h4>Follow our journey</h4>
                    <div class="social-icons">
                        <a href="#" class="social-icon facebook"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="social-icon instagram"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" class="social-icon pinterest"><i class="fa-brands fa-pinterest-p"></i></a>
                        <a href="#" class="social-icon youtube"><i class="fa-brands fa-youtube"></i></a>
                    </div>
                </div>
            </div>

            <div class="contact-form-container">
                <form action="Process/contact_process.php" method="POST">
                    <h3>Send us a Message</h3>
                    
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="name" placeholder="Enter your name" value="<?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : ''; ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" placeholder="Enter your email" value="<?php echo isset($_SESSION['user_email']) ? $_SESSION['user_email'] : ''; ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Reason for Contact</label>
                        <select name="reason" required>
                            <option value="">-- Select an Option --</option>
                            <option value="enquiry">General Enquiry</option>
                            <option value="request">Recipe Request</option>
                            <option value="feedback">Feedback</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Your Message</label>
                        <textarea name="message" rows="5" placeholder="Write your enquiries, recipe requests or feedback here..." required></textarea>
                    </div>

                    <button type="submit" class="login-btn">Submit Message</button>
                </form>
            </div>
        </div>
    </section>

<?php include 'Components/footer.php'; ?>

</body>
</html>