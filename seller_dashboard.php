<?php
session_start();
include 'UserController.php';

// Ensure Seller type is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['account_type'] != 3) {
    die("Access denied.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Dashboard</title>
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

<div class="dashboard-container">
    <h1>Seller Dashboard</h1>
	<?php
		echo "<p><center>Welcome Seller, ". $_SESSION['username']. " </center></p>";
	?>

    <div class="action-buttons">
        <!-- As seller, roles are only to view buyer who shortlisted their car, rest tbc -->
        <!-- <a href="addCar.php?action=manage_accounts">Add New Car</a> -->
        <a href="view_buyer_shortlist.php?action=manage_profiles">View Buyer Interest</a>
    </div>

    <div class="logout">
        <a href="logout.php">Log Out</a>
    </div>
</div>

</body>
</html>