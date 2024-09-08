<?php
// Assuming you have included necessary headers and started session
require_once '../../config/db.php';

// Fetch restaurant ID from session (assuming restaurant is logged in)
$restaurant_id = $_SESSION['user_id'];

// Fetch orders for the restaurant
$stmt = $pdo->prepare("SELECT orders.*, dishes.name AS dish_name, users.name AS customer_name
                       FROM orders
                       JOIN dishes ON orders.dish_id = dishes.id
                       JOIN users ON orders.customer_id = users.id
                       WHERE dishes.restaurant_id = :restaurant_id");
$stmt->execute(['restaurant_id' => $restaurant_id]);
$orders = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>View Orders</h1>
        <div class="order-list">
            <?php if (count($orders) > 0): ?>
                <?php foreach ($orders as $order): ?>
                    <div class="order-card">
                        <h2>Dish: <?= htmlspecialchars($order['dish_name']); ?></h2>
                        <p>Customer: <?= htmlspecialchars($order['customer_name']); ?></p>
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
