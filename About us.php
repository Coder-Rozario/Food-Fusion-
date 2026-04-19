<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - FoodFusion</title>
    <!-- CSS files -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

    <?php 
    // including the navigation bar
    include 'Components/navbar.php'; 
    ?>

    <main class="container">
        <!-- top section -->
        <section class="edu-hero">
            <h1>Our Culinary Story</h1>
            <p>FoodFusion is a culinary platform dedicated to promoting home cooking and fostering creativity among food enthusiasts around the world. We bridge the gap between tradition and innovation.</p>
        </section>

        <!-- philosophy part -->
        <section class="content-block philosophy-section">
            <div class="philosophy-container">
                <div class="philosophy-text">
                    <h2>Our Culinary Philosophy</h2>
                    <p>At FoodFusion, we believe that cooking is more than just preparing food - it is an art that brings people together. Our philosophy centers on the idea that everyone can be a great chef with the right guidance and inspiration. We focus on authentic flavors, fresh ingredients, and the happiness that comes from creating meals from scratch.</p>
                </div>
                <div class="philosophy-image">
                    <img src="Assets/cover.jpg" alt="Culinary Philosophy">
                </div>
            </div>
        </section>

        <hr>

        <!-- values we have -->
        <section class="content-block">
            <div class="section-header">
                <h2>Our Core Values</h2>
                <p>The principles that guide our culinary journey every day.</p>
            </div>
            <div class="values-grid">
                <div class="value-card">
                    <div class="value-icon"><i class="fas fa-users"></i></div>
                    <h4>Community First</h4>
                    <p>We build a warm community where food lovers can share experiences, learn from each other, and grow together as home cooks.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon"><i class="fas fa-lightbulb"></i></div>
                    <h4>Creativity</h4>
                    <p>We encourage everyone to experiment in the kitchen by providing recipes, tips, and inspiration to try new things.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon"><i class="fas fa-heart"></i></div>
                    <h4>Inclusion</h4>
                    <p>We welcome all types of cuisines and dietary needs, making sure everyone feels at home in our food community.</p>
                </div>
            </div>
        </section>

        <hr>

        <!-- team section -->
        <section class="content-block team-section">
            <div class="section-header">
                <h2>Meet Our Team</h2>
                <p>Our team is made up of professional chefs, nutrition experts, and web developers who work together to bring you the best cooking experience.</p>
            </div>
            
            <div class="team-grid">
                <!-- Sarah -->
                <div class="team-card">
                    <div class="team-img">
                        <img src="Assets/About/Images/Sarah Chen.jpg" alt="Sarah Chen">
                    </div>
                    <div class="team-info">
                        <h4>Sarah Chen</h4>
                        <span class="role">Head Chef & Founder</span>
                        <p>Expert in Asian and fusion cuisine with 15 years of experience in Michelin-star restaurants.</p>
                        <div class="team-social">
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>

                <!-- James -->
                <div class="team-card">
                    <div class="team-img">
                        <img src="Assets/About/Images/James Smith.jpg" alt="James Smith">
                    </div>
                    <div class="team-info">
                        <h4>James Smith</h4>
                        <span class="role">Lead Nutritionist</span>
                        <p>Certified nutritionist focused on creating healthy, balanced recipes for our vibrant community.</p>
                        <div class="team-social">
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
                
                <!-- Michael -->
                <div class="team-card">
                    <div class="team-img">
                        <img src="Assets/About/Images/Michael Shuvo Rozario.jpeg" alt="Michael Shuvo Rozario">
                    </div>
                    <div class="team-info">
                        <h4>Michael Shuvo Rozario</h4>
                        <span class="role">Lead Web Developer</span>
                        <p>Tech enthusiast building a seamless and enjoyable digital user experience for food lovers.</p>
                        <div class="team-social">
                            <a href="#"><i class="fab fa-github"></i></a>
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php 
    // footer include
    include 'Components/footer.php'; 
    ?>

</body>
</html>