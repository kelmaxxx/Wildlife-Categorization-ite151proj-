<?php
include 'auth.php';
$conn = new mysqli("localhost", "root", "", "wildlife_categorization", 3307);

$result = $conn->query("SELECT 
    s.species_id, 
    s.species_name, 
    s.species_sci_name, 
    s.is_endangered, 
    c.category_name, 
    h.habitat_name 
FROM species s
LEFT JOIN category c ON s.category_id = c.category_id
LEFT JOIN habitat h ON s.habitat_id = h.habitat_id");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Species</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef8f0;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #2c5f2d;
            color: white;
            padding: 1rem;
            text-align: center;
        }

        .container {
            max-width: 1000px;
            margin: 2rem auto;
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            overflow-x: auto;
        }

        h2 {
            margin-top: 0;
            color: #2c5f2d;
        }

        a.button {
            background-color: #2c5f2d;
            color: white;
            padding: 0.5rem 1rem;
            text-decoration: none;
            border-radius: 6px;
            margin-bottom: 1rem;
            display: inline-block;
        }

        table {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        th, td {
            padding: 0.75rem;
            text-align: left;
            border-bottom: 1px solid #ccc;
            word-wrap: break-word;
            overflow-wrap: break-word;
            white-space: normal;
        }

        th {
            background-color: #3c803f;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f6fdf7;
        }

        .actions a {
            margin-right: 0.5rem;
            color: #2980b9;
            text-decoration: none;
            word-break: keep-all;
        }

        .actions a.delete {
            color: #c0392b;
        }

        @media screen and (max-width: 768px) {
            th, td {
                font-size: 14px;
            }

            .container {
                padding: 1rem;
            }

            a.button {
                font-size: 14px;
                padding: 0.4rem 0.8rem;
            }
        }
    </style>
</head>
<body>

<header>
    <h1>Species Management</h1>
</header>

<div class="container">
    <h2>Species List</h2>
    <a href="add_species.php" class="button">Add New Species</a>

    <table>
        <tr>
            <th>Name</th>
            <th>Scientific Name</th>
            <th>Category</th>
            <th>Habitat</th>
            <th>Endangered</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['species_name']) ?></td>
            <td><em><?= htmlspecialchars($row['species_sci_name']) ?></em></td>
            <td><?= htmlspecialchars($row['category_name']) ?></td>
            <td><?= htmlspecialchars($row['habitat_name']) ?></td>
            <td><?= $row['is_endangered'] ? 'Yes' : 'No' ?></td>
            <td class="actions">
                <a href="edit_species.php?id=<?= $row['species_id'] ?>">Edit</a>
                <a href="delete_species.php?id=<?= $row['species_id'] ?>" class="delete" onclick="return confirm('Are you sure you want to delete this species?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>
