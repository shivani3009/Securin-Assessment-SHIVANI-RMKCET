<?php
$host = 'localhost';
$dbname = 'securin';
$username = 'root';
$password = 'root';
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
