<?php
session_start(); // Ensure session is started

// // Check if user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect or handle accordingly if not logged in
    // For example:
    header("Location: http://127.0.0.1/login.html");
    exit();
}

$username = $_SESSION['username'];
// $result = $post->get_posts($username, $_POST);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arizona Wildlife - Create a Post</title>
    <link rel="stylesheet" href="standard.css">
    <link rel="stylesheet" href="stylecreatepost.css">

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
    
    <script>
        function navigateTo(url) {
            window.location.href = url;
        }
    </script>
    <div class="container">
        <h1>Create a Post</h1>
        <form method="post" action="process_post.php">
            <div class="form-group">
                <label for="image_url">Upload Image</label>
                <input type="file" id="image_url" name="image_url" accept="image/*" required>
            </div>
            <div class="form-group">
                <label for="caption">Caption</label>
                <input type="text" id="caption" name="caption" placeholder="Enter caption">
            </div>
            <input type="submit" class="button" value="Post" name="post">
        </form>
    </div>
</body>
</html>