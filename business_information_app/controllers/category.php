<?php
require_once '../config/db.php';
require_once '../models/Category.php';

session_start();

// Fetch all categories function
$category = new Category();
$categories = $category->getAllCategories();
$_SESSION['categories'] = $categories;
header('Location: ../views/home.php');
exit();
?>
