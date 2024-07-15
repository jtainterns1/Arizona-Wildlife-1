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

// Database connection details
$servername = "localhost";
$username_db = "karina"; // Replace with your database username
$password_db = "ArizonaWildlife1!"; // Replace with your database password
$database = "wildlife_db";

// Create connection
$db = new mysqli($servername, $username_db, $password_db, $database);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Query to retrieve posts
$query = "SELECT p.*, u.username FROM posts p INNER JOIN users u ON p.user_id = u.user_id ORDER BY p.time_stamp DESC";
$result = $db->query($query);

// Initialize an array to store posts
$posts = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $posts[] = $row;
    }
}

$db->close();
?>
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
<div class="feed-header">
        Feed
    </div>
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
    <div class="feed-container">
        <!-- Placeholder posts -->
        <div class="post">
            <div class="post-header">
                <img src="profile1.jpg" alt="Profile Picture">
                <span>Username</span>
            </div>
            <div class="post-content">
                <!-- Placeholder for image, adjust size as needed -->
                <div style="height: 300px; background-color: #ccc;"></div>
            </div>
            <div class="post-actions">
                <button class="like-btn">Like</button>
                <button class="comment-btn">Comment</button>
            </div>
        </div>
    </div>
</body>
</html>