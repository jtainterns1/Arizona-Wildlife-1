<?php
session_start(); // Ensure session is started

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect or handle accordingly if not logged in
    // For example:
    header("Location: http://127.0.0.1/login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arizona Wildlife - My Feed</title>
    <link rel="stylesheet" href="standard.css">
</head>
<body>
    <h1> Feed </h1>
    <a class="LinktoHome" href="http://127.0.0.1/Home.html">
        Home
    </a>
    <a class="LinktoFeed" href="http://127.0.0.1/login.html">
        My Feed
    </a>
    <a class="LinktoExplore" href="http://127.0.0.1/explore.html">
        Explore
    </a>
    <a class="LinktoFAQ" href="http://127.0.0.1/faq.html">
        FAQ
    </a>
</body>
    <h5>Feed</h5>
    <p>Logged in as:
        
    </p>
</html>