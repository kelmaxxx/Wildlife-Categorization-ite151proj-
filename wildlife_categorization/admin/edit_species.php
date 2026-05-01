<?php
include 'auth.php';
$conn = new mysqli("localhost", "root", "", "wildlife_categorization", 3307);

// Optionally suppress notices (only do this in production)
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 0);

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$species_found = false;

// Default values
$species = [
    'species_name' => '',
    'species_description' => '',
    'category_id' => '',
    'habitat_id' => ''
];

// Fetch species if ID is valid
if ($id > 0) {
    $result = $conn->query("SELECT * FROM species WHERE species_id = $id");
    if ($result && $result->num_rows > 0) {
        $species = $result->fetch_assoc();
        $species_found = true;
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST" && $species_found) {
    $name = $conn->real_escape_string($_POST['species_name']);
    $description = $conn->real_escape_string($_POST['species_description']);
    $category_id = (int)$_POST['category_id'];
    $habitat_id = (int)$_POST['habitat_id'];

    $conn->query("UPDATE species SET 
        species_name = '$name',
        species_description = '$description',
        category_id = $category_id,
        habitat_id = $habitat_id
        WHERE species_id = $id");

    header("Location: manage_species.php");
    exit();
}

// Fetch categories and habitats
$categories = $conn->query("SELECT * FROM category");
$habitats = $conn->query("SELECT * FROM habitat");

// Safe selected values
$category_selected = isset($species['category_id']) ? $species['category_id'] : '';
$habitat_selected = isset($species['habitat_id']) ? $species['habitat_id'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Species</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef8f0;
        }
        .container {
            max-width: 600px;
            margin: 3rem auto;
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #2c5f2d;
        }
        label {
            display: block;
            margin: 1rem 0 0.3rem;
            font-weight: bold;
        }
        input[type="text"],
        select,
        textarea {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        button {
            margin-top: 1.5rem;
            padding: 0.7rem 1.2rem;
            background-color: #2c5f2d;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        button:hover {
            background-color: #234b22;
        }
        .back-link {
            display: inline-block;
            margin-top: 1.2rem;
            text-decoration: none;
            color: #2c5f2d;
        }
        .error {
            text-align: center;
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Edit Species</h1>

    <?php if (!$species_found): ?>
        <p class="error">Species not found or invalid ID.</p>
        <a class="back-link" href="manage_species.php">← Back to Manage Species</a>
    <?php else: ?>
        <form method="post">
            <label>Species Name:</label>
            <input type="text" name="species_name" value="<?= htmlspecialchars($species['species_name']) ?>" required>

            <label>Description:</label>
            <textarea name="species_description" rows="5" required><?= htmlspecialchars($species['species_description']) ?></textarea>

            <label>Category:</label>
            <select name="category_id" required>
                <?php while ($cat = $categories->fetch_assoc()): ?>
                    <option value="<?= $cat['category_id'] ?>" <?= ($cat['category_id'] == $category_selected) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['category_name']) ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <label>Habitat:</label>
            <select name="habitat_id" required>
                <?php while ($hab = $habitats->fetch_assoc()): ?>
                    <option value="<?= $hab['habitat_id'] ?>" <?= ($hab['habitat_id'] == $habitat_selected) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($hab['habitat_name']) ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <button type="submit">Update Species</button>
        </form>
        <a class="back-link" href="manage_species.php">← Back to Manage Species</a>
    <?php endif; ?>
</div>

</body>
</html>
