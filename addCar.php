<?php
// addCar.php
require_once 'CarController.php';

// Initialize variables for form data
$brand = $model = $year = $price = $description = $mileage = $color = '';
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create an instance for RegisterCarController
    $RegisterCarController = new RegisterCar();

    // Get the form data
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $mileage = $_POST['mileage'];
    $color = $_POST['color'];
	$seller = $_POST['seller'];

    // Register the car
    if ($RegisterCarController->registerCar($brand, $model, $year, $price, $description, $mileage, $color, $seller)) {
        $message = "Car added successfully!";
    } else {
        $message = "Failed to add car.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Car</title>
    <style>
        /* Basic styling for navigation and form */
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

        label, input, textarea, button {
            display: block;
            margin: 10px 0;
        }
    </style>
</head>
<body>

    <!-- Navigation bar with link to home -->
    <div class="navbar">
        <a href="agent_dashboard.php">Back to Home</a>
    </div>

    <div class="container">
        <h2>Add a New Car</h2>

        <?php if ($message): ?>
            <p><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>

        <form action="addCar.php" method="POST">
            <label for="brand">Brand:</label>
            <input type="text" name="brand" required>

            <label for="model">Model:</label>
            <input type="text" name="model" required>

            <label for="year">Year:</label>
            <input type="number" name="year" required>

            <label for="price">Price:</label>
            <input type="number" step="0.01" name="price" required>

            <label for="description">Description:</label>
            <textarea name="description" required></textarea>

            <label for="mileage">Mileage:</label>
            <input type="number" name="mileage" required>

            <label for="color">Color:</label>
            <input type="text" name="color" required>
			
			<label for="seller">Seller:</label>
			<select name="seller" required>
				<option value="">Select a Seller</option>
				<?php
				// Fetch sellers from the database and populate the dropdown
				$conn = new mysqli('localhost', 'root', '', 'user_management'); // Replace with actual DB credentials
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				}

				// Query to get all sellers from the user_management table
				$sql = "SELECT username FROM users WHERE account_type = 3"; // Assuming 'sellers' is the table and it has 'id' and 'username' columns
				$result = $conn->query($sql);

				// Populate the dropdown with the sellers
				if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						echo "<option value='" . $row['username'] . "'>" . htmlspecialchars($row['username']) . "</option>";
					}
				} else {
					echo "<option value=''>No sellers available</option>";
				}

				$conn->close();
				?>
			</select>

            <button type="submit" name="submit">Add Car</button>
        </form>
    </div>

</body>
</html>
