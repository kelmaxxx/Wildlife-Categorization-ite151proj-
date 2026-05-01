<?php
include 'auth.php';
$conn = new mysqli("localhost", "root", "", "wildlife_categorization", 3307);
$result = $conn->query("SELECT * FROM habitat");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Habitats</title>
</head>
<body>
    <h1>Habitats</h1>
    <a href="add_habitat.php">Add New Habitat</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Habitat Name</th>
            <th>Location</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['habitat_id'] ?></td>
            <td><?= htmlspecialchars($row['habitat_name']) ?></td>
            <td><?= htmlspecialchars($row['habitat_location']) ?></td>
            <td>
                <a href="edit_habitat.php?id=<?= $row['habitat_id'] ?>">Edit</a>
                <a href="delete_habitat.php?id=<?= $row['habitat_id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
