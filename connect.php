<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "posts";

// Establish connection to MySQL database
$conn = mysqli_connect($host, $user, $pass, $db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

