<?php
session_start();
include 'UserProfileController.php'; // Ensure this includes all your controller class files

// Ensure admin is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['account_type'] != 1) {
    die("Access denied.");
}

// Instantiate controller classes
$createController = new CreateUserProfileController();
$getAllController = new GetAllUserProfilesController();
$updateController = new UpdateUserProfileController();
$suspendController = new SuspendUserProfileController();
$searchController = new SearchUserProfilesController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle form submissions based on the action requested
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'create':
                // Create a new profile
                $userRole = $_POST['UserRole'];
                $description = $_POST['Description'];
                $createController->execute($userRole, $description);
                break;

            case 'update':
                // Update an existing profile
                $id = $_POST['id'];
                $userRole = $_POST['UserRole'];
                $description = $_POST['Description'];
                $updateController->execute($id, $userRole, $description);
                break;

            case 'suspend':
                // Suspend a profile
                $id = $_POST['id'];
                $suspendController->execute($id);
                break;

            case 'search':
                // Search for profiles
                $userRole = $_POST['UserRole'];
                $profiles = $searchController->execute($userRole);
                break;
        }
    }
}

// Fetch all profiles if not searching
$profiles = isset($profiles) ? $profiles : $getAllController->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        h1, h2 {
            color: #333;
        }
        form {
            margin-bottom: 20px;
            padding: 10px;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <h1>User Profile Management</h1>

    <!-- Create new profile form -->
    <h2>Create New Profile</h2>
    <form method="POST" action="Profile.php">
        <input type="hidden" name="action" value="create">
        <label for="UserRole">User Role:</label>
        <input type="text" id="UserRole" name="UserRole" required>

        <label for="Description">Description:</label>
        <textarea id="Description" name="Description" required></textarea>

        <button type="submit">Create Profile</button>
    </form>

    <!-- Update profile form -->
    <h2>Update Profile</h2>
    <form method="POST" action="Profile.php">
        <input type="hidden" name="action" value="update">
        <label for="id">Profile ID:</label>
        <input type="text" id="id" name="id" required>

        <label for="UserRole">User Role:</label>
        <input type="text" id="UserRole" name="UserRole" required>

        <label for="Description">Description:</label>
        <textarea id="Description" name="Description" required></textarea>

        <button type="submit">Update Profile</button>
    </form>

    <!-- Suspend profile form -->
    <h2>Suspend Profile</h2>
    <form method="POST" action="Profile.php">
        <input type="hidden" name="action" value="suspend">
        <label for="id">Profile ID:</label>
        <input type="text" id="id" name="id" required>

        <button type="submit">Suspend Profile</button>
    </form>

    <!-- Search profiles form -->
    <h2>Search Profiles</h2>
    <form method="POST" action="Profile.php">
        <input type="hidden" name="action" value="search">
        <label for="UserRole">User Role:</label>
        <input type="text" id="UserRole" name="UserRole">

        <button type="submit">Search Profiles</button>
    </form>

    <!-- Displaying the profiles in a table -->
    <h2>All Profiles</h2>
    <table>
        <tr>
            <th>Profile ID</th>
            <th>User Role</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($profiles as $profile): ?>
        <tr>
            <td><?php echo htmlspecialchars($profile['id']); ?></td>
            <td><?php echo htmlspecialchars($profile['UserRole']); ?></td>
            <td><?php echo htmlspecialchars($profile['Description']); ?></td>
            <td>
                <form method="POST" action="Profile.php" style="display:inline;">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id" value="<?php echo $profile['id']; ?>">
                    <input type="text" name="UserRole" value="<?php echo htmlspecialchars($profile['UserRole']); ?>" required>
                    <textarea name="Description" required><?php echo htmlspecialchars($profile['Description']); ?></textarea>
                    <button type="submit">Update</button>
                </form>
                <form method="POST" action="Profile.php" style="display:inline;">
                    <input type="hidden" name="action" value="suspend">
                    <input type="hidden" name="id" value="<?php echo $profile['id']; ?>">
                    <button type="submit">Suspend</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <p>Back to dashboard <a href="dashboard.php">Home</a></p>
</body>
</html>
