<?php
include 'auth.php';
$conn = new mysqli("localhost", "root", "", "wildlife_categorization");
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $conn->real_escape_string($_POST['category_name']);
    $conn->query("INSERT INTO category (category_name) VALUES ('$name')");
    header("Location: manage_categories.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Category</title>
</head>
<body>
    <h1>Add Category</h1>
    <form method="post">
        <label>Category Name: <input type="text" name="category_name" required></label><br>
        <button type="submit">Add</button>
    </form>
</body>
</html>
