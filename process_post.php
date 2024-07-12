<?php
session_start(); // Ensure session is started

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    // Get the current server's IP address dynamically
    $server_ip = $_SERVER['SERVER_ADDR'];
    
    // Construct the redirect URL with the dynamic IP address
    $redirect_url = "http://$server_ip/login.html";
    
    // Redirect to the login page
    header("Location: $redirect_url");
    exit();
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Validate form data
if (empty($_POST["caption"])) {
    die("Caption is required.");
}

// Retrieve and sanitize inputs
$user_id = $_SESSION["user_id"]; // Assuming you have stored user_id in session
$username = $_SESSION["username"];
$caption = htmlspecialchars($_POST["caption"]);
$likes = 0; // Initialize likes to 0
$comments = 0; // Initialize comments to 0
$time_stamp = date('Y-m-d H:i:s');

// File upload handling
// File upload handling
if (isset($_POST['post!'])) {
    $filename = $_FILES["image_url"]["name"];
    $tempname = $_FILES["image_url"]["tmp_name"];
    $folder = "/var/www/html/image-uploads/" . $filename;
    
    // Check file size (adjust as needed)
    $file_size = $_FILES['image_url']['size'];
    if ($file_size > 2097152) { // 2 MB
        die('File size exceeds limit.');
    }
    
    // Move uploaded file to specified directory
    if (move_uploaded_file($tempname, $folder)) {
        echo "File uploaded successfully.";
    } else {
        echo "Failed to upload file.";
    }

    
    // Upload directory (make sure this directory exists and is writable)
    // $upload_dir = "/var/html/image-uploads/"; // Adjust path as needed
    // $file_path = $upload_dir . basename($file_name);
    // $image_url = $file_path;
    
    // // Move uploaded file to specified directory
    // if (move_uploaded_file($file_tmp, $file_path)) {
    //     $image_url = $file_path; // Save file path to database
    // } else {
    //     die('Error uploading file.');
    // }

    // Database connection details
$servername = "localhost";
$username_db = "karina"; // Replace with your database username
$password_db = "ArizonaWildlife1!"; // Replace with your database password
$database = "wildlife_db";
    $db = mysqli_connect($servername, $username_db, $password_db, $database);
 
    // Get all the submitted data from the form
    $sql = "INSERT INTO posts (user_id, caption, image_url, likes, comments, time_stamp) VALUES (?, ?, ?, ?, ?, ?)";
 
    // Execute query
    mysqli_query($db, $sql);
 
}


// // Create connection
// $conn = new mysqli($servername, $username_db, $password_db, $database);

// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// // Prepare and bind parameters for SQL query
// $stmt = $conn->prepare("INSERT INTO posts (user_id, caption, image_url, likes, comments, time_stamp) VALUES (?, ?, ?, ?, ?, ?)");
// $stmt->bind_param("issiis", $user_id, $caption, $image_url, $likes, $comments, $time_stamp);

// // Execute statement
// if ($stmt->execute()) {
//     // Post creation successful, redirect to feed page
//     header("Location: http://127.0.0.1/myfeed.php");
//     exit();
// } else {
//     echo "Error: " . $stmt->error;
// }

// $stmt->close();
// $conn->close();
?>

