<?php
$host = 'localhost';
$db = 'foodpanda_db';
$user = 'root';
$pass = ''; // Update this with your MySQL password if needed

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
