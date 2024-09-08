<?php
// Assuming you have included necessary headers and started session
require_once '../../config/db.php';

// Get the restaurant ID from the URL
$restaurant_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch restaurant details
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id AND role = 'restaurant' AND status = 'approved'");
$stmt->execute(['id' => $restaurant_id]);
$restaurant = $stmt->fetch();

// Fetch dishes from the restaurant
$stmt = $pdo->prepare("SELECT * FROM dishes WHERE restaurant_id = :restaurant_id");
$stmt->execute(['restaurant_id' => $restaurant_id]);
$dishes = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Menu</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <div class="container">
        <?php if ($restaurant): ?>
            <h1>Menu for <?= htmlspecialchars($restaurant['name']); ?></h1>
            <div class="dish-list">
                <?php if (count($dishes) > 0): ?>
                    <?php foreach ($dishes as $dish): ?>
                        <div class="dish-card" data-id="<?= $dish['id']; ?>">
                            <h2><?= htmlspecialchars($dish['name']); ?></h2>
                            <p><?= htmlspecialchars($dish['description']); ?></p>
                            <p>Price: $<?= htmlspecialchars($dish['price']); ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No dishes available at this restaurant.</p>
                <?php endif; ?>
            </div>
            <button onclick="placeOrder()">Place Order</button>
        <?php else: ?>
            <p>Restaurant not found or not approved yet.</p>
        <?php endif; ?>
    </div>

    <script src="../../assets/js/script.js"></script>
</body>
</html>
