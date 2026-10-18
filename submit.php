<?php
// Database connection settings
$host     = "localhost";
$dbUser   = "root";   // change if needed
$dbPass   = "";       // change if needed
$dbName   = "insta";

$conn = new mysqli($host, $dbUser, $dbPass, $dbName);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name     = trim($_POST["name"] ?? "");
    $password = $_POST["password"] ?? "";
    $mobile   = trim($_POST["mobile"] ?? "");

    // Basic validation
    if ($name === "" || strlen($name) > 50 || $password === "" || !preg_match('/^[0-9]{10}$/', $mobile)) {
        die("Invalid input. Please go back and fill the form correctly.");
    }

    // Hash the password (never store plain text)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepared statement prevents SQL injection
    $stmt = $conn->prepare("INSERT INTO users (name, mobile, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $mobile, $hashedPassword);

    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>