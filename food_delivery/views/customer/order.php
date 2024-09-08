<?php
// Assuming you have included necessary headers and started session
require_once '../../config/db.php';

// Fetch current user ID (assuming user is logged in as customer)
$user_id = $_SESSION['user_id'];

// Fetch customer details
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id AND role = 'customer'");
$stmt->execute(['id' => $user_id]);
$customer = $stmt->fetch();

// Fetch the list of orders for the customer
$stmt = $pdo->prepare("SELECT orders.*, dishes.name AS dish_name, restaurants.name AS restaurant_name
                       FROM orders
                       JOIN dishes ON orders.dish_id = dishes.id
                       JOIN users AS restaurants ON dishes.restaurant_id = restaurants.id
                       WHERE orders.customer_id = :customer_id");
$stmt->execute(['customer_id' => $user_id]);
$orders = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Orders</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Your Orders</h1>
        <div class="order-list">
            <?php if (count($orders) > 0): ?>
                <?php foreach ($orders as $order): ?>
                    <div class="order-card">
                        <h2><?= htmlspecialchars($order['dish_name']); ?> (<?= htmlspecialchars($order['restaurant_name']); ?>)</h2>
                        <p>Order Date: <?= htmlspecialchars($order['order_date']); ?></p>
                        <p>Status: <?= htmlspecialchars($order['status']); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No orders placed yet.</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="../../assets/js/script.js"></script>
</body>
</html>
