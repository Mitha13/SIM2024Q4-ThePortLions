<?php
include 'db.php';
include 'UserProfile.php';

class CreateUserProfileController {
    public function execute($userRole, $description) {
        global $pdo;
        return CreateUserProfileEntity::create($pdo, $userRole, $description);
    }
}

class GetAllUserProfilesController {
    public function execute() {
        global $pdo;
        return GetAllUserProfilesEntity::getAll($pdo);
    }
}

class GetUserProfileByIdController {
    public function execute($id) {
        global $pdo;
        return GetUserProfileByIdEntity::getById($pdo, $id);
    }
}

class UpdateUserProfileController {
    public function execute($id, $userRole, $description) {
        global $pdo;
        return UpdateUserProfileEntity::update($pdo, $id, $userRole, $description);
    }
}

class SuspendUserProfileController {
    public function execute($id) {
        global $pdo;
        return SuspendUserProfileEntity::suspend($pdo, $id);
    }
}

class SearchUserProfilesController {
    public function execute($userRole) {
        global $pdo;
        return SearchUserProfilesEntity::searchByRole($pdo, $userRole);
    }
}
?>
