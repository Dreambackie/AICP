<?php
require_once '../../config/db.php';

$stmt = $pdo->query("SELECT * FROM users WHERE role = 'restaurant' AND status = 'approved'");
$restaurants = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant List</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Restaurants</h1>
        <div class="restaurant-list">
            <?php if (count($restaurants) > 0): ?>
                <?php foreach ($restaurants as $restaurant): ?>
                    <div class="restaurant-card" data-id="<?= $restaurant['id']; ?>">
                        <h2><?= htmlspecialchars($restaurant['name']); ?></h2>
                        <p>Email: <?= htmlspecialchars($restaurant['email']); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No restaurants available.</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="../../assets/js/script.js"></script>
</body>
</html>
