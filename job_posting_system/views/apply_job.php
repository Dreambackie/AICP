<?php
session_start();
if (!isset($_SESSION['recruiter_logged_in'])) {
    header("Location: login.php");
    exit();
}

require_once '../config/db.php';

if (!isset($_GET['job_id'])) {
    header("Location: job_list.php");
    exit();
}

$job_id = $_GET['job_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $candidate_name = $_POST['candidate_name'];
    $candidate_experience = $_POST['candidate_experience'];
    $recruiter_id = $_SESSION['user_id'];

    // Insert candidate application
    $sql = "INSERT INTO job_applications (job_id, recruiter_id, candidate_name, candidate_experience) 
            VALUES ('$job_id', '$recruiter_id', '$candidate_name', '$candidate_experience')";

    if ($conn->query($sql) === TRUE) {
        header("Location: recruiter_dashboard.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

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
    <title>Apply for Job</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>

<header>
    <h1>Apply for <?= $job['title']; ?></h1>
</header>

<div class="container">
    <form action="apply_job.php?job_id=<?= $job['id']; ?>" method="post">
        <label for="candidate_name">Candidate Name</label>
        <input type="text" id="candidate_name" name="candidate_name" required>

        <label for="candidate_experience">Candidate Experience (years)</label>
        <input type="text" id="candidate_experience" name="candidate_experience" required>

        <button type="submit">Submit Application</button>
    </form>
</div>

</body>
</html>
