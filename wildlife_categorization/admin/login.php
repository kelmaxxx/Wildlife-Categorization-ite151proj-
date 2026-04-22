<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'db.php'; // Database connection

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: dashboard.php"); // Redirect to dashboard
        exit();
    } else {
        $error_message = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h2>Admin Login</h2>
    <form method="POST">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br><br>
        
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>
        
        <button type="submit">Login</button>
    </form>
    <?php if (isset($error_message)) echo "<p style='color:red;'>$error_message</p>"; ?>
</body>
</html>
