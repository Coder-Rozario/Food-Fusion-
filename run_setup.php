<?php
include 'Components/db.php';

$sql = file_get_contents('resources_setup.sql');

// Split the SQL into individual queries
$queries = explode(';', $sql);

foreach ($queries as $query) {
    $query = trim($query);
    if (!empty($query)) {
        if (mysqli_query($con, $query)) {
            echo "Successfully executed: " . substr($query, 0, 50) . "...<br>";
        } else {
            echo "Error executing: " . mysqli_error($con) . "<br>";
        }
    }
}

echo "<br>Setup complete! You can now delete this file.";
?>
