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
	
	// Method to fetch buyer reviews
    public function getBuyerReviews($username) {
        try {
            $query = "SELECT * FROM buyerreviews WHERE agent = 'agent'";
            $stmt = $this->pdo->prepare($query);		
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error fetching shortlisted cars: " . $e->getMessage();
            return [];
        }
    }
	
	// Method to fetch seller reviews
    public function getSellerReviews($username) {
        try {
            $query = "SELECT * FROM sellerreviews WHERE agent = 'agent'";
            $stmt = $this->pdo->prepare($query);		
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error fetching shortlisted cars: " . $e->getMessage();
            return [];
        }
    }
}
