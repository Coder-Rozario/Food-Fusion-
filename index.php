<?php 
session_start(); 
// connect to the db using the include file
include 'Components/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodFusion - Home</title>
    <!-- linking the stylesheet here -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <?php 
    // including the navigation bar
    include 'Components/navbar.php'; 
    ?>
    
    <section class="hero">
        <div class="hero-content">
            <h1>Welcome to FoodFusion</h1>
            <p>Our mission is to help people cook better and share their recipes with everyone. Join our community!</p>
            <button class="JoinUs-btn" onclick="open_popup()">Join Us</button>
        </div>
    </section>

    <section class="section-padding">
        <h3>Featured Recipes & Trends</h3>
        <div class="news-feed">
            <?php
            // get all the recipes from the database
            $get_recipes = "SELECT * FROM Recipes ORDER BY created_at DESC";
            $recipe_res = mysqli_query($con, $get_recipes);

            if (mysqli_num_rows($recipe_res) > 0) {
                while ($row = mysqli_fetch_assoc($recipe_res)) {
                    // figure out which image to show
                    if ($row['recipe_image'] != "") {
                        $img_path = 'Assets/Recipes/' . $row['recipe_image'];
                    } else {
                        $img_path = 'Assets/cover.jpg';
                    }
                    
                    // JSON encode each value for safe passage to JS
                    $title = json_encode($row["recipe_name"]);
                    $ingredients = json_encode($row["ingredients"]);
                    $instructions = json_encode($row["instructions"]);
                    $image = json_encode($img_path);
                    $cuisine = json_encode($row["cuisine_type"] ?? 'N/A');
                    $difficulty = json_encode($row["difficulty"] ?? 'N/A');
                    $dietary = json_encode($row["dietary_preference"] ?? 'None');
                    $prep = json_encode($row["prep_time"] ?? 0);
                    $cook = json_encode($row["cook_time"] ?? 0);
                    $servings = json_encode($row["servings"] ?? 0);
                    ?>
                    <div class="card" onclick='showRecipe(<?php echo htmlspecialchars($title, ENT_QUOTES); ?>, 
                                                         <?php echo htmlspecialchars($ingredients, ENT_QUOTES); ?>, 
                                                         <?php echo htmlspecialchars($instructions, ENT_QUOTES); ?>, 
                                                         <?php echo htmlspecialchars($image, ENT_QUOTES); ?>, 
                                                         <?php echo htmlspecialchars($cuisine, ENT_QUOTES); ?>, 
                                                         <?php echo htmlspecialchars($difficulty, ENT_QUOTES); ?>, 
                                                         <?php echo htmlspecialchars($dietary, ENT_QUOTES); ?>, 
                                                         <?php echo htmlspecialchars($prep, ENT_QUOTES); ?>, 
                                                         <?php echo htmlspecialchars($cook, ENT_QUOTES); ?>, 
                                                         <?php echo htmlspecialchars($servings, ENT_QUOTES); ?>)' 
                         style="cursor: pointer;">
                        <div class="card-image">
                            <img src="<?php echo $img_path; ?>" alt="<?php echo $row['recipe_name']; ?>">
                        </div>
                        <div class="card-content">
                            <h4><?php echo $row['recipe_name']; ?></h4>
                            <p><?php echo substr($row['instructions'], 0, 80) . '...'; ?></p>
                            <span class="see-more">Read more</span>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p class='no-recipes-message'>No recipes found right now.</p>";
            }
            ?>
        </div>
    </section>

    <section class="section-padding events-section">
        <h2>Upcoming Cooking Events</h2>
        <div class="carousel-container">
            <button class="carousel-btn prev" onclick="move_slide(-1)">&#10094;</button>
            
            <div class="carousel-track">
                <div class="event-card active">
                    <div class="event-image">
                        <img src="https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?auto=format&fit=crop&w=800&q=80" alt="Italian Cooking">
                    </div>
                    <div class="event-details">
                        <div class="event-info">
                            <h4>Mastering Italian Cuisine</h4>
                            <p class="event-date">Live Workshop - March 25, 2026</p>
                            <p class="event-desc">Learn how to make pasta and pizza like a pro from our chefs.</p>
                            <a href="javascript:void(0)" class="event-btn" onclick="open_popup()">Register Now</a>
                        </div>
                    </div>
                </div>
                
                <div class="event-card">
                    <div class="event-image">
                        <img src="https://images.unsplash.com/photo-1507048331197-7d4ac70811cf?auto=format&fit=crop&w=800&q=80" alt="Asian Fusion">
                    </div>
                    <div class="event-details">
                         <div class="event-info">
                        <h4>Asian Fusion Workshop</h4>
                        <p class="event-date">April 5, 2026 | 6:00 PM</p>
                        <p class="event-desc">Explore Asian flavors and learn to make sushi and stir-fry.</p>
                        <a href="javascript:void(0)" class="event-btn" onclick="open_popup()">Register Now</a>
                    </div>
                    </div>
                </div>
                
                <div class="event-card">
                    <div class="event-image">
                        <img src="https://images.unsplash.com/photo-1556909212-d5b604d0c90d?auto=format&fit=crop&w=800&q=80" alt="French Pastry">
                    </div>
                    <div class="event-details">
                        <div class="event-info">
                            <h4>French Pastry Masterclass</h4>
                            <p class="event-date">April 15, 2026 | 2:00 PM</p>
                            <p class="event-desc">Master the art of making croissants and macarons with Chef Marie.</p>
                            <a href="javascript:void(0)" class="event-btn" onclick="open_popup()">Register Now</a>
                        </div>
                    </div>
                </div>
                
                <div class="event-card">
                    <div class="event-image">
                        <img src="https://images.unsplash.com/photo-1514326640560-7d063ef2aed5?auto=format&fit=crop&w=800&q=80" alt="Healthy Cooking">
                    </div>
                    <div class="event-details">
                        <div class="event-info">
                            <h4>Healthy & Nutritious Cooking</h4>
                            <p class="event-date">April 22, 2026 | 5:00 PM</p>
                            <p class="event-desc">Cook healthy food that actually tastes good!</p>
                            <a href="javascript:void(0)" class="event-btn" onclick="open_popup()">Register Now</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <button class="carousel-btn next" onclick="move_slide(1)">&#10095;</button>
        </div>
        
        <div class="carousel-dots">
            <span class="dot active" onclick="go_to_slide(0)"></span>
            <span class="dot" onclick="go_to_slide(1)"></span>
            <span class="dot" onclick="go_to_slide(2)"></span>
            <span class="dot" onclick="go_to_slide(3)"></span>
        </div>
    </section>

    <!-- popup for joining -->
    <div id="joinPopup" class="popup">
        <div class="popup-content">
            <span class="close" onclick="close_popup()">&times;</span>
            <h2>Join Us</h2>
            <form action="Process/register_process.php" method="POST">
                <input type="text" name="firstname" placeholder="First Name" required>
                <input type="text" name="lastname" placeholder="Last Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" class="login-btn">Sign Up Now</button>
            </form>
        </div>
    </div>

    <!-- banner for cookies -->
    <div id="cookieBanner" class="cookie-banner">
        <p>We use cookies on this site. Check our <a href="Privacy Policy.php">Privacy Policy</a> if you want to know more.</p>
        <button onclick="accept_cookies()">Accept</button>
    </div>

    <?php 
    include 'Components/footer.php'; 
    include 'Components/recipe_modal.php';
    ?>

    <!-- javascript -->

    <script>
        // handling the cookies acceptance
        function accept_cookies() {
            document.getElementById('cookieBanner').style.display = 'none';
            localStorage.setItem('cookiesAccepted', 'true');
        }

        window.onload = function() {
            if (localStorage.getItem('cookiesAccepted')) {
                document.getElementById('cookieBanner').style.display = 'none';
            }
        }

        // functions for opening and closing the popup
        function open_popup() {
            document.getElementById("joinPopup").style.display = "block";
        }

        function close_popup() {
            document.getElementById("joinPopup").style.display = "none";
        }

        // simple carousel logic
        var slideIndex = 0;

        function show_slides(n) {
            var slides = document.getElementsByClassName("event-card");
            var dots = document.getElementsByClassName("dot");
            
            if (n >= slides.length) {
                slideIndex = 0;
            } else if (n < 0) {
                slideIndex = slides.length - 1;
            } else {
                slideIndex = n;
            }

            for (var i = 0; i < slides.length; i++) {
                slides[i].classList.remove("active");
                dots[i].classList.remove("active");
            }
            
            slides[slideIndex].classList.add("active");
            dots[slideIndex].classList.add("active");
        }

        function move_slide(n) {
            show_slides(slideIndex + n);
        }

        function go_to_slide(n) {
            show_slides(n);
        }
    </script>
</body>
</html>