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

// Edit book details
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

// Suspend a user
if (isset($_GET['suspend_user'])) {
    $user_id = $_GET['suspend_user'];

    $sql = "UPDATE users SET status='suspended' WHERE id='$user_id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../views/admin_dashboard.php?success=User suspended");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Activate a suspended user
if (isset($_GET['activate_user'])) {
    $user_id = $_GET['activate_user'];

    $sql = "UPDATE users SET status='active' WHERE id='$user_id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../views/admin_dashboard.php?success=User activated");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Remove (delete) a user
if (isset($_GET['remove_user'])) {
    $user_id = $_GET['remove_user'];

    $sql = "DELETE FROM users WHERE id='$user_id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../views/admin_dashboard.php?success=User removed");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>
