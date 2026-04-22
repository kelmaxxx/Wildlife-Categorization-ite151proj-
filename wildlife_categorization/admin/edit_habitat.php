<?php
include 'auth.php';
$conn = new mysqli("localhost", "root", "", "wildlife_categorization");
$id = (int)$_GET['id'];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $conn->real_escape_string($_POST['habitat_name']);
    $location = $conn->real_escape_string($_POST['habitat_location']);
    $conn->query("UPDATE habitat SET habitat_name='$name', habitat_location='$location' WHERE habitat_id=$id");
    header("Location: manage_habitats.php");
    exit();
}
$result = $conn->query("SELECT * FROM habitat WHERE habitat_id=$id");
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Habitat</title>
</head>
<body>
    <h1>Edit Habitat</h1>
    <form method="post">
        <label>Habitat Name: <input type="text" name="habitat_name" value="<?= htmlspecialchars($row['habitat_name']) ?>" required></label><br>
        <label>Location: <input type="text" name="habitat_location" value="<?= htmlspecialchars($row['habitat_location']) ?>" required></label><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
