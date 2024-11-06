<?php
session_start();
// Ensure Buyer type is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['account_type'] != 2) {
    die("Access denied.");
}

// viewShortlist.php
require_once 'ShortlistController.php';
require_once 'reviewController.php';
require_once 'CarController.php';

// Create instances
$GetShortlistedCarsController = new GetShortlistedCars();
$GetReviewController = new GetReviews();
$getUserReviews = $GetReviewController->getReviews($_SESSION['username']); // Fetch reviews for respective user

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Shortlist</title>
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
        <a href="buyer_dashboard.php">Dashboard</a>
        <a href="buyer_viewCar.php">View Cars</a>
        <a href="buyer_viewShortlist.php">View Shortlist</a>
		<a href="buyer_viewReview.php">Your Reviews</a>
		<a href="loanCalculator.php">Loan Calculator</a>
    </div>

    <div class="container">
        <h1>Your Reviews</h1>

        <?php if (count($getUserReviews) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Car ID</th>
                        <th>Comment</th>
                        <th>Rating</th>
						<th>Added On</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($getUserReviews as $review): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($review['car_id']); ?></td>
                            <td><?php echo htmlspecialchars($review['comment']); ?></td>
                            <td><?php echo htmlspecialchars($review['rating']); ?></td>
							<td><?php echo htmlspecialchars($review['created_at']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>You have not left any reviews.</p>
        <?php endif; ?>
    </div>

</body>
</html>
