<?php
session_start();

if (isset($_SESSION['admin_logged_in'])) {
    header("Location: views/admin_dashboard.php");
    exit();
} elseif (isset($_SESSION['recruiter_logged_in'])) {
    header("Location: views/recruiter_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recruiter Job Posting System</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <header>
        <h1>Recruiter Job Posting System</h1>
        <nav>
            <ul>
                <li><a href="views/login.php">Login</a></li>
                <li><a href="views/signup.php">Signup</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Welcome to the Recruiter Job Posting System</h2>
        <p>Login or signup to start managing jobs and candidates.</p>
    </main>

    <footer>
        <p>&copy; 2024 Recruiter Job Posting System</p>
    </footer>
</body>
</html>
