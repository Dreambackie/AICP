<?php
// Assuming you have included necessary headers and started session
require_once '../../config/db.php';

// Fetch restaurant ID from session (assuming restaurant is logged in)
$restaurant_id = $_SESSION['user_id'];

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Insert the new dish into the database
    $stmt = $pdo->prepare("INSERT INTO dishes (restaurant_id, name, description, price) VALUES (:restaurant_id, :name, :description, :price)");
    $stmt->execute([
        'restaurant_id' => $restaurant_id,
        'name' => $name,
        'description' => $description,
        'price' => $price
    ]);

    echo "<p>Dish added successfully!</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Dish</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Add a New Dish</h1>
        <form action="" method="POST">
            <label for="name">Dish Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" required>

            <button type="submit">Add Dish</button>
        </form>
    </div>

    <script src="../../assets/js/script.js"></script>
</body>
</html>
