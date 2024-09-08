<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$business_id = $_GET['id'] ?? null;

// Database connection
require '../config/db.php';

if ($business_id) {
    $query = "SELECT * FROM businesses WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $business_id);
    $stmt->execute();
    $business = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (!$business) {
    echo "Business not found.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Details</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="business-details-container">
        <h1><?php echo htmlspecialchars($business['name']); ?></h1>
        <p><?php echo htmlspecialchars($business['description']); ?></p>
        <p>Address: <?php echo htmlspecialchars($business['address']); ?></p>
        <p>Phone: <?php echo htmlspecialchars($business['phone']); ?></p>
        <p>Category: <?php echo htmlspecialchars($business['category']); ?></p>
        <h3>Reviews</h3>
        <div class="reviews-section">
            <!-- Display reviews here (to be added later) -->
        </div>
        <a href="category.php?category=<?php echo htmlspecialchars($business['category']); ?>">Back to Category</a>
    </div>
</body>
</html>
