<?php
// UserProfile.php (Entity)
class UserProfile {
    private $id;
    private $userRole;
    private $description;

    public function __construct($id, $userRole, $description) {
        $this->id = $id;
        $this->userRole = $userRole;
        $this->description = $description;
    }

    public function getId() {
        return $this->id;
    }

    public function getUserRole() {
        return $this->userRole;
    }

    public function getDescription() {
        return $this->description;
    }
}
?>
