<?php
// Include necessary files
include('../config/db.php');
include('../controllers/book.php');
include('../controllers/request.php');

// Start session
session_start();

// Check if user is logged in and is a student
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'student') {
    header("Location: login.php");
    exit;
}

// Fetch available books
$bookController = new BookController($conn);
$books = $bookController->getAllBooks();

// Fetch borrowed books
$requestController = new RequestController($conn);
$borrowedBooks = $requestController->getBorrowedBooks($_SESSION['user_id']);
$returnedBooks = $requestController->getReturnedBooks($_SESSION['user_id']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Welcome, <?= $_SESSION['user_name'] ?></h1>
        <h2>Available Books</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Publisher</th>
                    <th>Edition</th>
                    <th>Pages</th>
                    <th>Action</th>
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
                        <td>
                            <form action="book_request.php" method="POST">
                                <input type="hidden" name="book_id" value="<?= $book['id'] ?>">
                                <button type="submit" class="btn">Borrow</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Currently Borrowed Books</h2>
        <?php if (!empty($borrowedBooks)): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Borrowed Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($borrowedBooks as $borrowed): ?>
                        <tr>
                            <td><?= $borrowed['title'] ?></td>
                            <td><?= $borrowed['author'] ?></td>
                            <td><?= $borrowed['borrowed_date'] ?></td>
                            <td><?= $borrowed['status'] === 'borrowed' ? 'Borrowed' : 'Returned' ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No books borrowed yet.</p>
        <?php endif; ?>

        <h2>Returned Books</h2>
        <?php if (!empty($returnedBooks)): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Return Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($returnedBooks as $returned): ?>
                        <tr>
                            <td><?= $returned['title'] ?></td>
                            <td><?= $returned['author'] ?></td>
                            <td><?= $returned['return_date'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No books returned yet.</p>
        <?php endif; ?>

        <a href="logout.php" class="btn">Logout</a>
    </div>
</body>
</html>
