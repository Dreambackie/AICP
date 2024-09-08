<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$category = $_GET['category'] ?? '';

// Database connection
require '../config/db.php';

$query = "SELECT * FROM businesses WHERE category = :category";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':category', $category);
$stmt->execute();
$businesses = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category - <?php echo htmlspecialchars($category); ?></title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="category-container">
        <h1>Businesses in <?php echo htmlspecialchars($category); ?></h1>
        <div class="filter-options">
            <!-- Add filter options here if needed -->
        </div>
        <div class="business-list">
            <?php foreach ($businesses as $business): ?>
                <div class="business-item">
                    <h2><?php echo htmlspecialchars($business['name']); ?></h2>
                    <p><?php echo htmlspecialchars($business['description']); ?></p>
                    <a href="business_details.php?id=<?php echo $business['id']; ?>">View Details</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
