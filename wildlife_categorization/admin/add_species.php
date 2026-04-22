<?php
include 'auth.php';
$conn = new mysqli("localhost", "root", "", "wildlife_categorization");

$categories = $conn->query("SELECT category_id, category_name FROM category");
$habitats = $conn->query("SELECT habitat_id, habitat_name FROM habitat");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['species_name'] ?? '';
    $sci_name = $_POST['species_sci_name'] ?? '';
    $category_id = (int)$_POST['category_id'];
    $habitat_id = (int)$_POST['habitat_id'];
    $is_endangered = isset($_POST['is_endangered']) ? 1 : 0;
    $image_url = $_POST['image_url'] ?? '';

    $stmt = $conn->prepare("INSERT INTO species (species_name, species_sci_name, category_id, habitat_id, is_endangered, image_url) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiiis", $name, $sci_name, $category_id, $habitat_id, $is_endangered, $image_url);
    $stmt->execute();

    header("Location: manage_species.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Species</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef8f0;
            margin: 0;
            padding: 0;
        }
        .container {
            background-color: white;
            max-width: 600px;
            margin: 3rem auto;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #2c5f2d;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-top: 1rem;
            font-weight: bold;
            color: #333;
        }
        input[type="text"], select {
            padding: 0.5rem;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-top: 0.3rem;
        }
        input[type="checkbox"] {
            transform: scale(1.2);
            margin-top: 0.5rem;
        }
        button {
            margin-top: 2rem;
            padding: 0.75rem;
            background-color: #2c5f2d;
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }
        button:hover {
            background-color: #1e3d1e;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 1.5rem;
            text-decoration: none;
            color: #2c5f2d;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Add New Species</h2>
    <form method="POST">
        <label for="species_name">Name:</label>
        <input type="text" name="species_name" id="species_name" required>

        <label for="species_sci_name">Scientific Name:</label>
        <input type="text" name="species_sci_name" id="species_sci_name">

        <label for="category_id">Category:</label>
        <select name="category_id" id="category_id">
            <?php while ($cat = $categories->fetch_assoc()): ?>
                <option value="<?= $cat['category_id'] ?>"><?= htmlspecialchars($cat['category_name']) ?></option>
            <?php endwhile; ?>
        </select>

        <label for="habitat_id">Habitat:</label>
        <select name="habitat_id" id="habitat_id">
            <?php while ($hab = $habitats->fetch_assoc()): ?>
                <option value="<?= $hab['habitat_id'] ?>"><?= htmlspecialchars($hab['habitat_name']) ?></option>
            <?php endwhile; ?>
        </select>

        <label>
            <input type="checkbox" name="is_endangered"> Endangered?
        </label>

        <label for="image_url">Image URL:</label>
        <input type="text" name="image_url" id="image_url">

        <button type="submit">Add Species</button>
    </form>
    <a href="manage_species.php" class="back-link">← Back to Species List</a>
</div>

</body>
</html>
