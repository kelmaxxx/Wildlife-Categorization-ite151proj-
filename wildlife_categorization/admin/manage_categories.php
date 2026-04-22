<?php
include 'auth.php';
$conn = new mysqli("localhost", "root", "", "wildlife_categorization");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$result = $conn->query("SELECT * FROM category");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Categories</title>
</head>
<body>
    <h1>Categories</h1>
    <a href="add_category.php">Add New Category</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Category Name</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['category_id'] ?></td>
            <td><?= htmlspecialchars($row['category_name']) ?></td>
            <td>
                <a href="edit_category.php?id=<?= $row['category_id'] ?>">Edit</a>
                <a href="delete_category.php?id=<?= $row['category_id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
