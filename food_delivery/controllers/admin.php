<?php
require_once '../config/db.php';

class Admin
{
    public function approveUser($user_id)
    {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE users SET status = 'active' WHERE id = :user_id AND status = 'pending'");
        $stmt->execute(['user_id' => $user_id]);
    }

    public function rejectUser($user_id)
    {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = :user_id AND status = 'pending'");
        $stmt->execute(['user_id' => $user_id]);
    }

    public function getPendingUsers()
    {
        global $pdo;
        $stmt = $pdo->prepare("SELECT id, name, email, role FROM users WHERE status = 'pending'");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
