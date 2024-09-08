<?php
require_once '../config/db.php';
require_once '../models/Business.php';

session_start();

// Add business function
if (isset($_POST['add_business'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $user_id = $_SESSION['user_id'];

    $business = new Business();
    if ($business->addBusiness($name, $address, $phone, $category, $description, $user_id)) {
        header('Location: ../views/home.php?success=business_added');
    } else {
        header('Location: ../views/add_business.php?error=failed');
    }
    exit();
}

// View business details function
if (isset($_GET['business_id'])) {
    $business_id = $_GET['business_id'];
    $business = new Business();
    $details = $business->getBusinessDetails($business_id);
    if ($details) {
        $_SESSION['business_details'] = $details;
        header('Location: ../views/business_details.php');
    } else {
        header('Location: ../views/home.php?error=not_found');
    }
    exit();
}
?>
