<?php 
session_start();
// include database
include 'Components/db.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community Cookbook - FoodFusion</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

    <?php 
    // navbar include
    include 'Components/navbar.php'; 
    ?>

    <div class="container">
        <section class="edu-hero">
            <h1>Community Cookbook</h1>
            <p>Share your favorite recipes, cooking tips, and culinary experiences with the FoodFusion community. Let's cook together!</p>
        </section>

        <section class="content-block">
            <?php
            // check for success or error messages
            if (isset($_GET['success'])) {
                echo '<div class="alert alert-success">
                        <strong>Success!</strong> Your contribution has been shared successfully.
                      </div>';
            }
            if (isset($_GET['error'])) {
                echo '<div class="alert alert-error">
                        <strong>Error!</strong> ' . htmlspecialchars($_GET['error']) . '
                      </div>';
            }
            ?>
            <h2>Share Your Culinary Contribution</h2>
            <p class="section-intro">Contribute to our community cookbook by sharing your favorite recipes, cooking tips, and culinary experiences. Help others discover new flavors and techniques!</p>
            
            <div class="form-actions-center">
                <!-- button to show the form -->
                <button id="toggle-form-btn" class="login-btn btn-wide-rounded">Share a Contribution</button>
            </div>

            <div id="contribution-form-wrapper" class="hidden-section">
                <?php
                // get the logged in user info
                $uid = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
                $uname = "";
                $uemail = "";
                
                if ($uid > 0) {
                    $sql = "SELECT firstname, lastname, email FROM Users WHERE id = $uid";
                    $res = mysqli_query($con, $sql);
                    if ($row = mysqli_fetch_assoc($res)) {
                        $uname = $row['firstname'] . ' ' . $row['lastname'];
                        $uemail = $row['email'];
                    }
                }
                ?>
                <form action="Process/cookbook_process.php" method="POST" class="recipe-form" enctype="multipart/form-data">

                <div class="form-section">
                    <h3>Your Information</h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="your-name">Your Name *</label>
                            <input type="text" id="your-name" name="author_name" value="<?php echo $uname; ?>" placeholder="Enter your name" required readonly>
                        </div>
                        <div class="form-group">
                            <label for="your-email">Email (Optional)</label>
                            <input type="email" id="your-email" name="author_email" value="<?php echo $uemail; ?>" placeholder="your@email.com" readonly>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h3>What would you like to share? *</h3>
                    <div class="form-group">
                        <div class="radio-group">
                            <label class="radio-label">
                                <input type="radio" name="contribution_type" value="recipe" required>
                                <span class="radio-custom"></span>
                                Recipe
                            </label>
                            <label class="radio-label">
                                <input type="radio" name="contribution_type" value="tip" required>
                                <span class="radio-custom"></span>
                                Cooking Tip
                            </label>
                            <label class="radio-label">
                                <input type="radio" name="contribution_type" value="experience" required>
                                <span class="radio-custom"></span>
                                Culinary Experience
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-section hidden-section" id="recipe-section">
                    <h3>Recipe Details</h3>
                    <div class="form-group">
                        <label for="recipe-name">Recipe Name *</label>
                        <input type="text" id="recipe-name" name="recipe_name" placeholder="Enter recipe name">
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="cuisine-type">Cuisine Type *</label>
                            <select id="cuisine-type" name="cuisine_type">
                                <option value="">Select Cuisine</option>
                                <option value="italian">Italian</option>
                                <option value="asian">Asian</option>
                                <option value="mediterranean">Mediterranean</option>
                                <option value="mexican">Mexican</option>
                                <option value="indian">Indian</option>
                                <option value="american">American</option>
                                <option value="french">French</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="difficulty">Difficulty Level *</label>
                            <select id="difficulty" name="difficulty">
                                <option value="">Select Difficulty</option>
                                <option value="easy">Easy</option>
                                <option value="medium">Medium</option>
                                <option value="hard">Hard</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="dietary-preference">Dietary Preference *</label>
                            <select id="dietary-preference" name="dietary_preference">
                                <option value="none">None</option>
                                <option value="vegetarian">Vegetarian</option>
                                <option value="vegan">Vegan</option>
                                <option value="gluten-free">Gluten-Free</option>
                                <option value="pescatarian">Pescatarian</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="prep-time">Prep Time (minutes)</label>
                            <input type="number" id="prep-time" name="prep_time" placeholder="30" min="1">
                        </div>
                        <div class="form-group">
                            <label for="cook-time">Cook Time (minutes)</label>
                            <input type="number" id="cook-time" name="cook_time" placeholder="45" min="1">
                        </div>
                        <div class="form-group">
                            <label for="servings">Number of servings</label>
                            <input type="number" id="servings" name="servings" placeholder="4" min="1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ingredients">Ingredients *</label>
                        <textarea id="ingredients" name="ingredients" rows="4" placeholder="List ingredients..."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="instructions">Instructions *</label>
                        <textarea id="instructions" name="instructions" rows="6" placeholder="Step-by-step instructions..."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="recipe-image">Recipe Image *</label>
                        <input type="file" id="recipe-image" name="recipe_image" accept="image/*">
                        <small>Upload a photo of your finished dish</small>
                    </div>
                </div>

                <div class="form-section hidden-section" id="tip-section">
                    <h3>Cooking Tip Details</h3>
                    <div class="form-group">
                        <label for="tip-title">Tip Title *</label>
                        <input type="text" id="tip-title" name="tip_title" placeholder="e.g., Perfect Knife Skills">
                    </div>
                    <div class="form-group">
                        <label for="tip-category">Category *</label>
                        <select id="tip-category" name="tip_category">
                            <option value="">Select Category</option>
                            <option value="technique">Technique</option>
                            <option value="storage">Storage</option>
                            <option value="preparation">Preparation</option>
                            <option value="cooking">Cooking</option>
                            <option value="safety">Safety</option>
                            <option value="equipment">Equipment</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tip-description">Tip Description *</label>
                        <textarea id="tip-description" name="tip_description" rows="4" placeholder="Share your cooking tip..."></textarea>
                    </div>
                </div>

                <div class="form-section hidden-section" id="experience-section">
                    <h3>Culinary Experience Details</h3>
                    <div class="form-group">
                        <label for="experience-title">Story Title *</label>
                        <input type="text" id="experience-title" name="experience_title" placeholder="e.g., My First Souffle">
                    </div>
                    <div class="form-group">
                        <label for="experience-type">Experience Type *</label>
                        <select id="experience-type" name="experience_type">
                            <option value="">Select Type</option>
                            <option value="success">Success Story</option>
                            <option value="failure">Learning from Failure</option>
                            <option value="tradition">Family Tradition</option>
                            <option value="travel">Travel Experience</option>
                            <option value="restaurant">Restaurant Experience</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="experience-story">Your Story *</label>
                        <textarea id="experience-story" name="experience_story" rows="8" placeholder="Tell us your story..."></textarea>
                    </div>
                </div>

                <div class="form-actions-center">
                    <button type="submit" class="login-btn btn-medium-padding">Submit Contribution</button>
                    <button type="reset" id="cancel-btn" class="login-btn btn-medium-padding btn-secondary">Clear Form</button>
                </div>
            </form>
            </div>
        </section>

        <hr>

        <section class="content-block">
            <h2>Community Contributions</h2>
            
            <div class="section-margin-bottom">
                <h3>Recent Recipes</h3>
                <div class="resources-grid">
                    <?php
                    $sql = "SELECT r.*, u.firstname, u.lastname FROM Recipes r JOIN Users u ON r.user_id = u.id ORDER BY r.created_at DESC";
                    $res = mysqli_query($con, $sql);
                    if (mysqli_num_rows($res) > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $img = !empty($row['recipe_image']) ? 'Assets/Recipes/' . $row['recipe_image'] : 'Assets/cover.jpg';
                            
                            // JSON encode each value for safe passage to JS
                            $title = json_encode($row["recipe_name"]);
                            $ingredients = json_encode($row["ingredients"]);
                            $instructions = json_encode($row["instructions"]);
                            $image = json_encode($img);
                            $cuisine = json_encode($row["cuisine_type"] ?? 'N/A');
                            $difficulty = json_encode($row["difficulty"] ?? 'N/A');
                            $dietary = json_encode($row["dietary_preference"] ?? 'None');
                            $prep = json_encode($row["prep_time"] ?? 0);
                            $cook = json_encode($row["cook_time"] ?? 0);
                            $servings = json_encode($row["servings"] ?? 0);
                            ?>
                            <div class="resource-card cookbook-card" 
                                onclick='showRecipe(<?php echo htmlspecialchars($title, ENT_QUOTES); ?>, 
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
                                <div class="card-image" style="background-image: url('<?php echo $img; ?>');">
                                    <div class="card-overlay">
                                        <span class="view-btn">View Details</span>
                                    </div>
                                </div>
                                <div class="card-info">
                                    <h4><?php echo $row['recipe_name']; ?></h4>
                                    <p>By <?php echo $row['firstname'] . ' ' . $row['lastname']; ?></p>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo "<p>No recipes shared yet.</p>";
                    }
                    ?>
                </div>
            </div>

            <hr>

            <div class="section-margin-bottom">
                <h3>Cooking Tips</h3>
                <div class="tips-grid">
                    <?php
                    $sql = "SELECT t.*, u.firstname, u.lastname FROM CookingTips t JOIN Users u ON t.user_id = u.id ORDER BY t.created_at DESC";
                    $res = mysqli_query($con, $sql);
                    if (mysqli_num_rows($res) > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            ?>
                            <div class="tip-card">
                                <h4><?php echo $row['tip_title']; ?></h4>
                                <p><?php echo $row['tip_description']; ?></p>
                                <span class="tip-author">- <?php echo $row['firstname'] . ' ' . $row['lastname']; ?></span>
                            </div>
                            <?php
                        }
                    } else {
                        echo "<p>No tips shared yet.</p>";
                    }
                    ?>
                </div>
            </div>

            <hr>

            <div class="section-margin-bottom">
                <h3>Culinary Experiences</h3>
                <div class="experiences-grid">
                    <?php
                    $sql = "SELECT e.*, u.firstname, u.lastname FROM CookingExperiences e JOIN Users u ON e.user_id = u.id ORDER BY e.created_at DESC";
                    $res = mysqli_query($con, $sql);
                    if (mysqli_num_rows($res) > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            ?>
                            <div class="experience-card">
                                <h4><?php echo $row['experience_title']; ?></h4>
                                <p><?php echo substr($row['experience_story'], 0, 150) . '...'; ?></p>
                                <span class="experience-author">- <?php echo $row['firstname'] . ' ' . $row['lastname']; ?></span>
                            </div>
                            <?php
                        }
                    } else {
                        echo "<p>No experiences shared yet.</p>";
                    }
                    ?>
                </div>
            </div>
        </section>
    </div>

    <?php 
    include 'Components/footer.php'; 
    include 'Components/recipe_modal.php';
    ?>

    <script>
        // show or hide the form when button is clicked
        var toggleFormBtn = document.getElementById('toggle-form-btn');
        var formWrapper = document.getElementById('contribution-form-wrapper');

        toggleFormBtn.onclick = function() {
            // if not logged in, go to login
            <?php if(!isset($_SESSION['user_id'])): ?>
                window.location.href = 'Components/Login.php';
                return;
            <?php endif; ?>
            
            formWrapper.classList.toggle('hidden-section');
            if (formWrapper.classList.contains('hidden-section')) {
                toggleFormBtn.textContent = 'Share a Contribution';
            } else {
                toggleFormBtn.textContent = 'Hide Form';
            }
        };

        // handle the radio buttons to show the right section
        var radios = document.getElementsByName('contribution_type');
        var recipeSec = document.getElementById('recipe-section');
        var tipSec = document.getElementById('tip-section');
        var expSec = document.getElementById('experience-section');

        for (var i = 0; i < radios.length; i++) {
            radios[i].onchange = function() {
                // hide all first
                recipeSec.classList.add('hidden-section');
                tipSec.classList.add('hidden-section');
                expSec.classList.add('hidden-section');

                // show the selected one
                if (this.value == 'recipe') {
                    recipeSec.classList.remove('hidden-section');
                } else if (this.value == 'tip') {
                    tipSec.classList.remove('hidden-section');
                } else if (this.value == 'experience') {
                    expSec.classList.remove('hidden-section');
                }
            };
        }

        // clear button
        document.getElementById('cancel-btn').onclick = function() {
            if (confirm('Clear everything?')) {
                // let the default reset happen
            } else {
                return false;
            }
        };
    </script>
</body>
</html>