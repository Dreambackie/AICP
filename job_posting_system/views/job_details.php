<?php
require_once '../config/db.php';

if (!isset($_GET['job_id'])) {
    header("Location: job_list.php");
    exit();
}

$job_id = $_GET['job_id'];

// Fetch job details
$sql = "SELECT * FROM jobs WHERE id = $job_id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $job = $result->fetch_assoc();
} else {
    echo "Job not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Details</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>

<header>
    <h1>Job Details</h1>
</header>

<div class="container">
    <h2><?= $job['title']; ?></h2>
    <p><strong>Salary:</strong> <?= $job['salary']; ?> PKR</p>
    <p><strong>Description:</strong> <?= $job['description']; ?></p>
    <p><strong>Experience:</strong> <?= $job['experience']; ?> years</p>
    <p><strong>Incentive:</strong> <?= $job['incentive']; ?> PKR</p>
    <a href="apply_job.php?job_id=<?= $job['id']; ?>" class="button">Apply for this Job</a>
</div>

</body>
</html>
