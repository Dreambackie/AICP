<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Database connection
require '../config/db.php';

$user_id = $_SESSION['user_id'];

// Fetch user details
$query = "SELECT * FROM users WHERE id = :user_id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "User not found!";
    exit();
}

// Fetch user's added businesses
$businessQuery = "SELECT * FROM businesses WHERE user_id = :user_id";
$businessStmt = $pdo->prepare($businessQuery);
$businessStmt->bindParam(':user_id', $user_id);
$businessStmt->execute();
$businesses = $businessStmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="profile-container">
        <h1>User Profile</h1>
        <div class="profile-info">
            <img src="<?php echo htmlspecialchars($user['profile_picture']); ?>" alt="Profile Picture">
            <p><strong>Name:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
            <p><strong>City:</strong> <?php echo htmlspecialchars($user['city']); ?></p>
            <p><strong>Address:</strong> <?php echo htmlspecialchars($user['address']); ?></p>
            <a href="update_profile.php">Edit Profile</a>
        </div>

        <h2>Your Added Businesses</h2>
        <?php if ($businesses): ?>
            <ul class="business-list">
                <?php foreach ($businesses as $business): ?>
                    <li>
                        <h3><?php echo htmlspecialchars($business['name']); ?></h3>
                        <p><?php echo htmlspecialchars($business['address']); ?></p>
                        <a href="business_details.php?id=<?php echo $business['id']; ?>">View Details</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No businesses added yet.</p>
        <?php endif; ?>
    </div>
</body>
</html>
