<?php
include 'auth.php';
$conn = new mysqli("localhost", "root", "", "wildlife_categorization", 3307);
$id = (int)$_GET['id'];
$conn->query("DELETE FROM habitat WHERE habitat_id=$id");
header("Location: manage_habitats.php");
exit();
