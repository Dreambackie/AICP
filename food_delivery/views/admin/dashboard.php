<?php
require_once '../../config/db.php';

$total_users = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$total_restaurants = $pdo->query("SELECT COUNT(*) FROM users WHERE role = 'restaurant'")->fetchColumn();
$total_customers = $pdo->query("SELECT COUNT(*) FROM users WHERE role = 'customer'")->fetchColumn();
$total_dishes = $pdo->query("SELECT COUNT(*) FROM dishes")->fetchColumn();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Admin Dashboard</h1>
        <div class="stats">
            <div class="stat-card">
                <h2>Total Users</h2>
                <p><?= $total_users; ?></p>
            </div>
            <div class="stat-card">
                <h2>Total Restaurants</h2>
                <p><?= $total_restaurants; ?></p>
            </div>
            <div class="stat-card">
                <h2>Total Customers</h2>
                <p><?= $total_customers; ?></p>
            </div>
            <div class="stat-card">
                <h2>Total Dishes</h2>
                <p><?= $total_dishes; ?></p>
            </div>
        </div>
        <a href="approve_users.php" class="button">Approve Users</a>
    </div>

    <script src="../../assets/js/script.js"></script>
</body>
</html>
