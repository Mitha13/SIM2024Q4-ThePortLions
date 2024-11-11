<?php
session_start();
// Ensure Buyer type is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['account_type'] != 4) {
    die("Access denied.");
}

// viewShortlist.php
require_once 'ShortlistController.php';
require_once 'AgentReviewController.php';
require_once 'CarController.php';

// Create instances
$GetShortlistedCarsController = new GetShortlistedCars();
$GetBuyerReviewController = new GetReviewByBuyer();
$GetSellerReviewController = new GetReviewBySeller();
$getBuyerReviews = $GetBuyerReviewController->getBuyerReviews($_SESSION['username']);
$getSellerReviews = $GetSellerReviewController->getSellerReviews($_SESSION['username']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View reviews</title>
    <style>
        /* Basic styling for navigation */
        .navbar {
            background-color: #333;
            overflow: hidden;
            padding: 10px;
        }

        .navbar a {
            color: #f2f2f2;
            text-decoration: none;
            padding: 8px 16px;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        .container {
            padding: 20px;
            font-family: Arial, sans-serif;
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
            background-color: #f2f2f2;
        }

        .remove-button, .purchase-button {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .remove-button {
            background-color: #f44336;
            color: white;
        }

        .remove-button:hover {
            background-color: #e53935;
        }

        .purchase-button {
            background-color: #008CBA;
            color: white;
        }

        .purchase-button:hover {
            background-color: #007BB5;
        }
    </style>
</head>
<body>

    <!-- Navigation bar with links -->
    <div class="navbar">
		<a href="agent_dashboard.php">Dashboard</a>
        <a href="addCar.php?action=manage_accounts">Add New Car</a>
        <a href="agent_viewCar.php?action=manage_profiles">View Car Listings</a>
		<a href="agent_viewReview.php?action=manage_profiles">See your Reviews</a>
    </div>

    <div class="container">
        <h1>Here are the buyer reviews</h1>
		
        <?php if (count($getBuyerReviews) > 0): ?>
            <table>
                <thead>
                    <tr>
						<th>Username</th>
                        <th>Comment</th>
                        <th>Rating</th>
						<th>Added On</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($getBuyerReviews as $buyer): ?>
                        <tr>
							<td><?php echo htmlspecialchars($buyer['username']); ?></td>
                            <td><?php echo htmlspecialchars($buyer['comment']); ?></td>
                            <td><?php echo htmlspecialchars($buyer['rating']); ?></td>
							<td><?php echo htmlspecialchars($buyer['created_at']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No buyer left any reviews of you.</p>
        <?php endif; ?>
    </div>
	
	<div class="container">
        <h1>Here are the seller reviews</h1>
		
        <?php if (count($getSellerReviews) > 0): ?>
            <table>
                <thead>
                    <tr>
						<th>Username</th>
                        <th>Comment</th>
                        <th>Rating</th>
						<th>Added On</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($getSellerReviews as $seller): ?>
                        <tr>
							<td><?php echo htmlspecialchars($seller['username']); ?></td>
                            <td><?php echo htmlspecialchars($seller['comment']); ?></td>
                            <td><?php echo htmlspecialchars($seller['rating']); ?></td>
							<td><?php echo htmlspecialchars($seller['created_at']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No seller left any reviews of you.</p>
        <?php endif; ?>
    </div>

</body>
</html>
