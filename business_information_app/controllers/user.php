<?php
require_once '../config/db.php';
require_once '../models/User.php';

session_start();

// Update profile function
if (isset($_POST['update_profile'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $user_id = $_SESSION['user_id'];

    $user = new User();
    if ($user->updateProfile($user_id, $name, $email, $city, $address)) {
        header('Location: ../views/user_profile.php?success=updated');
    } else {
        header('Location: ../views/update_profile.php?error=failed');
    }
    exit();
}

// View user profile function
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $user = new User();
    $profile = $user->getProfile($user_id);
    if ($profile) {
        $_SESSION['user_profile'] = $profile;
        header('Location: ../views/user_profile.php');
    } else {
        header('Location: ../views/home.php?error=not_found');
    }
    exit();
}
?>
