<?php
require_once '../config/db.php';

class Customer
{
    public function getRestaurants()
    {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM restaurants WHERE status = 'active'");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getRestaurantDishes($restaurant_id)
    {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM dishes WHERE restaurant_id = :restaurant_id");
        $stmt->execute(['restaurant_id' => $restaurant_id]);
        return $stmt->fetchAll();
    }

    public function placeOrder($customer_id, $dish_ids)
    {
        global $pdo;
        foreach ($dish_ids as $dish_id) {
            $stmt = $pdo->prepare("INSERT INTO orders (customer_id, dish_id, status) VALUES (:customer_id, :dish_id, 'pending')");
            $stmt->execute([
                'customer_id' => $customer_id,
                'dish_id' => $dish_id
            ]);
        }
    }
}
