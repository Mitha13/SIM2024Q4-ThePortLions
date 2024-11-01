<?php
// UserProfile.php (Entity)
class CreateUserProfileEntity {
    public static function create($pdo, $userRole, $description) {
        $stmt = $pdo->prepare("INSERT INTO UserProfile (UserRole, Description) VALUES (?, ?)");
        $stmt->execute([$userRole, $description]);
        return "User Profile created successfully!";
    }
}

class GetAllUserProfilesEntity {
    public static function getAll($pdo) {
        $stmt = $pdo->query("SELECT * FROM UserProfile");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

class GetUserProfileByIdEntity {
    public static function getById($pdo, $id) {
        $stmt = $pdo->prepare("SELECT * FROM UserProfile WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

class UpdateUserProfileEntity {
    public static function update($pdo, $id, $userRole, $description) {
        $stmt = $pdo->prepare("UPDATE UserProfile SET UserRole = ?, Description = ? WHERE id = ?");
        $stmt->execute([$userRole, $description, $id]);
        return "User Profile updated successfully!";
    }
}

class SuspendUserProfileEntity {
    public static function suspend($pdo, $id) {
        $stmt = $pdo->prepare("UPDATE UserProfile SET status = 'suspended' WHERE id = ?");
        $stmt->execute([$id]);
        return "User Profile suspended!";
    }
}

class SearchUserProfilesEntity {
    public static function searchByRole($pdo, $userRole) {
        $stmt = $pdo->prepare("SELECT * FROM UserProfile WHERE UserRole LIKE ?");
        $stmt->execute(["%$userRole%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
