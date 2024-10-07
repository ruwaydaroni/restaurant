<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database configuration
$host = 'localhost';
$db = 'restaurant';
$user = 'root'; // Your DB username
$pass = ''; // Your DB password

// Create a new mysqli instance
$conn = new mysqli($host, $user, $pass, $db);

// Check for connection errors
if ($conn->connect_error) {
    // Use a more secure way to handle connection errors in production
    die("Connection failed: " . $conn->connect_error);
}

// Optionally, set the character set for the connection
$conn->set_charset("utf8");

// Now you can use $conn for your queries
?>
