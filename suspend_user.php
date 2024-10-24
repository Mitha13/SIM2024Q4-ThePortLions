<?php
// Ensure admin is logged in
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['account_type'] != 1) {
    die("Access denied.");
}

if (isset($_GET['id'])) {
    include 'UserController.php';
    $controller = new SuspendUser();

    // Suspend the user
    $message = $controller->suspend($_GET['id']);  // Call the correct method 'suspend'

    // Redirect back to admin dashboard after suspension
    header("Location: admin_dashboard.php?message=" . urlencode($message));
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Suspend User Account</title>
</head>
<body>
    <h1>Suspend User Account</h1>
    <p><?php echo isset($message) ? $message : ''; ?></p>
    <a href="admin_dashboard.php">Back to Dashboard</a>
</body>
</html>
