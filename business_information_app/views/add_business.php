<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Database connection
require '../config/db.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'] ?? '';
    $address = $_POST['address'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $category = $_POST['category'] ?? '';
    $description = $_POST['description'] ?? '';

    if (empty($name) || empty($address) || empty($phone) || empty($category) || empty($description)) {
        $errors[] = "All fields are required.";
    }

    if (empty($errors)) {
        $query = "INSERT INTO businesses (name, address, phone, category, description, user_id) VALUES (:name, :address, :phone, :category, :description, :user_id)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':user_id', $_SESSION['user_id']);
        
        if ($stmt->execute()) {
            header('Location: home.php');
            exit();
        } else {
            $errors[] = "Failed to add business.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Business</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="add-business-container">
        <h1>Add New Business</h1>
        <?php if (!empty($errors)): ?>
            <div class="error-messages">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <form action="add_business.php" method="POST">
            <label for="name">Business Name</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name ?? ''); ?>" required>

            <label for="address">Address</label>
            <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($address ?? ''); ?>" required>

            <label for="phone">Phone</label>
            <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($phone ?? ''); ?>" required>

            <label for="category">Category</label>
            <select id="category" name="category" required>
                <option value="Food" <?php echo (isset($category) && $category == 'Food') ? 'selected' : ''; ?>>Food</option>
                <option value="Healthcare" <?php echo (isset($category) && $category == 'Healthcare') ? 'selected' : ''; ?>>Healthcare</option>
                <option value="Hotels" <?php echo (isset($category) && $category == 'Hotels') ? 'selected' : ''; ?>>Hotels</option>
                <option value="Education" <?php echo (isset($category) && $category == 'Education') ? 'selected' : ''; ?>>Education</option>
            </select>

            <label for="description">Description</label>
            <textarea id="description" name="description" required><?php echo htmlspecialchars($description ?? ''); ?></textarea>

            <button type="submit">Add Business</button>
        </form>
    </div>
</body>
</html>
