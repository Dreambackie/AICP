<?php
require_once '../config/db.php';

session_start();

// Fetch all jobs
function getAllJobs() {
    global $conn;
    $sql = "SELECT * FROM jobs";
    return $conn->query($sql);
}

// Fetch job by ID
function getJobById($job_id) {
    global $conn;
    $sql = "SELECT * FROM jobs WHERE id='$job_id'";
    return $conn->query($sql);
}

// Fetch jobs posted by a specific recruiter
function getJobsByRecruiter($recruiter_id) {
    global $conn;
    $sql = "SELECT * FROM jobs WHERE recruiter_id='$recruiter_id'";
    return $conn->query($sql);
}
?>
