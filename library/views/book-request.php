<?php
// Include the necessary files and check if the user is logged in (either as student or teacher)
include('../config/db.php');
include('../controllers/request.php');

// Check if the user is logged in (either student or teacher)
session_start();
if (!isset($_SESSION['user_role']) || ($_SESSION['user_role'] !== 'student' && $_SESSION['user_role'] !== 'teacher')) {
    header("Location: login.php");
    exit;
}

// Process the book request when submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $book_id = $_POST['book_id'];
    $user_id = $_SESSION['user_id'];

    $request = new BookRequest($conn);
    $success = $request->requestBook($user_id, $book_id);

    if ($success) {
        $message = "Book requested successfully!";
    } else {
        $message = "Failed to request the book. Please try again.";
    }
}

// Fetch available books to request
$request = new BookRequest($conn);
$books = $request->getAvailableBooks();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request a Book</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Request a Book</h1>

        <?php if (isset($message)): ?>
            <p class="message"><?= $message ?></p>
        <?php endif; ?>

        <form action="book_request.php" method="POST">
            <div class="form-group">
                <label for="book_id">Select Book:</label>
                <select name="book_id" id="book_id" required>
                    <option value="">-- Select a Book --</option>
                    <?php foreach ($books as $book): ?>
                        <option value="<?= $book['id'] ?>"><?= $book['title'] ?> by <?= $book['author'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn">Request Book</button>
        </form>

        <a href="<?= $_SESSION['user_role'] ?>_dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
