<?php
session_start();
// Ensure Buyer type is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['account_type'] != 2) {
    die("Access denied.");
}
// viewCar.php
require_once 'CarController.php';
require_once 'ShortlistController.php'; // Include the ShortlistGetCarController

// Create controller instances
$GetCarsController = new GetCars();
$SearchCarController = new SearchCar();
$AddCarToShortlistController = new AddToShortlist();

// Handle shortlist action
if (isset($_POST['shortlist'])) {
	$userId = $_SESSION['user_id'];
	$username = $_SESSION['username'];
    $carId = $_POST['car_id'];
	$seller = $_POST['seller'];
    if ($AddCarToShortlistController->AddToShortlist($carId, $userId, $username, $seller)) {
        $_SESSION['shortlist_message'] = "Car has been added to your shortlist.";
    }
}

// Handle search action
$searchTerm = '';
if (isset($_POST['search'])) {
    $searchTerm = trim($_POST['search_term']);
    $cars = $SearchCarController->searchCar($searchTerm); // Fetch cars based on search term
} else {
    $cars = $GetCarsController->getCars(); // Fetch all cars if no search term is provided
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Cars</title>
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

        .update-button, .shortlist-button, .delete-button {
            padding: 5px 10px;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }

        .update-button {
            background-color: #4CAF50;
        }

        .update-button:hover {
            background-color: #45a049;
        }

        .shortlist-button {
            background-color: #008CBA; /* Blue color for shortlist button */
        }

        .shortlist-button:hover {
            background-color: #007BB5;
        }

        .delete-button {
            background-color: #f44336; /* Red color for delete button */
        }

        .delete-button:hover {
            background-color: #e53935;
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
        <h1>Cars Available</h1>
        
        <!-- Display success message -->
        <?php if (isset($_SESSION['shortlist_message'])): ?>
            <div style="color: green; font-weight: bold;"><?php echo htmlspecialchars($_SESSION['shortlist_message']); ?></div>
            <?php unset($_SESSION['shortlist_message']); // Unset after displaying ?>
        <?php endif; ?>

        <!-- Search form -->
        <form method="post">
            <input type="text" name="search_term" placeholder="Search by brand, model, or year" value="<?php echo htmlspecialchars($searchTerm); ?>">
            <button type="submit" name="search">Search</button>
        </form>

        <?php if (count($cars) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Year</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Mileage</th>
                        <th>Color</th>
						<th>Seller</th>
                        <th>Added On</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cars as $car): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($car['brand']); ?></td>
                            <td><?php echo htmlspecialchars($car['model']); ?></td>
                            <td><?php echo htmlspecialchars($car['year']); ?></td>
                            <td><?php echo htmlspecialchars($car['price']); ?></td>
                            <td><?php echo htmlspecialchars($car['description']); ?></td>
                            <td><?php echo htmlspecialchars($car['mileage']); ?></td>
                            <td><?php echo htmlspecialchars($car['color']); ?></td>
							<td><?php echo htmlspecialchars($car['seller']); ?></td>
                            <td><?php echo htmlspecialchars($car['created_at']); ?></td>
                            <td>
                                <!-- Shortlist button -->
                                <form method="post" style="display:inline;">
                                    <input type="hidden" name="car_id" value="<?php echo $car['id']; ?>">
									<input type="hidden" name="seller" value="<?php echo $car['seller']; ?>">
                                    <button type="submit" name="shortlist" class="shortlist-button">Add To Shortlist</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No cars available.</p>
        <?php endif; ?>
    </div>

</body>
</html>
