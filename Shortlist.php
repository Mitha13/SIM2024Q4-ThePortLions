<?php
// Shortlist.php (entity)
class Shortlist {
    private $pdo;
    private $dbName = 'shortlist_database';

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
        $query = "CREATE TABLE IF NOT EXISTS shortlist (
            id INT AUTO_INCREMENT PRIMARY KEY,
			user_id INT NOT NULL,
			username VARCHAR(100) NOT NULL,
            car_id INT NOT NULL,
            brand VARCHAR(100) NOT NULL,
            model VARCHAR(100) NOT NULL,
            price DECIMAL(10, 2) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (car_id) REFERENCES cars(id) ON DELETE CASCADE
        )";

        try {
            $this->pdo->exec($query);
        } catch (PDOException $e) {
            echo "Error creating table: " . $e->getMessage();
        }
    }

    // Method to add a car to the shortlist
    public function addToShortlist($userId, $username, $carId, $brand, $model, $price) {
        try {
            $query = "INSERT INTO shortlist (user_id, username, car_id, brand, model, price)
                      VALUES (:user_id, :username, :car_id, :brand, :model, :price)";
            $stmt = $this->pdo->prepare($query);

            // Bind parameters
			$stmt->bindParam(':user_id', $userId);
			$stmt->bindParam(':username', $username);
            $stmt->bindParam(':car_id', $carId);
            $stmt->bindParam(':brand', $brand);
            $stmt->bindParam(':model', $model);
            $stmt->bindParam(':price', $price);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error adding to shortlist: " . $e->getMessage();
            return false;
        }
    }

    // Method to fetch all shortlisted cars
    public function getShortlistedCars() {
        try {
            $query = "SELECT * FROM shortlist";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error fetching shortlisted cars: " . $e->getMessage();
            return [];
        }
    }
	
	// Method to remove a car from the shortlist
    public function deleteShortlistedCar($carId) {
        try {
            $query = "DELETE FROM shortlist WHERE car_id = :car_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':car_id', $carId);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error removing car from shortlist: " . $e->getMessage();
            return false;
        }
    }
}
?>
