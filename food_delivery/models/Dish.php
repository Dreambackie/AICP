<?php
require_once '../config/db.php';

class Dish
{
    public function getDishById($id)
    {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM dishes WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function getDishesByRestaurant($restaurant_id)
    {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM dishes WHERE restaurant_id = :restaurant_id");
        $stmt->execute(['restaurant_id' => $restaurant_id]);
        return $stmt->fetchAll();
    }

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
}
