<?php
// Include the necessary files and check if the user is an admin
include('../config/db.php');
include('../controllers/admin.php');

// Check if the admin is logged in
session_start();
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Process the form when submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $pages = $_POST['pages'];
    $publisher = $_POST['publisher'];
    $author = $_POST['author'];
    $edition = $_POST['edition'];

    $admin = new Admin($conn);
    $success = $admin->addBook($title, $pages, $publisher, $author, $edition);

    if ($success) {
        $message = "Book added successfully!";
    } else {
        $message = "Failed to add book.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Book</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Add New Book</h2>

        <?php if (isset($message)): ?>
            <p class="message"><?= $message ?></p>
        <?php endif; ?>

        <form action="add-books.php" method="POST">
            <div class="form-group">
                <label for="title">Book Title:</label>
                <input type="text" name="title" id="title" required>
            </div>
            <div class="form-group">
                <label for="pages">Book Pages:</label>
                <input type="number" name="pages" id="pages" required>
            </div>
            <div class="form-group">
                <label for="publisher">Book Publisher:</label>
                <input type="text" name="publisher" id="publisher" required>
            </div>
            <div class="form-group">
                <label for="author">Book Author:</label>
                <input type="text" name="author" id="author" required>
            </div>
            <div class="form-group">
                <label for="edition">Book Edition:</label>
                <input type="text" name="edition" id="edition">
            </div>
            <button type="submit" class="btn">Add Book</button>
        </form>

        <a href="admin_dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
