<?php
class Review {
    private $pdo;
    private $dbName = 'review_database';

    public function __construct() {
        $host = 'localhost';
        $user = 'root';
        $pass = '';

        try {
            // Create a new PDO instance for the server connection
            $this->pdo = new PDO("mysql:host=$host", $user, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->pdo->exec("USE {$this->dbName}");

        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function save($userId, $username, $agent, $carId, $comment, $rating) {
		try {
			$query = "INSERT INTO buyerreviews (user_id, username, agent, car_id, comment, rating) VALUES (:user_id, :username, :agent, :car_id, :comment, :rating)";
			$stmt = $this->pdo->prepare($query);
			
			// Bind parameters
			$stmt->bindParam(':user_id', $userId);
			$stmt->bindParam(':username', $username);
			$stmt->bindParam(':agent', $agent);
			$stmt->bindParam(':car_id', $carId);
			$stmt->bindParam(':comment', $comment);
			$stmt->bindParam(':rating', $rating);
			
			return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error adding your reviews to db: " . $e->getMessage();
            return false;
        }
    }
	
	// Method to fetch all reviews
    public function getReviews($username) {
        try {
            $query = "SELECT * FROM buyerreviews WHERE username = '". $username . "'";
            $stmt = $this->pdo->prepare($query);		
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error fetching shortlisted cars: " . $e->getMessage();
            return [];
        }
    }
}
