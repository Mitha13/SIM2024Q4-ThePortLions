<?php
session_start();
include 'UserController.php'; // Include the updated UserController

// Ensure admin is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['account_type'] != 1) {
    die("Access denied.");
}

$users = [];

if (isset($_GET['search']) && isset($_GET['search_field'])) {
    // Instantiate FetchUser class for searching by the selected field
    $controller = new FetchUser();
    $searchField = $_GET['search_field'];
    $searchTerm = $_GET['search'];
    $users = $controller->getUserByField($searchField, $searchTerm);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Users</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }
        .search-container {
            max-width: 600px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
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

<div class="search-container">
    <h1>Search Users</h1>
    <form method="GET" action="">
        <select name="search_field" required>
            <option value="username">Username</option>
            <option value="email">Email</option>
            <option value="account_type">Account Type</option>
        </select>
        <input type="text" name="search" placeholder="Enter search term" required>
        <button type="submit">Search</button>
    </form>

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
                        <a href="view_user.php?id=<?php echo $user['id']; ?>">View</a> |
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
    <p><a href="admin_dashboard.php">Back to Dashboard</a></p>
</div>

<div class="logout">
    <a href="logout.php">Log Out</a>
</div>

</body>
</html>
