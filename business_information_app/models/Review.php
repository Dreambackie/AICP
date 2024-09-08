<?php
class Review {
    private $pdo;

    public function __construct() {
        $this->pdo = new PDO('mysql:host=localhost;dbname=business_info_app', 'root', 'password');
    }

    public function addReview($business_id, $user_id, $rating, $comment) {
        $stmt = $this->pdo->prepare("INSERT INTO reviews (business_id, user_id, rating, comment) VALUES (:business_id, :user_id, :rating, :comment)");
        return $stmt->execute([
            'business_id' => $business_id,
            'user_id' => $user_id,
            'rating' => $rating,
            'comment' => $comment
        ]);
    }

    public function getReviews($business_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM reviews WHERE business_id = :business_id");
        $stmt->execute(['business_id' => $business_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
