<?php
// Start session
session_start();

// Redirect users based on their role if they are logged in
if (isset($_SESSION['user_role'])) {
    if ($_SESSION['user_role'] === 'admin') {
        header('Location: views/admin_dashboard.php');
        exit;
    } elseif ($_SESSION['user_role'] === 'teacher') {
        header('Location: views/teacher_dashboard.php');
        exit;
    } elseif ($_SESSION['user_role'] === 'student') {
        header('Location: views/student_dashboard.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Welcome to the Library Management System</h1>
        <p><a href="views/login.php" class="btn">Login</a></p>
        <p><a href="views/signup.php" class="btn">Signup</a></p>
    </div>
</body>
</html>
