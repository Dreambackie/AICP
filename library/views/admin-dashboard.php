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

// Create an instance of the Admin controller
$admin = new Admin($conn);

// Fetch the list of all books
$books = $admin->viewAllBooks();

// Fetch the list of all registered users (teachers and students)
$teachers = $admin->getUsersByRole('teacher');
$students = $admin->getUsersByRole('student');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Admin Dashboard</h1>

        <h2>Manage Books</h2>
        <a href="add-books.php" class="btn">Add New Book</a>

        <h3>List of Books</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Publisher</th>
                    <th>Edition</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $book): ?>
                    <tr>
                        <td><?= $book['id'] ?></td>
                        <td><?= $book['title'] ?></td>
                        <td><?= $book['author'] ?></td>
                        <td><?= $book['publisher'] ?></td>
                        <td><?= $book['edition'] ?></td>
                        <td>
                            <a href="edit-book.php?id=<?= $book['id'] ?>" class="btn">Edit</a>
                            <a href="../controllers/admin.php?action=delete&id=<?= $book['id'] ?>" class="btn delete-btn">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Manage Users</h2>

        <h3>Teachers</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($teachers as $teacher): ?>
                    <tr>
                        <td><?= $teacher['id'] ?></td>
                        <td><?= $teacher['name'] ?></td>
                        <td><?= $teacher['email'] ?></td>
                        <td><?= $teacher['status'] ?></td>
                        <td>
                            <a href="../controllers/admin.php?action=suspend&id=<?= $teacher['id'] ?>" class="btn">Suspend</a>
                            <a href="../controllers/admin.php?action=delete&id=<?= $teacher['id'] ?>" class="btn delete-btn">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h3>Students</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?= $student['id'] ?></td>
                        <td><?= $student['name'] ?></td>
                        <td><?= $student['email'] ?></td>
                        <td><?= $student['status'] ?></td>
                        <td>
                            <a href="../controllers/admin.php?action=suspend&id=<?= $student['id'] ?>" class="btn">Suspend</a>
                            <a href="../controllers/admin.php?action=delete&id=<?= $student['id'] ?>" class="btn delete-btn">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a href="logout.php" class="btn">Logout</a>
    </div>

    <script src="../assets/js/script.js"></script>
</body>
</html>
