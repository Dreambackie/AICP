<?php
class User {
    private $conn;

    // Constructor to initialize database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // Add a new user (admin, student, or teacher) to the database
    public function addUser($name, $email, $password, $role) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT); // Secure password hashing
        $sql = "INSERT INTO users (name, email, password, role) 
                VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $name, $email, $hashed_password, $role);
        return $stmt->execute();
    }

    // Update an existing user's status (active or suspended)
    public function updateUserStatus($user_id, $status) {
        $sql = "UPDATE users 
                SET status = ? 
                WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $status, $user_id);
        return $stmt->execute();
    }

    // Get details of a specific user by ID
    public function getUserById($user_id) {
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Get all users by role (admin, student, teacher)
    public function getUsersByRole($role) {
        $sql = "SELECT * FROM users WHERE role = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $role);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Authenticate a user for login
    public function authenticate($email, $password) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        } else {
            return false;
        }
    }

    // Delete a user from the database
    public function deleteUser($user_id) {
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        return $stmt->execute();
    }

    // Check if a user email is already registered
    public function isEmailRegistered($email) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }
}
?>
