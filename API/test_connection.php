<?php
// Include database connection
include("db_connect.php");

// Check if connection exists
if ($conn) {
    echo " Database connected successfully!";
} else {
    echo "Database connection failed!";
}
?>