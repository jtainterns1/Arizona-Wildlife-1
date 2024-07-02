<?php
session_start(); // Ensure session is started

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect or handle accordingly if not logged in
    // For example:
    header("Location: http://127.0.0.1/login.html");
    exit();
}

$username = $_SESSION['username'];

// Example: Display logged-in user's username
echo "$username 's feed!";
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
    <h5> Feed </h5>
    <div class="rectangle"></div>
    <div class="sidebar">
        <button class="LinktoHome" href= "http://127.0.0.1/Home.html">
            <img src= "home.png">
        </button>
        <button class="LinktoProfile" href= "http://127.0.0.1/myprofile.html">
            <img src= "profile.png">
        </button>
        <button class="LinktoExplore" href= "http://127.0.0.1/explore.html">
            <img src= "search.png">
        </button>
        <button class="LinktoFeed" href= "http://127.0.0.1/myfeed.html">
            <img src= "feed.jfif">
        </button>
        <button class="LinktoPost" href= "http://127.0.0.1/post.html">
            <img src= "post.png">
        </button>
        <button class="LinktoFAQ" href= "http://127.0.0.1/faq.html">
            <img src= "faq.png">
        </button>
        <button class="LinktoLogin" href= "logout.php">
            <img src= "logout.png">
        </button>
    </div>
</body>
</html>