<?php
// Enable error reporting for debugging purposes
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Validate form data
if (empty($_POST["firstname"]) || empty($_POST["lastname"]) || empty($_POST["email"]) || empty($_POST["phone"]) || empty($_POST["username"]) || empty($_POST["password_hash"])) {
    die("All fields are required");
}

if (!(1 === preg_match('~[A-Z]~', $_POST["password_hash"]))){
    die("Your password must have at least one uppercase letter.");
}

if (!(1 === preg_match('~[a-z]~', $_POST["password_hash"]))){
    die("Your password must have at least one lowercase letter.");
}

if ( strlen($_POST["password_hash"]) < 12 || strlen($_POST["password_hash"]) > 80 ) {
    die("Your password must be more than 12, but less than 80 characters.");
}

if (!(1 === preg_match('~[0-9]~', $_POST["password_hash"]))) {
    die("Your password must contain a number.");
}

function specialChars($str) {
    $specialChars = '!@#$%^&*()-_=+[{]};:\'",<.>/?\\|';
    return strpbrk($str, $specialChars) !== false;
}

if (!(specialChars($str))) {
    die("Your password must contain a special character.");
}

// Sanitize inputs
$firstname = htmlspecialchars($_POST["firstname"]);
$lastname = htmlspecialchars($_POST["lastname"]);
$email = htmlspecialchars($_POST["email"]);
$phone = htmlspecialchars($_POST["phone"]);
$username = htmlspecialchars($_POST["username"]);
$password = password_hash($_POST["password_hash"], PASSWORD_DEFAULT);

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Please enter a valid email address."); 
}
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
    // Get the current server's IP address dynamically
    $server_ip = $_SERVER['SERVER_ADDR'];
    
    // Construct the redirect URL with the dynamic IP address
    $redirect_url = "http://$server_ip/login.html";
    
    // Redirect to the login page
    header("Location: $redirect_url");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

