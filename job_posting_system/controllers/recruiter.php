<?php
require_once '../config/db.php';

session_start();

if (!isset($_SESSION['recruiter_logged_in'])) {
    header("Location: ../views/login.php");
    exit();
}

// Post a new job
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_job'])) {
    $title = $_POST['title'];
    $salary = $_POST['salary'];
    $description = $_POST['description'];
    $experience = $_POST['experience'];
    $incentive = $_POST['incentive'];
    $recruiter_id = $_SESSION['user_id'];

    $sql = "INSERT INTO jobs (title, salary, description, experience, incentive, recruiter_id) 
            VALUES ('$title', '$salary', '$description', '$experience', '$incentive', '$recruiter_id')";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../views/recruiter_dashboard.php");
    } else {
        echo "Error: " . $conn->error;
    }
}

// Apply for a job
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['apply_job'])) {
    $job_id = $_POST['job_id'];
    $candidate_name = $_POST['candidate_name'];
    $candidate_experience = $_POST['candidate_experience'];
    $recruiter_id = $_SESSION['user_id'];

    $sql = "INSERT INTO job_applications (job_id, recruiter_id, candidate_name, candidate_experience) 
            VALUES ('$job_id', '$recruiter_id', '$candidate_name', '$candidate_experience')";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../views/recruiter_dashboard.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
