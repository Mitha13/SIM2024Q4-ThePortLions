<?php
session_start();
include 'UserController.php';

// Ensure Buyer type is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['account_type'] != 2) {
    die("Access denied.");
}

if (!isset($_SESSION['profile_id'])) {
    die("Profile ID is not set. Please log in again.");
}
$prof_id = $_SESSION['profile_id'];

// Fetch buyer's own account information
$controller = new FetchUser();
$user = $controller->getUserById($_SESSION['user_id']);

// Handle Update Form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $updatedUsername = $_POST['username'];
    $updatedPhoneNumber = $_POST['phone_number'];
    $updatedEmail = $_POST['email'];
    $updatedDob = $_POST['dob'];

    // Update the user details
    $updateController = new UpdateUser();
    $updateMessage = $updateController->update(
        $_SESSION['user_id'],
        $_SESSION['account_type'],
        $_SESSION['profile_id'],
        $updatedUsername,
        $updatedPhoneNumber,
        $updatedEmail,
        $updatedDob,
        $user['status']
    );

    // Refresh the user data after update
    $user = $controller->getUserById($_SESSION['user_id']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buyer Dashboard</title>
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
        .update-form {
            margin-top: 30px;
        }
        .update-form input {
            padding: 8px;
            width: 100%;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .update-form button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
        }
        .update-form button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="dashboard-container">
    <h1>Buyer Dashboard</h1>
    <p><center>Welcome Buyer, <?php echo htmlspecialchars($user['username']); ?> </center></p>

    <h2>Your Account Details</h2>
    <p>Username: <?php echo htmlspecialchars($user['username']); ?></p>
    <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
    <p>Phone Number: <?php echo htmlspecialchars($user['phone_number']); ?></p>
    <p>Date of Birth: <?php echo htmlspecialchars($user['dob']); ?></p>
    <p>Status: <?php echo htmlspecialchars($user['status']); ?></p>

    <div class="form-container">
        <h3>Update Your Account Information</h3>
        <form method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

            <label for="phone_number">Phone Number:</label>
            <input type="text" id="phone_number" name="phone_number" value="<?php echo htmlspecialchars($user['phone_number']); ?>" required>

            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" value="<?php echo htmlspecialchars($user['dob']); ?>" required>

            <button type="submit">Update</button>
        </form>
        <?php
        if (isset($updateMessage)) {
            echo "<p>$updateMessage</p>";
        }
        ?>
    </div><br>

    <div class="action-buttons">
        <a href="buyer_viewCar.php">View Car Listings</a>
		<a href="buyer_viewShortlist.php">View your Shortlist</a>
		<a href="buyer_viewReview.php">Your Reviews</a>
    </div>

    <div class="logout">
        <a href="logout.php">Log Out</a>
    </div>
</div>

</body>
</html>
