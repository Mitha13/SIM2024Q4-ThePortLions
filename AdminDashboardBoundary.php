<?php
class AdminDashboardBoundary {
    private $controller;

    public function __construct($controller) {
        $this->controller = $controller;
    }

    public function handleRequest() {
        $users = [];
        if (isset($_GET['search']) && isset($_GET['search_field'])) {
            // Handle search request
            $searchField = $_GET['search_field'];
            $searchTerm = $_GET['search'];
            $users = $this->controller->getUserByField($searchField, $searchTerm);
        } else {
            // Fetch all users
            $users = $this->controller->getAll();
        }
        return $users;
    }
}
