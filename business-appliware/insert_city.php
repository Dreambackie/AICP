<?php
$conn = new mysqli('localhost', 'root', '', 'business_directory');
$city_name = $_POST['city_name'];
$sql = "INSERT INTO cities (name) VALUES ('$city_name')";
$conn->query($sql);
header('Location: add_city.php');
?>
