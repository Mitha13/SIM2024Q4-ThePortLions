<?php
require_once 'CarController.php';

session_start(); // Start the session to use session variables

// Create an instance
$GetCarIdController = new FetchCarById();

// Check if car_id is provided
$carId = isset($_GET['car_id']) ? $_GET['car_id'] : null;
$car = $GetCarIdController->fetchCarById($carId); // Fetch the car details

if (!$car) {
    die("Car not found.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Hardcode user_id (you can replace this with dynamic user ID if needed)
    $_SESSION['user_id'] = 1; // Example user ID
    $_SESSION['car_id'] = $carId; // Store car_id in session

    // Notify user and redirect to review page
    $_SESSION['purchase_message'] = "The car agent has been informed about your purchase.";
    header("Location: reviewPage.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Purchase</title>
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

        .confirm-button, .cancel-button {
            padding: 10px 15px;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .confirm-button {
            background-color: #4CAF50;
        }

        .confirm-button:hover {
            background-color: #45a049;
        }

        .cancel-button {
            background-color: #f44336;
        }

        .cancel-button:hover {
            background-color: #e53935;
        }

        .car-details {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <!-- Navigation bar with links -->
    <div class="navbar">
        <a href="index.php">Home</a>
        <a href="addCar.php">Add Car</a>
        <a href="viewCar.php">View Cars</a>
        <a href="viewShortlist.php">View Shortlist</a>
    </div>

    <div class="container">
        <h1>Confirm Purchase</h1>

        <div class="car-details">
            <p><strong>Brand:</strong> <?php echo htmlspecialchars($car['brand']); ?></p>
            <p><strong>Model:</strong> <?php echo htmlspecialchars($car['model']); ?></p>
            <p><strong>Year:</strong> <?php echo htmlspecialchars($car['year']); ?></p>
            <p><strong>Price:</strong> <?php echo htmlspecialchars($car['price']); ?></p>
            <p><strong>Description:</strong> <?php echo htmlspecialchars($car['description']); ?></p>
            <p><strong>Mileage:</strong> <?php echo htmlspecialchars($car['mileage']); ?></p>
            <p><strong>Color:</strong> <?php echo htmlspecialchars($car['color']); ?></p>
			<p><strong>Seller:</strong> <?php echo htmlspecialchars($car['seller']); ?></p>
        </div>

        <form action="" method="POST">
            <button type="submit" class="confirm-button">Confirm</button>
        </form>

        <form action="buyer_viewShortlist.php" method="GET" style="display:inline;">
            <button type="submit" class="cancel-button">Cancel</button>
        </form>
    </div>

</body>
</html>
