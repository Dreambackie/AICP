<?php
class Category {
    private $pdo;

    public function __construct() {
        $this->pdo = new PDO('mysql:host=localhost;dbname=business_info_app', 'root', 'password');
    }

    public function getAllCategories() {
        $stmt = $this->pdo->query("SELECT DISTINCT category FROM businesses");
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}
?>
