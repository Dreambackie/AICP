<?php
require_once '../config/db.php';

class Auth
{
    public function register($name, $email, $password, $role)
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

    public function login($email, $password)
    {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function isEmailRegistered($email)
    {
        global $pdo;
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch() ? true : false;
    }
}
