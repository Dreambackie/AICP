<?php
$servername = "localhost";
$username = "root";
$password = "MySQLs3rv3r";
$dbname = "recruiter_job_posting";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
