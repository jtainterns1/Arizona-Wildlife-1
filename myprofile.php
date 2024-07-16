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

        // $username = $_SESSION['username'];
        // $firstname = $_SESSION['firstname']; // Replace with actual session variable names
        // $lastname = $_SESSION['lastname']; // Replace with actual session variable names
        // $email = $_SESSION['email']; // Replace with actual session variable names
        // $phone = $_SESSION['phone']; // Replace with actual session variable names

                // Database connection details (already connected in your case)
        $servername = "localhost";
        $username_db = "karina"; // Replace with your database username
        $password_db = "ArizonaWildlife1!"; // Replace with your database password
        $database = "wildlife_db";
        
        // Create connection
        $con = new mysqli($servername, $username_db, $password_db, $database);
        
        // Check connection
        if ($con->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }

        $sql = "SELECT * FROM users"; // Assuming you want to display posts in descending order of timestamp
    
        // $result = $con->query($sql);
        $result = mysqli_query($con, $sql);
        // $db->close();
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
        <h1 class="profile-header">My Profile</h1>
        <div class='profile-info'>
            <?php
                while($row = mysqli_fetch_assoc($result)){
            ?>

            <p>Username: <?php echo $row['username']; ?> </p>;
            <p>First Name: <?php echo $row['firstname']; ?> </p>;
            <p>Last Name: <?php echo $row['lastname']; ?> </p>;
            <p>Email: <?php echo $row['email']; ?> </p>;
            <p>Phone: <?php echo $row['phone']; ?> </p>;

            <?php
                }
            ?>
        </div>
    </div>
</body>
</html>