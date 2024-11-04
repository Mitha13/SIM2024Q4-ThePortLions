<?php
session_start();
require_once 'reviewController.php';

// Create an instance of ReviewController
$reviewController = new ReviewController();

// Check if the buyer is logged in and has a car_id
if (!isset($_SESSION['user_id']) || !isset($_SESSION['car_id'])) {
    die("Invalid access.");
}

// retrieve variables
$userId = $_SESSION['user_id'];
$username = $_SESSION['username'];
$carId = $_SESSION['car_id'];

// Handle form submission for review
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $comment = $_POST['comment'];
    $rating = $_POST['rating'];

    // Save review
    if ($reviewController->saveReview($userId, $username, $carId, $comment, $rating)) {
        // Redirect to a confirmation page or display a success message
        $_SESSION['review_message'] = "Thank you for your review!";
        header("Location: buyer_dashboard.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Car</title>
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

        input[type="text"], textarea {
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
    </style>
</head>
<body>

    <!-- Navigation bar with links -->
    <div class="navbar">
        <a href="buyer_dashboard.php">Dashboard</a>
        <a href="buyer_viewCar.php">View Cars</a>
        <a href="buyer_viewShortlist.php">View Shortlist</a> <!-- New link for viewing shortlist -->
    </div>

    <div class="container">
        <h1>Leave a Review</h1>

        <form method="POST">
            <textarea name="comment" placeholder="Write your comment here..." required></textarea>
            <select name="rating" required>
                <option value="">Rate the car</option>
                <option value="1">1 Star</option>
                <option value="2">2 Stars</option>
                <option value="3">3 Stars</option>
                <option value="4">4 Stars</option>
                <option value="5">5 Stars</option>
            </select>
            <button type="submit">Submit Review</button>
        </form>
    </div>

</body>
</html>
