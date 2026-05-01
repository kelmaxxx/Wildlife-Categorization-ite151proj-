<?php
include 'auth.php';
$conn = new mysqli("localhost", "root", "", "wildlife_categorization", 3307);

$id = (int)$_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['confirm'])) {
        $conn->query("DELETE FROM species WHERE species_id = $id");
        header("Location: manage_species.php");
        exit();
    } else {
        header("Location: manage_species.php");
        exit();
    }
}

// Fetch species name to show in confirmation
$result = $conn->query("SELECT species_name FROM species WHERE species_id = $id");
$species = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Species</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef8f0;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 500px;
            margin: 5rem auto;
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        h2 {
            color: #c0392b;
        }
        p {
            font-size: 1.1rem;
        }
        form {
            margin-top: 2rem;
        }
        button {
            padding: 0.6rem 1.2rem;
            margin: 0 0.5rem;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            cursor: pointer;
        }
        .confirm {
            background-color: #c0392b;
            color: white;
        }
        .cancel {
            background-color: #95a5a6;
            color: white;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Confirm Deletion</h2>
    <?php if ($species): ?>
        <p>Are you sure you want to delete the species <strong><?= htmlspecialchars($species['species_name']) ?></strong>?</p>
        <form method="POST">
            <button type="submit" name="confirm" class="confirm">Yes, Delete</button>
            <button type="submit" name="cancel" class="cancel">Cancel</button>
        </form>
    <?php else: ?>
        <p>Species not found.</p>
        <a href="manage_species.php" class="cancel">Back to Species List</a>
    <?php endif; ?>
</div>

</body>
</html>
