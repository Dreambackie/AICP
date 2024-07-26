<?php
$conn = new mysqli('localhost', 'root', '', 'business_directory');
$category_name = $_POST['category_name'];
$sql = "INSERT INTO categories (name) VALUES ('$category_name')";
$conn->query($sql);
header('Location: add_category.php');
?>
