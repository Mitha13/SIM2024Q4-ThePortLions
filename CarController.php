<?php
// CarController.php
require_once 'Car.php';

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

    public function registerCar($brand, $model, $year, $price, $description, $mileage, $color, $seller) {
        return $this->car->insertCar($brand, $model, $year, $price, $description, $mileage, $color, $seller);
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
