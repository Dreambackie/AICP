<?php
// Assuming you have included necessary headers and started session
require_once '../../config/db.php';

// Fetch pending users
$stmt = $pdo->prepare("SELECT * FROM users WHERE status = 'pending'");
$stmt->execute();
$pending_users = $stmt->fetchAll();

// Handle approval or rejection of users
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $action = $_POST['action'];

    if ($action === 'approve') {
        // Approve user
        $stmt = $pdo->prepare("UPDATE users SET status = 'approved' WHERE id = :user_id");
        $stmt->execute(['user_id' => $user_id]);
        echo "<p>User approved successfully!</p>";
    } elseif ($action === 'reject') {
        // Reject user
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = :user_id");
        $stmt->execute(['user_id' => $user_id]);
        echo "<p>User rejected and removed.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approve Users</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Approve Users</h1>
        <div class="user-list">
            <?php if (count($pending_users) > 0): ?>
                <?php foreach ($pending_users as $user): ?>
                    <div class="user-card">
                        <h2><?= htmlspecialchars($user['name']); ?></h2>
                        <p>Email: <?= htmlspecialchars($user['email']); ?></p>
                        <form action="" method="POST">
                            <input type="hidden" name="user_id" value="<?= $user['id']; ?>">
                            <button type="submit" name="action" value="approve">Approve</button>
                            <button type="submit" name="action" value="reject">Reject</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No pending users.</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="../../assets/js/script.js"></script>
</body>
</html>
