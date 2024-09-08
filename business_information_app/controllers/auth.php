<?php
require_once '../config/db.php';
require_once '../models/User.php';

session_start();

// Login function
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = new User();
    if ($user->login($email, $password)) {
        $_SESSION['user_id'] = $user->getUserId();
        header('Location: ../views/home.php');
    } else {
        header('Location: ../views/login.php?error=invalid');
    }
    exit();
}

// Signup function
if (isset($_POST['signup'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $city = $_POST['city'];
    $address = $_POST['address'];

    $user = new User();
    if ($user->signup($name, $email, $password, $city, $address)) {
        header('Location: ../views/login.php?success=registered');
    } else {
        header('Location: ../views/signup.php?error=exists');
    }
    exit();
}

// Logout function
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_destroy();
    header('Location: ../views/login.php');
    exit();
}
?>
