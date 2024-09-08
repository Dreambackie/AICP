<?php
require_once '../config/db.php';

session_start();

// Calculate and distribute incentives
function distributeIncentives($job_id, $total_incentive, $recruiter_posted, $recruiter_candidate) {
    global $conn;

    $admin_share = $total_incentive * 0.20;
    $recruiter_posted_share = $total_incentive * 0.40;
    $recruiter_candidate_share = $total_incentive * 0.40;

    // Insert incentive details into the database
    $sql = "INSERT INTO incentives (job_id, total_incentive, recruiter_posted, recruiter_candidate, admin_share) 
            VALUES ('$job_id', '$total_incentive', '$recruiter_posted_share', '$recruiter_candidate_share', '$admin_share')";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        echo "Error: " . $conn->error;
        return false;
    }
}

// Example usage
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $job_id = $_POST['job_id'];
    $total_incentive = $_POST['total_incentive'];
    $recruiter_posted = $_POST['recruiter_posted'];
    $recruiter_candidate = $_POST['recruiter_candidate'];

    if (distributeIncentives($job_id, $total_incentive, $recruiter_posted, $recruiter_candidate)) {
        header("Location: ../views/incentive_distribution.php");
    }
}
?>
