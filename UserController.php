<?php
// UserController.php (Control)
include_once 'db.php';
include_once 'User.php';  // Include the User entity class

// Class for registering a new user
class RegisterUser {
    public function registerUser($account_type, $profile_id, $username, $phone_number, $email, $password, $dob) {
        global $pdo;
        $user = new User($account_type, $profile_id, $username, $phone_number, $email, $password, 'active', $dob);
        return $user->save($pdo) ? "Registration successful!" : "Registration failed.";
    }
}

class CreateUser {
    public function create($account_type, $profile_id, $username, $phone_number, $email, $password, $dob) {
        global $pdo;
        $user = new User($account_type, $profile_id, $username, $phone_number, $email, $password, 'active', $dob);
        return $user->save($pdo) ? "User created successfully!" : "User creation failed.";
    }
}

class FetchUser {
    public function getUserById($id) {
        global $pdo;
        return User::findById($pdo, $id);
    }

    public function getUserByUsername($username) {
        global $pdo;
        return User::findByUsername($pdo, $username);
    }

    public function getUserByField($field, $value) {
        global $pdo;
        return User::findByField($pdo, $field, $value);
    }
}

// Class for logging in a user
class LoginUser {
    public function login($username, $password) {
        global $pdo;
        $userData = User::findByUsername($pdo, $username);
        return ($userData && password_verify($password, $userData['password'])) ? $userData : false;
    }
}

// Class for updating a user
class UpdateUser {
    public function update($id, $account_type, $profile_id, $username, $phone_number, $email, $dob, $status) {
        global $pdo;
        $user = new User($account_type, $profile_id, $username, $phone_number, $email, null, $status, $dob, $id);
        return $user->update($pdo) ? "User account updated successfully!" : "Update failed.";
    }
}

// Class for suspending a user
class SuspendUser {
    public function suspend($id) {
        global $pdo;
        $user = new User(null, null, null, null, null, null, 'suspended', null, $id);
        return $user->suspend($pdo) ? "User account suspended!" : "Suspension failed.";
    }
}

// Class for fetching all users
class GetAllUsers {
    public function getAll() {
        global $pdo;
        return User::getAll($pdo);
    }
}
?>
