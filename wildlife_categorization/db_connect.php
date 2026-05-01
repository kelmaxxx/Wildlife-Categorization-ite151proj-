<?php
$host = 'localhost';
$user = 'root';
$password = ''; // MySQL Server password
$database = 'wildlife_categorization';

$conn = new mysqli($host, $user, $password, $database, 3307);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
