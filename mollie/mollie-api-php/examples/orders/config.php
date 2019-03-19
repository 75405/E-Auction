<?php
$servername = "localhost";
$username = "82128_DB";
$password = "#1Geheim";
$dbname = "82128_DB";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>