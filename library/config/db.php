<?php
// Database configuration
$host = 'localhost'; // Your database host
$db = 'library_management'; // Your database name
$user = 'root'; // Your database username
$pass = 'MySQLs3rv3r'; // Your database password, change this if necessary

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Optional: Set the default fetch mode to associative arrays
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Handle connection error
    die("Could not connect to the database $db :" . $e->getMessage());
}
?>
