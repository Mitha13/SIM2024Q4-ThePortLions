<?php
// ShortlistController.php
require_once 'Shortlist.php';
require_once 'Car.php'; // Include the car to fetch details

class AddToShortlist {
	private $shortlist;
    private $car;

    public function __construct() {
        $this->shortlist = new Shortlist();
        $this->car = new Car();
    }

    public function addToShortlist($carId, $userId, $username, $seller) {
        // Fetch car details based on car ID
        $carDetails = $this->car->fetchCarById($carId);
        if ($carDetails) {
            // Add to shortlist
            return $this->shortlist->addToShortlist($userId, $username, $carId, $seller, $carDetails['brand'], $carDetails['model'], $carDetails['price']);
        }
        return false; // Car not found
    }
}

class GetShortlistedCars {
	private $shortlist;

    public function __construct() {
        $this->shortlist = new Shortlist();
    }

    public function getShortlistedCars() {
        return $this->shortlist->getShortlistedCars();
    }
}
class GetShortlistedCarsByUser {
	private $shortlist;

    public function __construct() {
        $this->shortlist = new Shortlist();
    }

    public function getShortlistedCarsByUser($username) {
        return $this->shortlist->getShortlistedCarsByUser($username);
    }
}

class GetShortlistedCarsBySeller {
	private $shortlist;

    public function __construct() {
        $this->shortlist = new Shortlist();
    }

    public function getShortlistedCarsBySeller($seller) {
        return $this->shortlist->getShortlistedCarsBySeller($seller);
    }
}

class RemoveFromShortlist {
	private $shortlist;

    public function __construct() {
        $this->shortlist = new Shortlist();
    }

    public function removeFromShortlist($carId) {
        return $this->shortlist->deleteShortlistedCar($carId);
    }
}

class SearchShortlistedCar {
	private $shortlist;

    public function __construct() {
        $this->shortlist = new Shortlist();
    }

    public function searchShortlistedCar($username, $searchTerm) {
        return $this->shortlist->searchShortlistedCars($username, $searchTerm);
    }
}

?>
