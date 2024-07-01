<?php

// Validate form data
if (empty($_POST["first"]) || empty($_POST["last"]) || empty($_POST["email"]) || empty($_POST["phone"]) || empty($_POST["user"]) || empty($_POST["pass"])) {
    die("All fields are required");
}

// Sanitize inputs
$firstname = htmlspecialchars($_POST["first"]);
$lastname = htmlspecialchars($_POST["last"]);
$email = htmlspecialchars($_POST["email"]);
$phone = htmlspecialchars($_POST["phone"]);
$username = htmlspecialchars($_POST["user"]);
$password = password_hash($_POST["pass"], PASSWORD_DEFAULT);

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

// Prepare SQL statement with prepared statement
$stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, phone, username, password_hash) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $firstname, $lastname, $email, $phone, $username, $password);

// Execute statement
if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
