<?php
// Enable error reporting for debugging purposes
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Validate form data
if (empty($_POST["username"]) || empty($_POST["password"])) {
    die("Username and password are required");
}

// Sanitize inputs
$username = htmlspecialchars($_POST["username"]);
$password = $_POST["password"]; // Password is already hashed in database

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
$stmt = $conn->prepare("SELECT id, password_hash FROM users WHERE username = ?");
$stmt->bind_param("s", $username);

// Execute statement
$stmt->execute();

// Bind result variables
$stmt->bind_result($user_id, $hashed_password);

// Fetch and verify user
if ($stmt->fetch()) {
    // Verify hashed password
    if (password_verify($password, $hashed_password)) {
        // Password is correct, set session variables and redirect to home page or dashboard
        session_start();
        $_SESSION['id'] = $user_id;
        $_SESSION['username'] = $username;
        header("Location: myfeed.html");
        exit();
    } else {
        // Password is incorrect
        echo "Incorrect password";
    }
} else {
    // Username not found
    echo "Username not found";
}

$stmt->close();
$conn->close();
?>

<!-- error_reporting(E_ALL);
ini_set('display_errors', 1);

// Validate form data
if (empty($_POST["username"]) || empty($_POST["password"])) {
    die("Username and password are required");
}

if ($_SERVER["REQUEST_METHOD"] ==="POST"){
    $mysqli = REQUIRE _DIR_ . "/user_table.php";

    $sql = sprintf(SELECT * FROM user
                    WHERE email = '%s',
                    $mysqli->real_escape_string($_POST["email"]));

    $result = $mysqli->query($sql);

    $user = $result->FETCH_ASSOC();

    if ($user) {
        if (password_verify($_POST["password"], $user["password_hash"])) {
            die("Login successful");
        }
    }

} -->
