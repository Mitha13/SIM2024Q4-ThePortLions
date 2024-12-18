<?php
// Car.php
class Car {
    private $pdo;
    private $pdoName = 'car_database';

    public function __construct() {
        $host = 'localhost';
        $user = 'root';
        $pass = '';

        try {
            // Create a new PDO instance for the server connection
            $this->pdo = new PDO("mysql:host=$host", $user, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->pdo->exec("USE {$this->pdoName}");

        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    // Method to fetch all cars from the database
    public function fetchAllCars() {
        try {
            $query = "SELECT * FROM cars";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error fetching cars: " . $e->getMessage();
            return [];
        }
    }

    // Method to insert a new car into the database
    public function insertCar($brand, $model, $year, $price, $description, $mileage, $color, $seller) {
        try {
            $query = "INSERT INTO cars (brand, model, year, price, description, mileage, color, seller)
                      VALUES (:brand, :model, :year, :price, :description, :mileage, :color, :seller)";
            $stmt = $this->pdo->prepare($query);

            // Bind parameters
            $stmt->bindParam(':brand', $brand);
            $stmt->bindParam(':model', $model);
            $stmt->bindParam(':year', $year);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':mileage', $mileage);
            $stmt->bindParam(':color', $color);
			$stmt->bindParam(':seller', $seller);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error adding car: " . $e->getMessage();
            return false;
        }
    }
	
	// Method to fetch a car by its ID
    public function fetchCarById($id) {
        try {
            $query = "SELECT * FROM cars WHERE id = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error fetching car: " . $e->getMessage();
            return false;
        }
    }

	// Method to update car details
    public function updateCar($id, $brand, $model, $year, $price, $description, $mileage, $color) {
        try {
            $query = "UPDATE cars SET brand = :brand, model = :model, year = :year, price = :price, 
                      description = :description, mileage = :mileage, color = :color WHERE id = :id";
            $stmt = $this->pdo->prepare($query);

            // Bind parameters
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':brand', $brand);
            $stmt->bindParam(':model', $model);
            $stmt->bindParam(':year', $year);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':mileage', $mileage);
            $stmt->bindParam(':color', $color);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error updating car: " . $e->getMessage();
            return false;
        }
    }
	
	// Method to search car
	public function searchCars($searchTerm) {
        try {
            $query = "SELECT * FROM cars WHERE brand LIKE :searchTerm OR model LIKE :searchTerm OR year LIKE :searchTerm";
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
	
	// Method to delete car
	public function deleteCarById($carId) {
		try {
			$query = "DELETE FROM cars WHERE id = :car_id";
			$stmt = $this->pdo->prepare($query);
			$stmt->bindParam(':car_id', $carId);
			return $stmt->execute();
		} catch (PDOException $e) {
			echo "Error deleting car: " . $e->getMessage();
			return false;
		}
	}
}
?>
