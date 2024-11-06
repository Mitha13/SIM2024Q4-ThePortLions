<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['account_type'] != 1) {
    die("Access denied.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once 'db.php'; // Include the database connection
    include_once 'User.php'; // Use include_once to prevent redeclaration
    include_once 'UserController.php'; // Include the controller

    // Get form data
    $account_type = $_POST['account_type'];
    $profile_id = $_POST['profile_id'];
    $username = $_POST['username'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
	$dob = $_POST['dob'];
    $password = $_POST['password'];

    // Use the CreateUser class to handle user creation
    $createUser = new CreateUser();
    $result = $createUser->create($account_type, $profile_id, $username, $phone_number, $email, $password, $dob);

    // Display the result message
    echo $result;
}
?>

<form method="POST" action="create_user.php">
    <select name="account_type">
        <option value="1">Admin</option>
        <option value="2">Buyer</option>
        <option value="3">Seller</option>
        <option value="4">Used Car Agent</option>
    </select>
    <input type="text" name="profile_id" placeholder="Profile ID" required>
    <input type="text" name="username" placeholder="Username" required>
    <input type="text" name="phone_number" placeholder="Phone Number">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <label for="dob">Date of Birth:</label>
    <input type="date" id="dob" name="dob" required>
    <input type="submit" value="Create User">

    <p>Back to dashboard <a href="admin_dashboard.php">Home</a></p>
</form>
