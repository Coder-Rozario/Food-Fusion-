<?php
session_start();
// include database connection
include 'Components/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Collection - FoodFusion</title>
    <!-- CSS and FontAwesome -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

    <?php 
    // including the navbar component
    include 'Components/navbar.php'; 
    ?>

    <div class="container">
        <section class="edu-hero">
            <h1>Recipe Collection</h1>
            <p>Here you can find all the recipes we have. We categorized them by cuisine, diet, and difficulty.</p>
        </section>

        <!-- Showing Cuisine Types -->
        <section class="content-block">
            <h2>Cuisine Types</h2>
            <p class="section-intro">Look at recipes from different parts of the world.</p>
            
            <div class="resources-grid">
                <?php
                // I'm doing a loop for each cuisine type I want to show
                $cuisines_list = array('italian', 'asian', 'mediterranean', 'other');
                foreach ($cuisines_list as $c_type) {
                    // join recipes with users to get the author name
                    $sql = "SELECT Recipes.*, Users.firstname, Users.lastname 
                            FROM Recipes 
                            JOIN Users ON Recipes.user_id = Users.id 
                            WHERE Recipes.cuisine_type = '$c_type' 
                            ORDER BY Recipes.created_at DESC LIMIT 4";
                    $result = mysqli_query($con, $sql);
                    
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            // if there's no image, use the default cover
                            if ($row['recipe_image'] != "") {
                                $img_src = 'Assets/Recipes/' . $row['recipe_image'];
                            } else {
                                $img_src = 'Assets/cover.jpg';
                            }
                            
                            // JSON encode each value for safe passage to JS
                            $title = json_encode($row["recipe_name"]);
                            $ingredients = json_encode($row["ingredients"]);
                            $instructions = json_encode($row["instructions"]);
                            $image = json_encode($img_src);
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
                                <div class="card-image" style="background-image: url('<?php echo $img_src; ?>');">
                                    <div class="card-overlay">
                                        <span class="view-btn">View Details</span>
                                    </div>
                                </div>
                                <div class="card-info">
                                    <h4><?php echo $row['recipe_name']; ?></h4>
                                    (<?php echo ucfirst($c_type); ?>)
                                    <p>Shared by <?php echo $row['firstname'] . ' ' . $row['lastname']; ?> </p>
                                </div>
                            </div>
                            <?php
                        }
                    }
                }
                ?>
            </div>
        </section>

        <hr>

        <!-- Showing Dietary Preferences -->
        <section class="content-block">
            <h2>Dietary Preferences</h2>
            <p class="section-intro">Recipes for people with different diets.</p>
            
            <div class="resources-grid">
                <?php
                $diet_list = array('vegetarian', 'vegan', 'gluten-free', 'pescatarian');
                foreach ($diet_list as $d_pref) {
                    $sql_diet = "SELECT Recipes.*, Users.firstname, Users.lastname 
                                 FROM Recipes 
                                 JOIN Users ON Recipes.user_id = Users.id 
                                 WHERE Recipes.dietary_preference = '$d_pref' 
                                 ORDER BY Recipes.created_at DESC LIMIT 4";
                    $res_diet = mysqli_query($con, $sql_diet);
                    
                    if (mysqli_num_rows($res_diet) > 0) {
                        while ($row = mysqli_fetch_assoc($res_diet)) {
                            if ($row['recipe_image'] != "") {
                                $img_src = 'Assets/Recipes/' . $row['recipe_image'];
                            } else {
                                $img_src = 'Assets/cover.jpg';
                            }
                            
                            // JSON encode each value for safe passage to JS
                            $title = json_encode($row["recipe_name"]);
                            $ingredients = json_encode($row["ingredients"]);
                            $instructions = json_encode($row["instructions"]);
                            $image = json_encode($img_src);
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
                                <div class="card-image" style="background-image: url('<?php echo $img_src; ?>');">
                                    <div class="card-overlay">
                                        <span class="view-btn">View Details</span>
                                    </div>
                                </div>
                                <div class="card-info">
                                    <h4><?php echo $row['recipe_name']; ?></h4>
                                    (<?php echo ucfirst($d_pref); ?>)
                                    <p>Shared by <?php echo $row['firstname'] . ' ' . $row['lastname']; ?></p>
                                </div>
                            </div>
                            <?php
                        }
                    }
                }
                ?>
            </div>
        </section>

        <hr>

        <!-- Showing Cooking Difficulty -->
        <section class="content-block">
            <h2>Cooking Difficulty</h2>
            <p class="section-intro">From easy recipes to hard ones!</p>
            
            <div class="resources-grid">
                <?php
                $diff_list = array('easy', 'medium', 'hard');
                foreach ($diff_list as $d_level) {
                    $sql_diff = "SELECT Recipes.*, Users.firstname, Users.lastname 
                                 FROM Recipes 
                                 JOIN Users ON Recipes.user_id = Users.id 
                                 WHERE Recipes.difficulty = '$d_level' 
                                 ORDER BY Recipes.created_at DESC LIMIT 4";
                    $res_diff = mysqli_query($con, $sql_diff);
                    
                    if (mysqli_num_rows($res_diff) > 0) {
                        while ($row = mysqli_fetch_assoc($res_diff)) {
                            if ($row['recipe_image'] != "") {
                                $img_src = 'Assets/Recipes/' . $row['recipe_image'];
                            } else {
                                $img_src = 'Assets/cover.jpg';
                            }
                            
                            // JSON encode each value for safe passage to JS
                            $title = json_encode($row["recipe_name"]);
                            $ingredients = json_encode($row["ingredients"]);
                            $instructions = json_encode($row["instructions"]);
                            $image = json_encode($img_src);
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
                                <div class="card-image" style="background-image: url('<?php echo $img_src; ?>');">
                                    <div class="card-overlay">
                                        <span class="view-btn">View Details</span>
                                    </div>
                                </div>
                                <div class="card-info">
                                    <h4><?php echo $row['recipe_name']; ?></h4>
                                    (<?php echo ucfirst($d_level); ?>)
                                    <p>Shared by <?php echo $row['firstname'] . ' ' . $row['lastname']; ?></p>
                                </div>
                            </div>
                            <?php
                        }
                    }
                }
                ?>
            </div>
        </section>

    </div>

    <?php 
    // include footer
    include 'Components/footer.php'; 
    include 'Components/recipe_modal.php';
    ?>

</body>
</html>