<?php
class User {
    private $pdo;

    public function __construct() {
        $this->pdo = new PDO('mysql:host=localhost;dbname=business_info_app', 'root', 'password');
    }

    public function login($email, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
        $stmt->execute(['email' => $email, 'password' => md5($password)]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            return true;
        }
        return false;
    }

    public function signup($name, $email, $password, $city, $address) {
        $stmt = $this->pdo->prepare("INSERT INTO users (name, email, password, city, address) VALUES (:name, :email, :password, :city, :address)");
        return $stmt->execute([
            'name' => $name,
            'email' => $email,
            'password' => md5($password),
            'city' => $city,
            'address' => $address
        ]);
    }

    public function updateProfile($user_id, $name, $email, $city, $address) {
        $stmt = $this->pdo->prepare("UPDATE users SET name = :name, email = :email, city = :city, address = :address WHERE id = :id");
        return $stmt->execute([
            'id' => $user_id,
            'name' => $name,
            'email' => $email,
            'city' => $city,
            'address' => $address
        ]);
    }

    public function getProfile($user_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
