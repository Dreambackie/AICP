<?php
class Business {
    private $pdo;

    public function __construct() {
        $this->pdo = new PDO('mysql:host=localhost;dbname=business_info_app', 'root', 'password');
    }

    public function addBusiness($name, $address, $phone, $category, $description, $user_id) {
        $stmt = $this->pdo->prepare("INSERT INTO businesses (name, address, phone, category, description, user_id) VALUES (:name, :address, :phone, :category, :description, :user_id)");
        return $stmt->execute([
            'name' => $name,
            'address' => $address,
            'phone' => $phone,
            'category' => $category,
            'description' => $description,
            'user_id' => $user_id
        ]);
    }

    public function getBusinessDetails($business_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM businesses WHERE id = :id");
        $stmt->execute(['id' => $business_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function searchBusinesses($query, $category = '', $location = '', $popularity = '') {
        $sql = "SELECT * FROM businesses WHERE name LIKE :query";
        $params = ['query' => "%$query%"];

        if ($category) {
            $sql .= " AND category = :category";
            $params['category'] = $category;
        }
        if ($location) {
            $sql .= " AND address LIKE :location";
            $params['location'] = "%$location%";
        }
        if ($popularity) {
            $sql .= " AND popularity = :popularity";
            $params['popularity'] = $popularity;
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
