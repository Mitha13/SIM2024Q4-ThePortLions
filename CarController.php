<?php
// CarController.php
require_once 'Car.php';

/* class CarController {
    private $car;

    public function __construct() {
        $this->car = new Car();
    }

    // Method to get car entries
    public function getCars() {
        return $this->car->fetchAllCars();
    }

    // Method to register a new car
    public function registerCar($brand, $model, $year, $price, $description, $mileage, $color) {
        return $this->car->insertCar($brand, $model, $year, $price, $description, $mileage, $color);
    }
	
	// Method to fetch a car by its ID
    public function fetchCarById($id) {
        return $this->car->fetchCarById($id);
    }

    // Method to update car details
    public function updateCar($id, $brand, $model, $year, $price, $description, $mileage, $color) {
        return $this->car->updateCar($id, $brand, $model, $year, $price, $description, $mileage, $color);
    }
	
	// Method to search car by term
	public function searchCars($searchTerm) {
        return $this->car->searchCars($searchTerm); // Delegate search to Car model
    }
} */

class GetCars {
	private $car;

    public function __construct() {
        $this->car = new Car();
    }

    public function getCars() {
        return $this->car->fetchAllCars();
    }
}

class RegisterCar {
	private $car;

    public function __construct() {
        $this->car = new Car();
    }

    public function registerCar($brand, $model, $year, $price, $description, $mileage, $color) {
        return $this->car->insertCar($brand, $model, $year, $price, $description, $mileage, $color);
    }
}

class FetchCarById {
	private $car;

    public function __construct() {
        $this->car = new Car();
    }

    public function fetchCarById($id) {
        return $this->car->fetchCarById($id);
    }
}

class UpdateCar {
	private $car;

    public function __construct() {
        $this->car = new Car();
    }

    public function updateCar($id, $brand, $model, $year, $price, $description, $mileage, $color) {
        return $this->car->updateCar($id, $brand, $model, $year, $price, $description, $mileage, $color);
    }
}

class SearchCar {
	private $car;

    public function __construct() {
        $this->car = new Car();
    }

    public function searchCar($searchTerm) {
        return $this->car->searchCars($searchTerm);
    }
}
?>
