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
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Use the CreateUser class to handle user creation
    $createUser = new CreateUser();
    $result = $createUser->create($account_type, $profile_id, $username, $phone_number, $email, $password, $dob);

    // Display the result message
    echo $result;
}
?>

<!-- UPDATED CREATE USER FORM -->
<link rel="stylesheet" href="./styles/create_user.css">
<div class="form-container">
    <h2>Create User</h2>
    <form method="POST" action="create_user.php">
        <div class="form-group">
            <select class='userselect' name="account_type">
                <option value="1">Admin</option>
                <option value="2">Buyer</option>
                <option value="3">Seller</option>
                <option value="4">Used Car Agent</option>
            </select>
        </div>
        <div class="form-group">
        <label class='labels' for="profile_id">Profile ID:</label>
        <input type="text" name="profile_id" placeholder="Profile ID" required>
        </div>
        <div class="form-group">
        <label class='labels' for="username">Username:</label>
        <input type="text" name="username" placeholder="Username" required>
        </div>
        <div class="form-group">
        <label class='labels' for="phone_number">Phone Number:</label>
        <input type="text" name="phone_number" placeholder="Phone Number">
        </div>
        <div class="form-group">
        <label class='labels' for="email">Email:</label>
        <input type="email" name="email" placeholder="Email" required>
        </div>
        <div class="form-group">
        <label class='labels' for="password">Password:</label>
        <input type="password" name="password" placeholder="Password" required>
        </div>
        <div class="form-group">
        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" required>
        </div>
        <button type="submit" class="submit-btn" value="Create User">Submit</button>
        <p>Back to dashboard <a href="admin_dashboard.php">Home</a></p>
    </form>
</div>