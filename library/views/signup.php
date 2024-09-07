<?php
// views/signup.php
// Enable error reporting for development
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection
require_once '../config/db.php'; // Ensure the path is correct

// Include Auth class
require_once '../controllers/auth.php';

// Initialize Auth class with the PDO instance
$auth = new Auth($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Check if email is already registered
    if ($auth->isEmailRegistered($email)) {
        echo "<p>Email is already registered. Please use a different email.</p>";
    } else {
        $success = $auth->register($name, $email, $password, $role);

        if ($success) {
            echo "<p>Signup successful! <a href='login.php'>Login here</a>.</p>";
        } else {
            echo "<p>Signup failed. Please try again.</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Signup</h1>
        <form id="signup-form" action="" method="post">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select id="role" name="role" required>
                    <option value="student">Student</option>
                    <option value="teacher">Teacher</option>
                </select>
            </div>
            <button type="submit" class="btn">Signup</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </div>
</body>
</html>
