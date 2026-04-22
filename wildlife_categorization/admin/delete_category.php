<?php
include 'auth.php';
$conn = new mysqli("localhost", "root", "", "wildlife_categorization");
$id = (int)$_GET['id'];
$conn->query("DELETE FROM category WHERE category_id=$id");
header("Location: manage_categories.php");
exit();
