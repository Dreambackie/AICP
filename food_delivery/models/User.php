<?php
require_once '../config/db.php';

class User
{
    public function getUserById($id)
    {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function getUserByEmail($email)
    {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }

    public function createUser($name, $email, $password, $role)
    {
        global $pdo;
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role, status) VALUES (:name, :email, :password, :role, 'pending')");
        $stmt->execute([
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword,
            'role' => $role
        ]);
    }

    public function updateUserStatus($id, $status)
    {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE users SET status = :status WHERE id = :id");
        $stmt->execute([
            'id' => $id,
            'status' => $status
        ]);
    }
}
