<?php
$host = 'localhost';
$user = 'root';
$password = ''; // Use your real password if not empty
$database = 'wildlife_categorization';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
