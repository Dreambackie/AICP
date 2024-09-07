<?php
class Book {
    private $conn;

    // Constructor to initialize database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // Add a new book to the database
    public function addBook($title, $pages, $publisher, $author, $edition) {
        $sql = "INSERT INTO books (title, pages, publisher, author, edition) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sisss", $title, $pages, $publisher, $author, $edition);
        return $stmt->execute();
    }

    // Update an existing book's details
    public function updateBook($book_id, $title, $pages, $publisher, $author, $edition) {
        $sql = "UPDATE books 
                SET title = ?, pages = ?, publisher = ?, author = ?, edition = ?
                WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sisssi", $title, $pages, $publisher, $author, $edition, $book_id);
        return $stmt->execute();
    }

    // Delete a book from the database
    public function deleteBook($book_id) {
        $sql = "DELETE FROM books WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $book_id);
        return $stmt->execute();
    }

    // Get details of a specific book by ID
    public function getBookById($book_id) {
        $sql = "SELECT * FROM books WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $book_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Get all books from the database
    public function getAllBooks() {
        $sql = "SELECT * FROM books";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Search books by title, author, publisher, or edition
    public function searchBooks($search_term) {
        $sql = "SELECT * FROM books 
                WHERE title LIKE ? OR author LIKE ? OR publisher LIKE ? OR edition LIKE ?";
        $term = '%' . $search_term . '%';
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $term, $term, $term, $term);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
?>
