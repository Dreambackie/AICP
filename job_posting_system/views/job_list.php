<?php
require_once '../config/db.php';

// Fetch all jobs
$sql = "SELECT * FROM jobs";
$jobPosts = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Listings</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>

<header>
    <h1>Available Job Listings</h1>
</header>

<div class="container">
    <table>
        <tr>
            <th>Title</th>
            <th>Salary</th>
            <th>Description</th>
            <th>Experience</th>
            <th>Incentive</th>
            <th>Details</th>
        </tr>
        <?php while ($job = $jobPosts->fetch_assoc()) : ?>
            <tr>
                <td><?= $job['title']; ?></td>
                <td><?= $job['salary']; ?></td>
                <td><?= $job['description']; ?></td>
                <td><?= $job['experience']; ?></td>
                <td><?= $job['incentive']; ?></td>
                <td>
                    <a href="job_details.php?job_id=<?= $job['id']; ?>">View Details</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>
