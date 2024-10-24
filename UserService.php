<?php
// UserService.php
class UserService {
    private $pdo;

    public function __construct() {
        // Assuming you have a PDO connection here
        $this->pdo = (new Database())->getConnection();
    }

    // Fetch user by username from the database
    public function getUserByUsername($username) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch();
    }
}
?>