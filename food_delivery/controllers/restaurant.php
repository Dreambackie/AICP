<?php
require_once '../config/db.php';

class Restaurant
{
    public function addDish($restaurant_id, $name, $price, $description)
    {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO dishes (restaurant_id, name, price, description) VALUES (:restaurant_id, :name, :price, :description)");
        $stmt->execute([
            'restaurant_id' => $restaurant_id,
            'name' => $name,
            'price' => $price,
            'description' => $description
        ]);
    }

    public function getDishes($restaurant_id)
    {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM dishes WHERE restaurant_id = :restaurant_id");
        $stmt->execute(['restaurant_id' => $restaurant_id]);
        return $stmt->fetchAll();
    }

    public function getOrders($restaurant_id)
    {
        global $pdo;
        $stmt = $pdo->prepare("
            SELECT o.id, u.name as customer_name, d.name as dish_name, o.status
            FROM orders o
            JOIN users u ON o.customer_id = u.id
            JOIN dishes d ON o.dish_id = d.id
            WHERE d.restaurant_id = :restaurant_id
        ");
        $stmt->execute(['restaurant_id' => $restaurant_id]);
        return $stmt->fetchAll();
    }
}
