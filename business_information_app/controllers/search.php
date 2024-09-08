<?php
require_once '../config/db.php';
require_once '../models/Business.php';

session_start();

// Search businesses function
if (isset($_POST['search'])) {
    $query = $_POST['query'];
    $category = $_POST['category'] ?? '';
    $location = $_POST['location'] ?? '';
    $popularity = $_POST['popularity'] ?? '';

    $business = new Business();
    $results = $business->searchBusinesses($query, $category, $location, $popularity);
    $_SESSION['search_results'] = $results;
    header('Location: ../views/search.php');
    exit();
}
?>
