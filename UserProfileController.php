<?php
// UserProfileController.php (Control)
include 'db.php';
include 'UserProfile.php';

class UserProfileController {

    // Create a new user profile
    public function createUserProfile($userRole, $description) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO UserProfile (UserRole, Description) VALUES (?, ?)");
        $stmt->execute([$userRole, $description]);
        return "User Profile created successfully!";
    }

    // View all user profiles
    public function getAllUserProfiles() {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM UserProfile");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fetch a user profile by ID
    public function getUserProfileById($id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM UserProfile WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update a user profile
    public function updateUserProfile($id, $userRole, $description) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE UserProfile SET UserRole = ?, Description = ? WHERE id = ?");
        $stmt->execute([$userRole, $description, $id]);
        return "User Profile updated successfully!";
    }

    // Suspend a user profile (mark it as inactive)
    public function suspendUserProfile($id) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE UserProfile SET status = 'suspended' WHERE id = ?");
        $stmt->execute([$id]);
        return "User Profile suspended!";
    }

    // Search for user profiles by role
    public function searchUserProfiles($userRole) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM UserProfile WHERE UserRole LIKE ?");
        $stmt->execute(["%$userRole%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
