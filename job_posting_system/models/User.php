<?php
require_once '../config/db.php';

class User {
    private $id;
    private $name;
    private $email;
    private $password;
    private $role;
    private $status;

    public function __construct($id, $name, $email, $password, $role, $status) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->status = $status;
    }

    public static function getUserByEmail($email) {
        global $conn;
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            return new User($user['id'], $user['name'], $user['email'], $user['password'], $user['role'], $user['status']);
        } else {
            return null;
        }
    }

    public static function getUserById($id) {
        global $conn;
        $sql = "SELECT * FROM users WHERE id='$id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            return new User($user['id'], $user['name'], $user['email'], $user['password'], $user['role'], $user['status']);
        } else {
            return null;
        }
    }

    public static function addUser($name, $email, $password, $role, $status) {
        global $conn;
        $sql = "INSERT INTO users (name, email, password, role, status) 
                VALUES ('$name', '$email', '$password', '$role', '$status')";
        return $conn->query($sql);
    }

    public static function updateUserStatus($id, $status) {
        global $conn;
        $sql = "UPDATE users SET status='$status' WHERE id='$id'";
        return $conn->query($sql);
    }

    public static function deleteUser($id) {
        global $conn;
        $sql = "DELETE FROM users WHERE id='$id'";
        return $conn->query($sql);
    }

    public static function isEmailRegistered($email) {
        global $conn;
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($sql);
        return $result->num_rows > 0;
    }
}
?>
