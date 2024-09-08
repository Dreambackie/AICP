<?php
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = 'recruiter';
    $status = 'pending'; // New recruiters need admin approval

    // Insert recruiter into the database
    $sql = "INSERT INTO users (name, email, password, role, status) 
            VALUES ('$name', '$email', '$password', '$role', '$status')";

    if ($conn->query($sql) === TRUE) {
        echo "Signup successful! Please wait for admin approval.";
    } else {
        echo "Error: " . $conn->error;
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

<header>
    <h1>Recruiter Signup</h1>
</header>

<div class="container">
    <form action="signup.php" method="post">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Signup</button>
    </form>
    <p>Already have an account? <a href="login.php">Login here</a></p>
</div>

</body>
</html>
