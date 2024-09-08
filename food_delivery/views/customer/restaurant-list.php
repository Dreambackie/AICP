<?php
// Assuming you have included necessary headers and started session
require_once '../../config/db.php';

// Fetch all restaurants from the database
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
        <h1>Available Restaurants</h1>
        <div class="restaurant-list">
            <?php if (count($restaurants) > 0): ?>
                <?php foreach ($restaurants as $restaurant): ?>
                    <div class="restaurant-card" data-id="<?= $restaurant['id']; ?>">
                        <h2><?= htmlspecialchars($restaurant['name']); ?></h2>
                        <p><?= htmlspecialchars($restaurant['email']); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No restaurants available at the moment.</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="../../assets/js/script.js"></script>
</body>
</html>
