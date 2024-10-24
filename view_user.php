<?php
session_start();
include 'UserController.php'; // Include the updated UserController

// Ensure admin is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['account_type'] != 1) {
    die("Access denied.");
}

if (isset($_GET['id'])) {
    // Instantiate FetchUser class to retrieve user details
    $controller = new FetchUser();
    $user = $controller->getUserById($_GET['id']);

    if (!$user) {
        die("User not found.");
    }
} else {
    die("Invalid request.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }
        .user-details {
            max-width: 600px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
        }
        .logout {
            text-align: center;
            margin-top: 30px;
        }
        .logout a {
            text-decoration: none;
            color: white;
            background-color: #f44336;
            padding: 10px 20px;
            border-radius: 5px;
        }
        .logout a:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>

<div class="user-details">
    <h1>User Details</h1>
    <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
    <p><strong>Account Type:</strong> <?php echo htmlspecialchars($user['account_type']); ?></p>
    <p><strong>Profile ID:</strong> <?php echo htmlspecialchars($user['profile_id']); ?></p>
    <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($user['phone_number']); ?></p>
    <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($user['dob']); ?></p>
    <p><strong>Status:</strong> <?php echo htmlspecialchars($user['status']); ?></p>
    <p><a href="admin_dashboard.php">Back to Dashboard</a></p>
</div>

<div class="logout">
    <a href="logout.php">Log Out</a>
</div>

</body>
</html>
