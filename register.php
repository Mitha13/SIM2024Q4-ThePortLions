<?php
include 'UserController.php'; // Make sure this path is correct

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $registerController = new RegisterUser(); // Using the RegisterUser class from UserController.php

    $account_type = $_POST['account_type'];
    $profile_id = $_POST['profile_id'];
    $username = $_POST['username'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $dob = $_POST['dob'];

    $result = $registerController->registerUser($account_type, $profile_id, $username, $phone_number, $email, $password, $dob);
    
    echo $result; // Display the result (success or failure message)
}
?>

<!-- HTML Form for Registering a User -->
<form method="POST" action="register.php">
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
    <input type="submit" value="Register">
    <p>Have an account? <a href="login.php">Login</a></p>
</form>
