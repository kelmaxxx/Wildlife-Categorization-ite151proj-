<?php
include 'auth.php';
$conn = new mysqli("localhost", "root", "", "wildlife_categorization");
$id = (int)$_GET['id'];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $conn->real_escape_string($_POST['category_name']);
    $conn->query("UPDATE category SET category_name='$name' WHERE category_id=$id");
    header("Location: manage_categories.php");
    exit();
}
$result = $conn->query("SELECT * FROM category WHERE category_id=$id");
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Category</title>
</head>
<body>
    <h1>Edit Category</h1>
    <form method="post">
        <label>Category Name: <input type="text" name="category_name" value="<?= htmlspecialchars($row['category_name']) ?>" required></label><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
