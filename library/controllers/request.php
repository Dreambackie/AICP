<?php
include('../config/db.php');

// Request a book
if (isset($_POST['request_book'])) {
    $user_id = $_POST['user_id'];
    $book_id = $_POST['book_id'];
    $borrowed_date = date('Y-m-d');

    $sql = "INSERT INTO borrowed_books (user_id, book_id, borrowed_date, status) 
            VALUES ('$user_id', '$book_id', '$borrowed_date', 'borrowed')";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../views/student_dashboard.php?success=Book requested successfully");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Return a borrowed book
if (isset($_POST['return_book'])) {
    $id = $_POST['id'];
    $return_date = date('Y-m-d');

    $sql = "UPDATE borrowed_books 
            SET return_date='$return_date', status='returned' 
            WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../views/student_dashboard.php?success=Book returned successfully");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// View borrowed books for a user
if (isset($_GET['view_borrowed'])) {
    $user_id = $_GET['view_borrowed'];

    $sql = "SELECT b.*, bb.borrowed_date, bb.return_date, bb.status 
            FROM borrowed_books bb
            JOIN books b ON bb.book_id = b.id
            WHERE bb.user_id='$user_id'";

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
                    <p><strong>Borrowed Date:</strong> {$row['borrowed_date']}</p>
                    <p><strong>Return Date:</strong> {$row['return_date']}</p>
                    <p><strong>Status:</strong> {$row['status']}</p>
                    " . ($row['status'] === 'borrowed' ? "<form method='POST' action='../controllers/request.php'>
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <input type='submit' name='return_book' value='Return Book'>
                    </form>" : "") . "
                  </div>";
        }
    } else {
        echo "No borrowed books found.";
    }
}
?>
