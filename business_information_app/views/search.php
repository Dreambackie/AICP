<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Database connection
require '../config/db.php';

$searchQuery = $_GET['query'] ?? '';
$category = $_GET['category'] ?? '';
$location = $_GET['location'] ?? '';
$popularity = $_GET['popularity'] ?? '';

$query = "SELECT * FROM businesses WHERE 1=1";

if (!empty($searchQuery)) {
    $query .= " AND name LIKE :searchQuery";
}
if (!empty($category)) {
    $query .= " AND category = :category";
}
if (!empty($location)) {
    $query .= " AND address LIKE :location";
}
if (!empty($popularity)) {
    if ($popularity == 'Popular') {
        $query .= " AND popularity_score > 8";
    } else {
        $query .= " AND popularity_score <= 8";
    }
}

$stmt = $pdo->prepare($query);

if (!empty($searchQuery)) {
    $stmt->bindValue(':searchQuery', '%' . $searchQuery . '%');
}
if (!empty($category)) {
    $stmt->bindValue(':category', $category);
}
if (!empty($location)) {
    $stmt->bindValue(':location', '%' . $location . '%');
}

$stmt->execute();
$businesses = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Businesses</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="search-container">
        <h1>Search Businesses</h1>
        <form action="search.php" method="GET">
            <input type="text" name="query" placeholder="Search by name..." value="<?php echo htmlspecialchars($searchQuery); ?>">
            
            <select name="category">
                <option value="">Select Category</option>
                <option value="Food" <?php echo ($category == 'Food') ? 'selected' : ''; ?>>Food</option>
                <option value="Healthcare" <?php echo ($category == 'Healthcare') ? 'selected' : ''; ?>>Healthcare</option>
                <option value="Hotels" <?php echo ($category == 'Hotels') ? 'selected' : ''; ?>>Hotels</option>
                <option value="Education" <?php echo ($category == 'Education') ? 'selected' : ''; ?>>Education</option>
            </select>

            <input type="text" name="location" placeholder="Search by location..." value="<?php echo htmlspecialchars($location); ?>">

            <select name="popularity">
                <option value="">Select Popularity</option>
                <option value="Popular" <?php echo ($popularity == 'Popular') ? 'selected' : ''; ?>>Popular</option>
                <option value="Regular" <?php echo ($popularity == 'Regular') ? 'selected' : ''; ?>>Regular</option>
            </select>

            <button type="submit">Search</button>
        </form>

        <?php if ($businesses): ?>
            <ul class="business-list">
                <?php foreach ($businesses as $business): ?>
                    <li>
                        <h2><?php echo htmlspecialchars($business['name']); ?></h2>
                        <p><?php echo htmlspecialchars($business['address']); ?></p>
                        <p>Category: <?php echo htmlspecialchars($business['category']); ?></p>
                        <p>Phone: <?php echo htmlspecialchars($business['phone']); ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No businesses found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
