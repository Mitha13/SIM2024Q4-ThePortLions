<?php
// updateCar.php
require_once 'CarController.php';

// create GetCarIdController instances
$GetCarIdController = new FetchCarById();
$UpdateCarController = new UpdateCar();

// Check if the car ID is provided
if (isset($_GET['id'])) {
    $carId = $_GET['id'];
    $car = $GetCarIdController->fetchCarById($carId); // Fetch the car details
} else {
    die("Car ID is not specified.");
}

// Handle form submission for updating car details
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get updated car details from the form
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $mileage = $_POST['mileage'];
    $color = $_POST['color'];

    // Update the car details
    if ($UpdateCarController->updateCar($carId, $brand, $model, $year, $price, $description, $mileage, $color)) {
        header('Location: agent_viewCar.php'); // Redirect after successful update
        exit;
    } else {
        $error = "Failed to update the car.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Car</title>
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

        input[type="text"],
        input[type="number"],
        input[type="decimal"],
        textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        h1 {
            margin-bottom: 20px;
        }

        .error {
            color: red;
        }

        .delete-button {
            background-color: #f44336; /* Red color for delete button */
            margin-top: 20px;
        }

        .delete-button:hover {
            background-color: #e53935;
        }
    </style>
</head>
<body>

    <!-- Navigation bar with link to home -->
    <div class="navbar">
        <a href="agent_viewCar.php">Back to Car Listings</a>
    </div>

    <div class="container">
        <h1>Update Car Details</h1>

        <?php if (isset($error)): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form method="post" action="">
            <input type="text" name="brand" placeholder="Brand" value="<?php echo htmlspecialchars($car['brand']); ?>" required>
            <input type="text" name="model" placeholder="Model" value="<?php echo htmlspecialchars($car['model']); ?>" required>
            <input type="number" name="year" placeholder="Year" value="<?php echo htmlspecialchars($car['year']); ?>" required>
            <input type="decimal" name="price" placeholder="Price" value="<?php echo htmlspecialchars($car['price']); ?>" required>
            <textarea name="description" placeholder="Description" required><?php echo htmlspecialchars($car['description']); ?></textarea>
            <input type="number" name="mileage" placeholder="Mileage" value="<?php echo htmlspecialchars($car['mileage']); ?>" required>
            <input type="text" name="color" placeholder="Color" value="<?php echo htmlspecialchars($car['color']); ?>" required>

            <button type="submit">Update Car</button>
        </form>
    </div>

</body>
</html>
