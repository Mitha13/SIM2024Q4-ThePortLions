<?php
// viewShortlist.php
require_once 'ShortlistController.php';
require_once 'CarController.php'; // Include CarController to fetch car details

// Create instances
$GetShortlistedCarsController = new GetShortlistedCars();
/* $controller = new CarController(); */
$shortlistedCars = $GetShortlistedCarsController->getShortlistedCars(); // Fetch all shortlisted cars

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
        <a href="seller_dashboard.php">Dashboard</a>
        <a href="view_buyer_shortlist.php">View Buyer Interests</a>
    </div>

    <div class="container">
        <h1>Your Shortlist</h1>

        <?php if (count($shortlistedCars) > 0): ?>
            <table>
                <thead>
                    <tr>
						<th>User ID</th>
						<th>Username</th>
                        <th>Car ID</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Price</th>
                        <th>Actions</th> <!-- New column for actions -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($shortlistedCars as $car): ?>
                        <tr>
							<td><?php echo htmlspecialchars($car['user_id']); ?></td>
							<td><?php echo htmlspecialchars($car['username']); ?></td>
                            <td><?php echo htmlspecialchars($car['car_id']); ?></td>
                            <td><?php echo htmlspecialchars($car['brand']); ?></td>
                            <td><?php echo htmlspecialchars($car['model']); ?></td>
                            <td><?php echo htmlspecialchars($car['price']); ?></td>
                            <td>
                                <!-- Form to remove the car from the shortlist -->
                                <form action="removeFromShortlist.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="car_id" value="<?php echo htmlspecialchars($car['car_id']); ?>">
                                    <button type="submit" class="remove-button">Remove</button>
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
