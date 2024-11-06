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
			$this->pdo->exec("USE {$this->dbName}");

        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    // Method to add a car to the shortlist
    public function addToShortlist($userId, $username, $carId, $seller, $brand, $model, $price) {
        try {
            $query = "INSERT INTO shortlist (user_id, username, car_id, brand, model, price, seller)
                      VALUES (:user_id, :username, :car_id, :brand, :model, :price, :seller)";
            $stmt = $this->pdo->prepare($query);

            // Bind parameters
			$stmt->bindParam(':user_id', $userId);
			$stmt->bindParam(':username', $username);
            $stmt->bindParam(':car_id', $carId);
            $stmt->bindParam(':brand', $brand);
            $stmt->bindParam(':model', $model);
            $stmt->bindParam(':price', $price);
			$stmt->bindParam(':seller', $seller);

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
	
	// Method to fetch shortlisted cars by user only
    public function getShortlistedCarsByUser($username) {
        try {
            $query = "SELECT * FROM shortlist WHERE username = '". $username. "'";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error fetching shortlisted cars: " . $e->getMessage();
            return [];
        }
    }
	
	// Method to fetch shortlisted cars by seller only
    public function getShortlistedCarsBySeller($seller) {
        try {
            $query = "SELECT * FROM shortlist WHERE seller = '". $seller. "'";
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
	
	// Method to search shortlisted cars
	public function searchShortlistedCars($username, $searchTerm) {
        try {
            $query = "SELECT * FROM shortlist WHERE username = '". $username. "' AND brand LIKE :searchTerm";
            $stmt = $this->pdo->prepare($query);
            $likeTerm = "%" . $searchTerm . "%"; // Prepare the search term for LIKE clause
            $stmt->bindParam(':searchTerm', $likeTerm);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error searching cars: " . $e->getMessage();
            return [];
        }
    }
}
?>
