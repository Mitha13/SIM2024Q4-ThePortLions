<?php
class Review {
    private $pdo;
    private $dbName = 'buyerReview_database';

    public function __construct() {
        $host = 'localhost';
        $user = 'root';
        $pass = '';

        try {
            // Create a new PDO instance for the server connection
            $this->pdo = new PDO("mysql:host=$host", $user, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Check if the database exists, if not, create it
            $this->createDatabaseIfNotExists();
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    // Method to create the database if it does not exist
    private function createDatabaseIfNotExists() {
        try {
            // Create the database if it doesn't exist
            $this->pdo->exec("CREATE DATABASE IF NOT EXISTS {$this->dbName}");
            // Switch to the new database
            $this->pdo->exec("USE {$this->dbName}");
            // Create the table if it doesn't exist
            $this->createTableIfNotExists();
        } catch (PDOException $e) {
            echo "Error creating database: " . $e->getMessage();
        }
    }
	
	// Method to create the shortlist table if it does not exist
    private function createTableIfNotExists() {
        $query = "CREATE TABLE IF NOT EXISTS reviews (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
			username VARCHAR(255) NOT NULL,
            car_id INT NOT NULL,
            comment TEXT NOT NULL,
            rating INT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";

        try {
            $this->pdo->exec($query);
        } catch (PDOException $e) {
            echo "Error creating table: " . $e->getMessage();
        }
    }

    public function save($userId, $username, $carId, $comment, $rating) {
		try {
			$query = "INSERT INTO reviews (user_id, username, car_id, comment, rating) VALUES (:user_id, :username, :car_id, :comment, :rating)";
			$stmt = $this->pdo->prepare($query);
			
			// Bind parameters
			$stmt->bindParam(':user_id', $userId);
			$stmt->bindParam(':username', $username);
			$stmt->bindParam(':car_id', $carId);
			$stmt->bindParam(':comment', $comment);
			$stmt->bindParam(':rating', $rating);
			
			return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error adding to shortlist: " . $e->getMessage();
            return false;
        }
    }
}
