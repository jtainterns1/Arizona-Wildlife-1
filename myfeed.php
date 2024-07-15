<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arizona Wildlife - My Feed</title>
    <link rel="stylesheet" href="standard.css">
    <link rel="stylesheet" href="stylefeed.css">
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
</div>
<?php
session_start(); // Ensure session is started
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
    
    // Database connection details (already connected in your case)
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
    
    // Query to fetch posts
    $sql = "SELECT * FROM posts ORDER BY time_stamp DESC"; // Assuming you want to display posts in descending order of timestamp
    
    $result = $db->query($sql);
    ?>

    <div class="feed-container">
    <h5 class="feed-header"> Feed </h5>
        <?php
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                // Display caption and any other details you want
                echo "<div>";
                echo "<h3>" . htmlspecialchars($row["caption"]) . "</h3>";
                echo "<p>Posted by: " . htmlspecialchars($row["user_id"]) . "</p>"; // Assuming you have stored username in posts table
                echo "<p>Posted on: " . htmlspecialchars($row["time_stamp"]) . "</p>";
                echo "</div>";
            }
        } else {
            echo "No posts found.";
        }
        $db->close();
        ?>
    </div>
    
    <!-- <div class="feed-container">
        
        <div class="post">
            <div class="post-header">
                <img src="profile1.jpg" alt="Profile Picture">
                <span>Username</span>
            </div>
            <div class="post-content">
                
                <div style="height: 300px; background-color: #ccc;"></div>
            </div>
            <div class="post-actions">
                <button class="like-btn">Like</button>
                <button class="comment-btn">Comment</button>
            </div>
        </div>
    </div> -->
</body>
</html>