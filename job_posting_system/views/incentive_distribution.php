<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

require_once '../config/db.php';

// Fetch incentive distribution details
$sql = "SELECT j.title, i.total_incentive, i.recruiter_posted, i.recruiter_candidate, i.admin_share 
        FROM incentives i
        JOIN jobs j ON i.job_id = j.id";
$incentiveData = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incentive Distribution</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>

<header>
    <h1>Incentive Distribution</h1>
</header>

<div class="container">
    <table>
        <tr>
            <th>Job Title</th>
            <th>Total Incentive (PKR)</th>
            <th>Recruiter (Posted Job) - 40%</th>
            <th>Recruiter (Candidate) - 40%</th>
            <th>Admin - 20%</th>
        </tr>
        <?php while ($row = $incentiveData->fetch_assoc()) : ?>
            <tr>
                <td><?= $row['title']; ?></td>
                <td><?= $row['total_incentive']; ?></td>
                <td><?= $row['recruiter_posted']; ?></td>
                <td><?= $row['recruiter_candidate']; ?></td>
                <td><?= $row['admin_share']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>
