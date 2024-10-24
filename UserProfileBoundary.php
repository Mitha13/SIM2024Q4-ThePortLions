<?php
// UserProfileBoundary.php (Boundary)
include 'UserProfileController.php';

class UserProfileBoundary {
    
    private $userProfileController;

    public function __construct() {
        $this->userProfileController = new UserProfileController();
    }

    // Create a new user profile from form input
    public function createNewProfile() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userRole = $_POST['user_role'];
            $description = $_POST['description'];
            return $this->userProfileController->createUserProfile($userRole, $description);
        }
    }

    // Display all profiles
    public function displayAllProfiles() {
        $profiles = $this->userProfileController->getAllUserProfiles();
        foreach ($profiles as $profile) {
            echo "ID: " . $profile['id'] . " | Role: " . $profile['UserRole'] . " | Description: " . $profile['Description'] . "<br>";
        }
    }

    // Handle profile update
    public function updateProfile() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $userRole = $_POST['user_role'];
            $description = $_POST['description'];
            return $this->userProfileController->updateUserProfile($id, $userRole, $description);
        }
    }

    // Suspend profile
    public function suspendProfile() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            return $this->userProfileController->suspendUserProfile($id);
        }
    }

    // Search profiles
    public function searchProfiles() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userRole = $_POST['user_role'];
            $profiles = $this->userProfileController->searchUserProfiles($userRole);
            foreach ($profiles as $profile) {
                echo "ID: " . $profile['id'] . " | Role: " . $profile['UserRole'] . " | Description: " . $profile['Description'] . "<br>";
            }
        }
    }
}
?>
