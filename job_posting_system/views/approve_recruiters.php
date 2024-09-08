<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

require_once '../config/db.php';

// Fetch recruiters for approval
$sql = "SELECT * FROM users WHERE role='recruiter' AND status='pending'";
$pendingRecruiters = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approve Recruiters</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>

<header>
    <h1>Approve Recruiters</h1>
</header>

<div class="container">
    <h2>Pending Recruiter Approvals</h2>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        <?php while ($recruiter = $pendingRecruiters->fetch_assoc()) : ?>
            <tr>
                <td><?= $recruiter['name']; ?></td>
                <td><?= $recruiter['email']; ?></td>
                <td>
                    <a href="../controllers/admin.php?action=approve&recruiter_id=<?= $recruiter['id']; ?>">Approve</a>
                    <a href="../controllers/admin.php?action=reject&recruiter_id=<?= $recruiter['id']; ?>">Reject</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>
