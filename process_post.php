<?php
session_start(); // Ensure session is started

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect or handle accordingly if not logged in
    // For example:
    header("Location: http://127.0.0.1/login.html");
    exit();
}

// Validate form data
if (empty($_POST["image_url"])) {
    die("Image URL is required.");
}

// Retrieve and sanitize inputs
$user_id = $_SESSION["user_id"]; // Assuming you have stored user_id in session
$username = $_SESSION["username"];
$caption = htmlspecialchars($_POST["caption"]);
$image_url = ""; // Initialize to empty string for now, since you're handling file upload separately
$likes = 0; // Initialize likes to 0
$comments = 0; // Initialize comments to 0
$time_stamp = date('Y-m-d H:i:s');

// File upload handling
if (isset($_FILES['image'])) {
    $file_name = $_FILES['image']['name'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $file_size = $_FILES['image']['size'];
    
    // Check file size (example check, adjust as needed)
    if ($file_size > 2097152) { // 2 MB
        die('File size exceeds limit.');
    }
    
    // Upload directory (make sure this directory exists and is writable)
    $upload_dir = "uploads/";
    $file_path = $upload_dir . $file_name;
    
    // Move uploaded file to specified directory
    if (move_uploaded_file($file_tmp, $file_path)) {
        $image_url = $file_path; // Save file path to database
    } else {
        die('Error uploading file.');
    }
}

// Database connection details
$servername = "localhost";
$username_db = "karina"; // Replace with your database username
$password_db = "ArizonaWildlife1!"; // Replace with your database password
$database = "wildlife_db";

// Create connection
$conn = new mysqli($servername, $username_db, $password_db, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind parameters for SQL query
$stmt = $conn->prepare("INSERT INTO posts (user_id, caption, image_url, likes, comments, time_stamp) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("isssss", $user_id, $caption, $image_url, $likes, $comments, $time_stamp);

// Execute statement
if ($stmt->execute()) {
    // Post creation successful, redirect to feed page
    header("Location: http://127.0.0.1/myfeed.php");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
