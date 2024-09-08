<?php
require_once '../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role, status) VALUES (:name, :email, :password, 'customer', 'active')");
    $stmt->execute([
        'name' => $name,
        'email' => $email,
        'password' => $password
    ]);

    echo "<p>Registration successful. You can now log in.</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Signup</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Customer Signup</h1>
        <form action="" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Register</button>
        </form>
    </div>

    <script src="../../assets/js/script.js"></script>
</body>
</html>
