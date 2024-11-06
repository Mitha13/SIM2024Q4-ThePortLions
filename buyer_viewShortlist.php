<?php
session_start();
// Ensure Buyer type is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['account_type'] != 2) {
    die("Access denied.");
}
// viewShortlist.php
require_once 'ShortlistController.php';
require_once 'CarController.php'; // Include CarController to fetch car details

// Create instances
$GetShortlistedCarsController = new GetShortlistedCars();
$SearchShortlistedCarController = new SearchShortlistedCar();
$GetShortlistedCarsByUserController = new GetShortlistedCarsByUser();
$userShortlistedCars = $GetShortlistedCarsByUserController->getShortlistedCarsByUser($_SESSION['username']); // Fetch all shortlisted cars */

// Handle search action
$searchTerm = '';
if (isset($_POST['search'])) {
	// echo $_SESSION['user_id'];
    $searchTerm = trim($_POST['search_term']);
    $cars = $SearchShortlistedCarController->searchShortlistedCar($_SESSION['username'], $searchTerm); // Fetch cars based on search term
} else {
	// echo $_SESSION['username'];
    $cars = $GetShortlistedCarsByUserController->getShortlistedCarsByUser($_SESSION['username']); // Fetch all cars if no search term is provided
}

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

        .remove-button, .purchase-button, .loan-button {
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
		
		.loan-button {
            background-color: #008CBA;
            color: white;
        }

        .loan-button:hover {
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
        <h1>Your Shortlist</h1>
		
		<!-- Search form -->
        <form method="post">
            <input type="text" name="search_term" placeholder="Search by brand" value="<?php echo htmlspecialchars($searchTerm); ?>" required>
            <button type="submit" name="search">Search</button>
        </form>

        <?php if (count($cars) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Car ID</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Price</th>
						<th>Seller</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cars as $car): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($car['car_id']); ?></td>
                            <td><?php echo htmlspecialchars($car['brand']); ?></td>
                            <td><?php echo htmlspecialchars($car['model']); ?></td>
                            <td><?php echo htmlspecialchars($car['price']); ?></td>
							<td><?php echo htmlspecialchars($car['seller']); ?></td>
                            <td>
                                <!-- Form to remove the car from the shortlist -->
                                <form action="removeFromShortlist.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="car_id" value="<?php echo htmlspecialchars($car['car_id']); ?>">
                                    <button type="submit" class="remove-button">Remove</button>
                                </form>
								
                                <!-- Form to confirm purchase -->
                                <form action="carConfirmation.php" method="GET" style="display:inline;">
                                    <input type="hidden" name="car_id" value="<?php echo htmlspecialchars($car['car_id']); ?>">
                                    <button type="submit" class="purchase-button">Purchase</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No cars in your shortlist.</p>
        <?php endif; ?>
    </div>

</body>
</html>
