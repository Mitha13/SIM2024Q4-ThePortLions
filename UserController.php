<?php
// UserController.php (Control)
include_once 'db.php';
include_once 'User.php';  // Include the User class

// Class for registering a new user
class RegisterUser {
    public function registerUser($account_type, $profile_id, $username, $phone_number, $email, $password, $dob) {
        global $pdo;
        $user = new User($account_type, $profile_id, $username, $phone_number, $email, $password, 'active', $dob);
        if ($user->save($pdo)) {
            return "Registration successful!";
        } else {
            return "Registration failed.";
        }
    }
}

class CreateUser {
    public function create($account_type, $profile_id, $username, $phone_number, $email, $password, $dob) {
        global $pdo;
        $user = new User($account_type, $profile_id, $username, $phone_number, $email, $password, 'active', $dob);
        if ($user->save($pdo)) {
            return "User created successfully!";
        } else {
            return "User creation failed.";
        }
    }
}

class FetchUser {
    // Fetch a user by ID
    public function getUserById($id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT id, username, email, account_type, profile_id, phone_number, status, dob FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Fetch a user by username
    public function getUserByUsername($username) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT id, username, email, account_type, profile_id, phone_number, status, dob FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
	
	public function getUserByField($field, $value) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT id, username, email, account_type, profile_id, phone_number, status, dob FROM users WHERE $field = ?");
        $stmt->execute([$value]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

// Class for logging in a user
class LoginUser {
    public function login($username, $password) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;  // Valid login
        } else {
            return false;  // Invalid login
        }
    }
}

// Class for updating a user
class UpdateUser {
    public function update($id, $account_type, $profile_id, $username, $phone_number, $email, $dob, $status) {
        global $pdo;

        try {
            $stmt = $pdo->prepare("UPDATE users SET account_type = ?, profile_id = ?, username = ?, phone_number = ?, email = ?, dob = ?, status = ? WHERE id = ?");
            $stmt->execute([$account_type, $profile_id, $username, $phone_number, $email, $dob, $status, $id]);
            return "User account updated successfully!";
        } catch (PDOException $e) {
            return "Update failed: " . $e->getMessage();
        }
    }
	    public function getUserById($id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Fetch a user by username
    public function getUserByUsername($username) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

// Class for suspending a user
class SuspendUser {
    public function suspend($id) {
        global $pdo;

        try {
            $stmt = $pdo->prepare("UPDATE users SET status = 'suspended' WHERE id = ?");
            $stmt->execute([$id]);
            return "User account suspended!";
        } catch (PDOException $e) {
            return "Suspension failed: " . $e->getMessage();
        }
    }
}

// Class for fetching all users
class GetAllUsers {
    public function getAll() {
        global $pdo;
        $stmt = $pdo->query("SELECT id, username, email, account_type, profile_id, phone_number, status, dob FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
