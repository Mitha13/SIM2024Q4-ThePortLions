<?php
session_start();
// Ensure Seller type is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['account_type'] != 3) {
    die("Access denied.");
}

// viewShortlist.php
require_once 'ShortlistController.php';
require_once 'SellerReviewController.php';
require_once 'CarController.php';

// Create instances
$GetShortlistedCarsController = new GetShortlistedCars();
$reviewController = new SellerReviewController();
$GetSellerReviewController = new GetSellerReviews();
$getUserReviews = $GetSellerReviewController->getSellerReviews($_SESSION['username']); // Fetch reviews for respective user

// retrieve variables
$userId = $_SESSION['user_id'];
$username = $_SESSION['username'];

// Handle form submission for review
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$agent = $_POST['agent'];
	// echo "This is your ". $agent;
    $comment = $_POST['comment'];
    $rating = $_POST['rating'];

    // Save review
    if ($reviewController->saveReview($userId, $username, $agent, $comment, $rating)) {
        // Redirect to a confirmation page or display a success message
        $_SESSION['review_message'] = "Thank you for your review!";
        header("Location: seller_dashboard.php");
        exit;
    }
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
        <a href="view_buyer_shortlist.php">View Buyer Interest</a>
		<a href="seller_viewReview.php">Your Reviews</a>
    </div>

    <div class="container">
        <h1>Your Reviews</h1>

        <?php if (count($getUserReviews) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Agent</th>
                        <th>Comment</th>
                        <th>Rating</th>
						<th>Added On</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($getUserReviews as $review): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($review['agent']); ?></td>
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
	
	<div class="container">
        <h1>Leave a Review</h1>

        <form method="POST">
			<label for="agent">Select Agent:</label>
			<select name="agent" required>
				<option value="">Select an Agent</option>
				<?php
					// Fetch agents from the database and populate the dropdown
					$conn = new mysqli('localhost', 'root', '', 'user_management'); // Replace with actual DB credentials
					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					}

					// Query to get all agents from the user_management table
					$sql = "SELECT username FROM users WHERE account_type = 4";
					$result = $conn->query($sql);

					// Populate the dropdown with the agents
					if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {
							echo "<option value='" . $row['username'] . "'>" . htmlspecialchars($row['username']) . "</option>";
						}
					} else {
						echo "<option value=''>No agents available</option>";
					}

					$conn->close();
				?>
			</select><br><br>
            <textarea name="comment" placeholder="Write your comment here..." required></textarea>
			<br><br>
            Ratings: <select name="rating" required>
                <option value="">Rate the car</option>
                <option value="1">1 Star</option>
                <option value="2">2 Stars</option>
                <option value="3">3 Stars</option>
                <option value="4">4 Stars</option>
                <option value="5">5 Stars</option>
            </select>
			<br><br>
            <button type="submit">Submit Review</button>
        </form>
    </div>
</div>
</body>
</html>
