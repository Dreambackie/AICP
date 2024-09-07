<?php
include('../config/db.php');

// Add a new book
if (isset($_POST['add_book'])) {
    $title = $_POST['title'];
    $pages = $_POST['pages'];
    $publisher = $_POST['publisher'];
    $author = $_POST['author'];
    $edition = $_POST['edition'];

    $sql = "INSERT INTO books (title, pages, publisher, author, edition) 
            VALUES ('$title', '$pages', '$publisher', '$author', '$edition')";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../views/admin_dashboard.php?success=Book added successfully");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Update book details
if (isset($_POST['update_book'])) {
    $book_id = $_POST['book_id'];
    $title = $_POST['title'];
    $pages = $_POST['pages'];
    $publisher = $_POST['publisher'];
    $author = $_POST['author'];
    $edition = $_POST['edition'];

    $sql = "UPDATE books 
            SET title='$title', pages='$pages', publisher='$publisher', author='$author', edition='$edition' 
            WHERE id='$book_id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../views/admin_dashboard.php?success=Book updated successfully");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Delete a book
if (isset($_GET['delete_book'])) {
    $book_id = $_GET['delete_book'];

    $sql = "DELETE FROM books WHERE id='$book_id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../views/admin_dashboard.php?success=Book deleted successfully");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Search for books
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM books 
            WHERE title LIKE '%$search%' 
               OR author LIKE '%$search%' 
               OR publisher LIKE '%$search%' 
               OR edition LIKE '%$search%'";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // Output results in the desired format
        while ($row = $result->fetch_assoc()) {
            echo "<div class='book'>
                    <h3>{$row['title']}</h3>
                    <p><strong>Author:</strong> {$row['author']}</p>
                    <p><strong>Publisher:</strong> {$row['publisher']}</p>
                    <p><strong>Pages:</strong> {$row['pages']}</p>
                    <p><strong>Edition:</strong> {$row['edition']}</p>
                    <a href='../controllers/book.php?delete_book={$row['id']}' onclick='return confirm(\"Are you sure you want to delete this book?\")'>Delete</a>
                  </div>";
        }
    } else {
        echo "No books found.";
    }
}
?>
