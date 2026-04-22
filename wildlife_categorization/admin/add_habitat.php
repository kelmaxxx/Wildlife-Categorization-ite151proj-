<?php
include 'auth.php';
$conn = new mysqli("localhost", "root", "", "wildlife_categorization");
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $conn->real_escape_string($_POST['habitat_name']);
    $location = $conn->real_escape_string($_POST['habitat_location']);
    $conn->query("INSERT INTO habitat (habitat_name, habitat_location) VALUES ('$name', '$location')");
    header("Location: manage_habitats.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Habitat</title>
</head>
<body>
    <h1>Add Habitat</h1>
    <form method="post">
        <label>Habitat Name: <input type="text" name="habitat_name" required></label><br>
        <label>Location: <input type="text" name="habitat_location" required></label><br>
        <button type="submit">Add</button>
    </form>
</body>
</html>
