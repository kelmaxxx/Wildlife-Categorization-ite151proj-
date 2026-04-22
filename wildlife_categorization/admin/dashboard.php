<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef8f0;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        header {
            background-color: #2c5f2d;
            color: white;
            padding: 1rem;
        }
        .container {
            margin: 2rem auto;
            max-width: 800px;
        }
        .section {
            background: white;
            margin: 1rem 0;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        a.button {
            display: inline-block;
            margin: 0.5rem;
            padding: 0.5rem 1rem;
            background-color: #2c5f2d;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .logout-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background: #e74c3c;
        }
    </style>
</head>
<body>

<header>
    <h1>Admin Dashboard</h1>
    <a href="logout.php" class="button logout-btn">Logout</a>
</header>

<div class="container">
    <div class="section">
        <h2>Manage Species</h2>
        <a href="add_species.php" class="button">Add Species</a>
        <a href="edit_species.php" class="button">Edit Species</a>
        <a href="delete_species.php" class="button">Delete Species</a>
    </div>

    <div class="section">
        <h2>Manage Habitat</h2>
        <a href="add_habitat.php" class="button">Add Habitat</a>
        <a href="edit_habitat.php" class="button">Edit Habitat</a>
        <a href="delete_habitat.php" class="button">Delete Habitat</a>
    </div>
</div>

</body>
</html>
