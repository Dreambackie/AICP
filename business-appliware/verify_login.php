<?php
session_start();

$correct_password = 'admin123';

if (isset($_POST['password'])) {
    $password = $_POST['password'];

    if ($password === $correct_password) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: admin_home.php');
        exit();
    } else {
        echo "Incorrect password. Please try again.";
    }
} else {
    echo "No password provided.";
}
?>
