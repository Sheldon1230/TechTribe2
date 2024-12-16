<?php
$host = "localhost";       // Your database host
$user = "root";            // Your database username (default for XAMPP is 'root')
$pass = "";                // Your database password (default for XAMPP is '')
$dbname = "webtribe_db";   // Database name

$conn = new mysqli($host, $user, $pass, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>

