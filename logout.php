<?php
session_start(); // Start session

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to login page or homepage after logout
header("Location: login.html");
exit();
?>