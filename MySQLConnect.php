<?php
$servername = "localhost";
$username = "webclient";
$password = "12345678";
$database = "bookstore";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//$conn->select_db("bookstore");
//echo "Database connected!";
?>