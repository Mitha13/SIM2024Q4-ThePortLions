<?php
session_start();
include 'UserController.php';  // Include the updated UserController

// Ensure admin is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['account_type'] != 1) {
    die("Access denied.");
}

// Initialize the appropriate controller based on the action
$users = [];

if (isset($_GET['search']) && isset($_GET['search_field'])) {
    // Instantiate FetchUser class for searching by the selected field
    $controller = new FetchUser();
    $searchField = $_GET['search_field'];
    $searchTerm = $_GET['search'];
    $users = $controller->getUserByField($searchField, $searchTerm);
} else {
    // Instantiate GetAllUsers class for fetching all users
    $controller = new GetAllUsers();
    $users = $controller->getAll();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .dashboard-container {
            max-width: 800px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .action-buttons {
            text-align: center;
            margin-bottom: 20px;
        }
        .action-buttons a {
            margin: 0 10px;
            text-decoration: none;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
        }
        .action-buttons a:hover {
            background-color: #45a049;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .search-container {
            text-align: center;
            margin-top: 20px;
        }
        .search-container a {
            text-decoration: none;
            color: #007BFF;
            cursor: pointer;
        }
        .search-form {
            display: none;
            margin-top: 10px;
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
        .message {
            color: green;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="dashboard-container">
    <h1>Admin Dashboard</h1>
	
	

    <?php if (isset($_GET['message'])): ?>
        <div class="message"><?php echo htmlspecialchars($_GET['message']); ?></div>
    <?php endif; ?>

    <div class="action-buttons">
        <a href="create_user.php">Create User Account</a>
    </div>

    <div class="search-container">
        <a id="search-link">Search Users</a>

        <!-- Hidden search form -->
        <form id="search-form" class="search-form" method="GET" action="">
            <select name="search_field">
                <option value="username">Username</option>
                <option value="email">Email</option>
                <option value="account_type">Account Type</option>
            </select>
            <input type="text" name="search" placeholder="Enter search term" required>
            <button type="submit">Search</button>
        </form>
    </div>

    <table>
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Account Type</th>
            <th>Profile ID</th>
            <th>Phone Number</th>
            <th>DOB</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php if ($users): ?>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td><?php echo htmlspecialchars($user['account_type']); ?></td>
                    <td><?php echo htmlspecialchars($user['profile_id']); ?></td>
                    <td><?php echo htmlspecialchars($user['phone_number']); ?></td>
                    <td><?php echo htmlspecialchars($user['dob']); ?></td>
                    <td><?php echo htmlspecialchars($user['status']); ?></td>
                    <td>
                        <a href="update_user.php?id=<?php echo $user['id']; ?>">Update</a> |
                        <a href="suspend_user.php?id=<?php echo $user['id']; ?>">Suspend</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="8">No users found.</td>
            </tr>
        <?php endif; ?>
    </table>
    <p>Back to dashboard <a href="dashboard.php">Home</a></p>

    <div class="logout">
        <a href="logout.php">Log Out</a>
    </div>
</div>

<script>
    document.getElementById('search-link').addEventListener('click', function() {
        const searchForm = document.getElementById('search-form');
        searchForm.style.display = searchForm.style.display === 'block' ? 'none' : 'block';
    });
</script>

</body>
</html>
