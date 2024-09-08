<?php
session_start();
if (!isset($_SESSION['recruiter_logged_in'])) {
    header("Location: login.php");
    exit();
}

require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $salary = $_POST['salary'];
    $description = $_POST['description'];
    $experience = $_POST['experience'];
    $incentive = $_POST['incentive'];
    $posted_by = $_SESSION['user_id'];

    $sql = "INSERT INTO jobs (title, salary, description, experience, incentive, posted_by) 
            VALUES ('$title', '$salary', '$description', '$experience', '$incentive', '$posted_by')";

    if ($conn->query($sql) === TRUE) {
        header("Location: recruiter_dashboard.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post a Job</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>

<header>
    <h1>Post a New Job</h1>
</header>

<div class="container">
    <form action="job_post.php" method="post">
        <h2>Job Details</h2>
        <label for="title">Job Title</label>
        <input type="text" id="title" name="title" required>

        <label for="salary">Salary (PKR)</label>
        <input type="text" id="salary" name="salary" required>

        <label for="description">Job Description</label>
        <textarea id="description" name="description" rows="4" required></textarea>

        <label for="experience">Required Experience (years)</label>
        <input type="text" id="experience" name="experience" required>

        <label for="incentive">Incentive (PKR)</label>
        <input type="text" id="incentive" name="incentive" required>

        <button type="submit">Post Job</button>
    </form>
</div>

</body>
</html>
