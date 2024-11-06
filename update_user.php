<?php
// Ensure admin is logged in
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['account_type'] != 1) {
    die("Access denied.");
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'UserController.php';
    $controller = new UpdateUser();

    // Get form data
    $id = $_POST['id'];
    $account_type = $_POST['account_type'];
    $profile_id = $_POST['profile_id'];
    $username = $_POST['username'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];  // Add DOB field here
    $status = $_POST['status'];

    // Update the user
    $message = $controller->update($id, $account_type, $profile_id, $username, $phone_number, $email, $dob, $status);

    // Show success message and option to go back to the dashboard
    echo $message;
    echo "<p><strong>Update successful!</strong></p>";
    echo "<p><a href='admin_dashboard.php'>Back to Dashboard</a></p>";
	
} elseif (isset($_GET['id'])) {
    // Fetch existing user data
    include 'UserController.php';
    $fetchController = new FetchUser();
    $user = $fetchController->getUserById($_GET['id']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update User Account</title>
</head>
<body>
    <h1>Update User Account</h1>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>" required>

        <label for="account_type">Account Type:</label>
        <input type="text" id="account_type" name="account_type" value="<?php echo $user['account_type']; ?>" required><br>

        <label for="profile_id">Profile ID:</label>
        <input type="text" id="profile_id" name="profile_id" value="<?php echo $user['profile_id']; ?>" required><br>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>" required><br>

        <label for="phone_number">Phone Number:</label>
        <input type="text" id="phone_number" name="phone_number" value="<?php echo $user['phone_number']; ?>" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required><br>

        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" value="<?php echo $user['dob']; ?>" ><br>

        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="active" <?php if ($user['status'] == 'active') echo 'selected'; ?>>Active</option>
            <option value="suspend" <?php if ($user['status'] == 'suspend') echo 'selected'; ?>>Suspend</option>
        </select><br>

        <button type="submit">Update User</button>
		
		<p>Back to dashboard <a href="admin_dashboard.php">Home</a></p>
    </form>
</body>
</html>
