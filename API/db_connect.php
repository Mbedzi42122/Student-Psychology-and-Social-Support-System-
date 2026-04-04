<?php
// Database credentials
$host = "localhost";
$username = "root";      // default for XAMPP
$password = "";          // default is empty
$database = "spss_db";   // your database name

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: set charset
$conn->set_charset("utf8");

// If you want, you can echo success (but usually we keep this silent)
// echo "Connected successfully";
?>