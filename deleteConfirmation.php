<?php
session_start();
require_once 'CarController.php';
require_once 'CarDeleteController.php';

$GetCarIdController = new FetchCarById();
$deleteController = new CarDeleteController();

if (isset($_GET['id'])) {
    $carId = $_GET['id'];
    $car = $GetCarIdController->fetchCarById($carId); // Fetch car details
} else {
    die("Car ID is not specified.");
}

// Handle deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($deleteController->deleteCar($carId)) {
        $_SESSION['delete_message'] = "Car has been successfully deleted.";
        header('Location: agent_viewCar.php'); // Redirect after deletion
        exit;
    } else {
        $error = "Failed to delete the car.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Car Confirmation</title>
    <style>
        /* Basic styling */
        .container {
            padding: 20px;
            font-family: Arial, sans-serif;
        }

        .error {
            color: red;
        }

        .success {
            color: green;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Confirm Deletion</h1>

    <?php if (isset($error)): ?>
        <p class="error"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <?php if (isset($car)): ?>
        <p>Are you sure you want to delete the following car?</p>
        <ul>
            <li>Brand: <?php echo htmlspecialchars($car['brand']); ?></li>
            <li>Model: <?php echo htmlspecialchars($car['model']); ?></li>
            <li>Year: <?php echo htmlspecialchars($car['year']); ?></li>
            <li>Price: <?php echo htmlspecialchars($car['price']); ?></li>
            <li>Description: <?php echo htmlspecialchars($car['description']); ?></li>
            <li>Mileage: <?php echo htmlspecialchars($car['mileage']); ?></li>
            <li>Color: <?php echo htmlspecialchars($car['color']); ?></li>
        </ul>

        <form method="post">
            <button type="submit">Yes, delete this car</button>
            <a href="agent_viewCar.php">Cancel</a>
        </form>
    <?php else: ?>
        <p>No car found.</p>
    <?php endif; ?>
</div>

</body>
</html>
