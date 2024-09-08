<?php
require_once '../config/db.php';

session_start();

if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_destroy();
    header("Location: ../views/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] === 'admin') {
                $_SESSION['admin_logged_in'] = true;
                header("Location: ../views/admin_dashboard.php");
            } elseif ($user['role'] === 'recruiter' && $user['status'] === 'approved') {
                $_SESSION['recruiter_logged_in'] = true;
                header("Location: ../views/recruiter_dashboard.php");
            } else {
                echo "Your account is not approved yet.";
            }
        } else {
            echo "Invalid credentials.";
        }
    } elseif (isset($_POST['signup'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = 'recruiter';
        $status = 'pending';

        $sql = "INSERT INTO users (name, email, password, role, status) 
                VALUES ('$name', '$email', '$password', '$role', '$status')";

        if ($conn->query($sql) === TRUE) {
            echo "Signup successful! Please wait for admin approval.";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
?>
