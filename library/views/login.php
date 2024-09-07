<?php
// Include the necessary files
include('../config/db.php');
include('../controllers/auth.php');

// Start the session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Redirect the user to their respective dashboard if already logged in
if (isset($_SESSION['user_role'])) {
    if ($_SESSION['user_role'] === 'admin') {
        header('Location: admin_dashboard.php');
        exit;
    } elseif ($_SESSION['user_role'] === 'teacher') {
        header('Location: teacher_dashboard.php');
        exit;
    } elseif ($_SESSION['user_role'] === 'student') {
        header('Location: student_dashboard.php');
        exit;
    }
}

// Handle login request
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $auth = new Auth($conn);
    $loginSuccess = $auth->login($email, $password);

    if ($loginSuccess) {
        // Redirect based on role
        if ($_SESSION['user_role'] === 'admin') {
            header('Location: admin_dashboard.php');
        } elseif ($_SESSION['user_role'] === 'teacher') {
            header('Location: teacher_dashboard.php');
        } elseif ($_SESSION['user_role'] === 'student') {
            header('Location: student_dashboard.php');
        }
        exit;
    } else {
        $message = 'Invalid email or password. Please try again.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Login</h1>

        <?php if ($message): ?>
            <p class="error-message"><?= $message ?></p>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>

            <button type="submit" class="btn">Login</button>
        </form>

        <p>Don't have an account? <a href="signup.php">Sign Up Here</a></p>
    </div>
</body>
</html>
