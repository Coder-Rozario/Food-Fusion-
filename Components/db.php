<?php
// my database connection settings
// I'm using default xampp settings here
$host = "localhost";
$user = "root"; 
$pass = "";     
$db_name = "foodfusion_db";

// connect to the database now
$con = mysqli_connect($host, $user, $pass, $db_name);

// check if connection works properly
if (!$con) {
    // if it fails, just stop everything
    die("Connection failed: " . mysqli_connect_error());
}

// I added this part because I forgot to add the dietary_preference column in my sql file
// so this will add it automatically if it doesn't exist. bit of a hack but it works!
$sql = "SHOW COLUMNS FROM Recipes LIKE 'dietary_preference'";
$res = mysqli_query($con, $sql);
if (mysqli_num_rows($res) == 0) {
    $alter = "ALTER TABLE Recipes ADD COLUMN dietary_preference VARCHAR(100) DEFAULT 'none' AFTER servings";
    mysqli_query($con, $alter);
}
?>
