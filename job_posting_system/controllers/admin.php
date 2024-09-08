<?php
require_once '../config/db.php';

session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../views/login.php");
    exit();
}

$action = $_GET['action'] ?? '';
$recruiter_id = $_GET['recruiter_id'] ?? '';

if ($action === 'approve' && $recruiter_id) {
    $sql = "UPDATE users SET status='approved' WHERE id='$recruiter_id'";
    if ($conn->query($sql) === TRUE) {
        header("Location: ../views/approve_recruiters.php");
    } else {
        echo "Error: " . $conn->error;
    }
} elseif ($action === 'reject' && $recruiter_id) {
    $sql = "DELETE FROM users WHERE id='$recruiter_id'";
    if ($conn->query($sql) === TRUE) {
        header("Location: ../views/approve_recruiters.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
