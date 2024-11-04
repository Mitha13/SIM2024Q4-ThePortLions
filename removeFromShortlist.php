<?php
// removeFromShortlist.php
require_once 'ShortlistController.php';

// Create an instance
$RemoveCarController = new RemoveFromShortlist();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['car_id'])) {
    $carId = $_POST['car_id'];
    if ($RemoveCarController->removeFromShortlist($carId)) {
        // Successfully removed
        header("Location: buyer_viewShortlist.php");
        exit;
    } else {
        // Handle removal error (optional)
        echo "Error removing the car from your shortlist.";
    }
} else {
    // Handle invalid request
    echo "Invalid request.";
}
?>
