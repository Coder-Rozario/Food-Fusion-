<?php
session_start();
// Database connection
include '../Components/db.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // User must be logged in
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../Components/Login.php?error=Login required!");
        exit;
    }

    $user_id = $_SESSION['user_id'];
    $post_type = $_POST['contribution_type'];

    // Handle Recipe sharing
    if ($post_type == 'recipe') {
        $recipe_name = mysqli_real_escape_string($con, $_POST['recipe_name']);
        $cuisine = mysqli_real_escape_string($con, $_POST['cuisine_type']);
        $difficulty = mysqli_real_escape_string($con, $_POST['difficulty']);
        $dietary = mysqli_real_escape_string($con, $_POST['dietary_preference']);
        $prep = (int)$_POST['prep_time'];
        $cook = (int)$_POST['cook_time'];
        $servings = (int)$_POST['servings'];
        $ingredients = mysqli_real_escape_string($con, $_POST['ingredients']);
        $instructions = mysqli_real_escape_string($con, $_POST['instructions']);
        
        // Handle image upload
        $target_dir = "../Assets/Recipes/";
        $new_img_name = time() . "_" . $_FILES["recipe_image"]["name"];
        move_uploaded_file($_FILES["recipe_image"]["tmp_name"], $target_dir . $new_img_name);

        $query = "INSERT INTO Recipes (user_id, recipe_name, cuisine_type, difficulty, dietary_preference, prep_time, cook_time, servings, ingredients, instructions, recipe_image) 
                  VALUES ('$user_id', '$recipe_name', '$cuisine', '$difficulty', '$dietary', '$prep', '$cook', '$servings', '$ingredients', '$instructions', '$new_img_name')";

    // Handle Cooking Tip
    } elseif ($post_type == 'tip') {
        $tip_title = mysqli_real_escape_string($con, $_POST['tip_title']);
        $tip_cat = mysqli_real_escape_string($con, $_POST['tip_category']);
        $tip_desc = mysqli_real_escape_string($con, $_POST['tip_description']);

        $query = "INSERT INTO CookingTips (user_id, tip_title, tip_category, tip_description) 
                  VALUES ('$user_id', '$tip_title', '$tip_cat', '$tip_desc')";

    // Handle Experience sharing
    } elseif ($post_type == 'experience') {
        $exp_title = mysqli_real_escape_string($con, $_POST['experience_title']);
        $exp_type = mysqli_real_escape_string($con, $_POST['experience_type']);
        $exp_story = mysqli_real_escape_string($con, $_POST['experience_story']);

        $query = "INSERT INTO CookingExperiences (user_id, experience_title, experience_type, experience_story) 
                  VALUES ('$user_id', '$exp_title', '$exp_type', '$exp_story')";
    }

    // Run the query and redirect
    if (mysqli_query($con, $query)) {
        header("Location: ../Community Cookbook.php?success=1");
    } else {
        header("Location: ../Community Cookbook.php?error=Database error!");
    }
}
?>
