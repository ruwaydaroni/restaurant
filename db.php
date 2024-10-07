<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


$host = 'localhost';
$db = 'restaurant';
$user = 'root'; 
$pass = ''; 


$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");

?>
