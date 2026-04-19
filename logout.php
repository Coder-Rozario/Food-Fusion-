<?php
// starting session first
session_start();

// clear all session variables
session_unset();

// destroy the session completely
session_destroy();

// send user back to the home page
header("Location: index.php");
exit;
?>
