<?php
session_start();

if (isset($_SESSION['user_id'])) {
    $role = $_SESSION['role'];
    
    switch ($role) {
        case 'admin':
            header('Location: views/admin/dashboard.php');
            break;
        case 'restaurant':
            header('Location: views/restaurant/view_orders.php');
            break;
        case 'customer':
            header('Location: views/customer/restaurant_list.php');
            break;
        default:
            echo 'Invalid user role.';
    }
    exit;
} else {
    header('Location: views/login.php');
    exit;
}
?>
