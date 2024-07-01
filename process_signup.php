<?php
// Enable error reporting for debugging purposes
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Validate form data
if (empty($_POST["firstname"]) || empty($_POST["lastname"]) || empty($_POST["email"]) || empty($_POST["phone"]) || empty($_POST["username"]) || empty($_POST["password_hash"])) {
    die("All fields are required");
}

// Sanitize inputs
$firstname = htmlspecialchars($_POST["firstname"]);
$lastname = htmlspecialchars($_POST["lastname"]);
$email = htmlspecialchars($_POST["email"]);
$phone = htmlspecialchars($_POST["phone"]);
$username = htmlspecialchars($_POST["username"]);
$password = password_hash($_POST["password_hash"], PASSWORD_DEFAULT);

// Timestamp for registration date
$reg_date = date('Y-m-d H:i:s');

// Database connection parameters
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

// Prepare and bind parameters
$stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, phone, username, password_hash, reg_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $firstname, $lastname, $email, $phone, $username, $password, $reg_date);

// Execute statement
if ($stmt->execute()) {
    // Registration successful, redirect to login page
    header("Location: http://127.0.0.1/login.html");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

