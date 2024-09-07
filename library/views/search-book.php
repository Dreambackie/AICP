<?php
// Include the necessary files
include('../config/db.php');
include('../controllers/book.php');

// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_role'])) {
    header("Location: login.php");
    exit;
}

// Process the search when the form is submitted
$books = [];
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['search'])) {
    $search_term = $_GET['search'];

    $bookController = new BookController($conn);
    $books = $bookController->searchBooks($search_term);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Books</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Search for Books</h1>

        <form action="search_book.php" method="GET">
            <div class="form-group">
                <label for="search">Search Books by Title, Author, Publisher, or Edition:</label>
                <input type="text" name="search" id="search" value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>" required>
            </div>
            <button type="submit" class="btn">Search</button>
        </form>

        <?php if (!empty($books)): ?>
            <h2>Search Results:</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Publisher</th>
                        <th>Edition</th>
                        <th>Pages</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($books as $book): ?>
                        <tr>
                            <td><?= $book['title'] ?></td>
                            <td><?= $book['author'] ?></td>
                            <td><?= $book['publisher'] ?></td>
                            <td><?= $book['edition'] ?></td>
                            <td><?= $book['pages'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php elseif (isset($_GET['search'])): ?>
            <p>No books found for the search term "<?= htmlentities($_GET['search']) ?>".</p>
        <?php endif; ?>

        <a href="<?= $_SESSION['user_role'] ?>_dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
