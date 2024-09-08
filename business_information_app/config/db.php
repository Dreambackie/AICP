<?php
$host = 'localhost'; // Database host
$dbname = 'business_information'; // Database name
$username = 'root'; // Database username
$password = 'MySQLs3rv3r'; // Database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
