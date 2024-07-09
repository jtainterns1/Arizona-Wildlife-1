<?php
session_start(); // Ensure session is started

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect if not logged in
    header("Location: http://127.0.0.1/login.html");
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
if (isset($_FILES['image_url'])) {
    $file_name = $_FILES['image_url']['name'];
    $file_tmp = $_FILES['image_url']['tmp_name'];
    $file_size = $_FILES['image_url']['size'];
    
    // Check file size (adjust as needed)
    if ($file_size > 2097152) { // 2 MB
        die('File size exceeds limit.');
    }
    
    // Upload directory (make sure this directory exists and is writable)
    $upload_dir = "/var/html/image-uploads/"; // Adjust path as needed
    $file_path = $upload_dir . basename($file_name);
    
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
$stmt->bind_param("issiis", $user_id, $caption, $image_url, $likes, $comments, $time_stamp);

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

