<?php
// User.php (Entity)
class User {
    public $id; // Optional ID (will be auto-generated on insert)
    public $account_type;
    public $profile_id;
    public $username;
    public $phone_number;
    public $email;
    public $password;
    public $status;
    public $dob;

    // Constructor
    public function __construct($account_type, $profile_id, $username, $phone_number, $email, $password, $status = 'active', $dob = null, $id = null) {
        $this->id = $id; // Optional for new users
        $this->account_type = $account_type;
        $this->profile_id = $profile_id;
        $this->username = $username;
        $this->phone_number = $phone_number;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT); // Password hashing
        $this->status = $status;
        $this->dob = $dob;
    }

    // Save method for new user creation
    public function save($pdo) {
        $stmt = $pdo->prepare("INSERT INTO users (account_type, profile_id, username, phone_number, email, password, status, dob) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$this->account_type, $this->profile_id, $this->username, $this->phone_number, $this->email, $this->password, $this->status, $this->dob]);
    }

    // Update method for existing users
    public function update($pdo) {
        $stmt = $pdo->prepare("UPDATE users SET account_type = ?, profile_id = ?, username = ?, phone_number = ?, email = ?, status = ?, dob = ? WHERE id = ?");
        return $stmt->execute([$this->account_type, $this->profile_id, $this->username, $this->phone_number, $this->email, $this->status, $this->dob, $this->id]);
    }

    // Static method to find a user by ID
    public static function find($pdo, $id) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
	
}


?>
