<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="home-container">
        <h1>Welcome to Business Information App</h1>
        <div class="categories">
            <h2>Categories</h2>
            <ul>
                <li><a href="category.php?category=food">Food</a></li>
                <li><a href="category.php?category=healthcare">Healthcare</a></li>
                <li><a href="category.php?category=hotels">Hotels</a></li>
                <li><a href="category.php?category=education">Education</a></li>
            </ul>
        </div>
        <a href="user_profile.php">My Profile</a>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
