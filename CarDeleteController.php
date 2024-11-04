<?php
// CarDeleteController.php
require_once 'Car.php';

class CarDeleteController {
    private $car;

    public function __construct() {
        $this->car = new Car();
    }

    public function deleteCar($carId) {
        return $this->car->deleteCarById($carId);
    }
}
?>
