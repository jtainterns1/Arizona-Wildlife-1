<?php
session_start(); // Ensure session is started
// // Check if user is logged in
if (!isset($_SESSION['username'])) {
    // Get the current server's IP address dynamically
    $server_ip = $_SERVER['SERVER_ADDR'];
    
    // Construct the redirect URL with the dynamic IP address
    $redirect_url = "http://$server_ip/login.html";
    
    // Redirect to the login page
    header("Location: $redirect_url");
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
        <button class="LinktoHome" onclick="navigateTo('Home.html')">
            <img src="home.png">
        </button>
        <button class="LinktoProfile" onclick="navigateTo('myprofile.php')">
            <img src="profile.png">
        </button>
        <button class="LinktoExplore" onclick="navigateTo('explore.html')">
            <img src="search.png">
        </button>
        <button class="LinktoFeed" onclick="navigateTo('myfeed.php')">
            <img src="myfeed.png">
        </button>
        <button class="LinktoPost" onclick="navigateTo('createpost.php')">
            <img src="post.png">
        </button>
        <button class="LinktoFAQ" onclick="navigateTo('faq.html')">
            <img src="faq.png">
        </button>
        <button class="LinktoLogin" onclick="navigateTo('logout.php')">
            <img src="logout.png">
        </button>
    </div>
    
    <script>
        function navigateTo(path) {
        // Get the current hostname (including IP address)
            var hostname = window.location.hostname;
            var url = 'http://' + hostname + '/' + path;
            window.location.href = url;
        }
    </script>
    <div class="profile-container">
        <h1>My Profile</h1>
        <div class="profile-info">
            <p><strong>Username:</strong> <?php echo $username; ?></p>
            <p><strong>Name:</strong> <?php echo $firstname $lastname; ?></p>
            <p><strong>Email:</strong> <?php echo $email; ?></p>
            <p><strong>Phone:</strong> <?php echo $phone; ?></p>
        </div>
    </div>
</body>
</html>