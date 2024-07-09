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
$firstname = $_SESSION['firstname']; // Replace with actual session variable names
$lastname = $_SESSION['lastname']; // Replace with actual session variable names
$email = $_SESSION['email']; // Replace with actual session variable names
$phone = $_SESSION['phone']; // Replace with actual session variable names

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arizona Wildlife - My Profile</title>
    <link rel="stylesheet" href="standard.css">
    <link rel="stylesheet" href="styleprofile.css">
</head>
<body>
<div class="rectangle"></div>
    <div class="sidebar">
        <button class="LinktoHome" onclick="navigateTo('http://127.0.0.1/Home.html')">
            <img src="home.png">
        </button>
        <button class="LinktoProfile" onclick="navigateTo('http://127.0.0.1/myprofile.php')">
            <img src="profile.png">
        </button>
        <button class="LinktoExplore" onclick="navigateTo('http://127.0.0.1/explore.html')">
            <img src="search.png">
        </button>
        <button class="LinktoFeed" onclick="navigateTo('http://127.0.0.1/myfeed.php')">
            <img src="myfeed.png">
        </button>
        <button class="LinktoPost" onclick="navigateTo('http://127.0.0.1/createpost.php')">
            <img src="post.png">
        </button>
        <button class="LinktoFAQ" onclick="navigateTo('http://127.0.0.1/faq.html')">
            <img src="faq.png">
        </button>
        <button class="LinktoLogin" onclick="navigateTo('logout.php')">
            <img src="logout.png">
        </button>
    </div>
    <div class="profile-container">
        <h1>My Profile</h1>
        <div class="profile-info">
            <p><strong>Username:</strong> <?php session_start(); echo $username; ?></p>
            <p><strong>Name:</strong> <?php session_start(); echo "$firstname $lastname"; ?></p>
            <p><strong>Email:</strong> <?php session_start(); echo $email; ?></p>
            <p><strong>Phone:</strong> <?php session_start(); echo $phone; ?></p>
        </div>
    </div>
    <script>
        function navigateTo(url) {
            window.location.href = url;
        }
    </script>
</body>
</html>