<?php
session_start();
if (!isset($_SESSION['recruiter_logged_in'])) {
    header("Location: login.php");
    exit();
}

require_once '../config/db.php';

// Fetch jobs posted by this recruiter
$recruiter_id = $_SESSION['user_id'];
$sql = "SELECT * FROM jobs WHERE posted_by = $recruiter_id";
$myJobs = $conn->query($sql);

// Fetch all jobs posted by other recruiters
$sql = "SELECT * FROM jobs WHERE posted_by != $recruiter_id";
$otherJobs = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recruiter Dashboard</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>

<header>
    <h1>Recruiter Dashboard</h1>
</header>

<div class="container">

    <h2>My Job Posts</h2>
    <a href="job_post.php" class="button">Post a New Job</a>
    <table>
        <tr>
            <th>Title</th>
            <th>Salary</th>
            <th>Description</th>
            <th>Experience</th>
            <th>Incentive</th>
        </tr>
        <?php while ($job = $myJobs->fetch_assoc()) : ?>
            <tr>
                <td><?= $job['title']; ?></td>
                <td><?= $job['salary']; ?></td>
                <td><?= $job['description']; ?></td>
                <td><?= $job['experience']; ?></td>
                <td><?= $job['incentive']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <h2>Available Job Posts</h2>
    <table>
        <tr>
            <th>Title</th>
            <th>Salary</th>
            <th>Description</th>
            <th>Experience</th>
            <th>Incentive</th>
            <th>Action</th>
        </tr>
        <?php while ($job = $otherJobs->fetch_assoc()) : ?>
            <tr>
                <td><?= $job['title']; ?></td>
                <td><?= $job['salary']; ?></td>
                <td><?= $job['description']; ?></td>
                <td><?= $job['experience']; ?></td>
                <td><?= $job['incentive']; ?></td>
                <td>
                    <button class="apply-job" data-job-id="<?= $job['id']; ?>">Apply</button>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

</div>

<script src="../assets/js/script.js"></script>

</body>
</html>
