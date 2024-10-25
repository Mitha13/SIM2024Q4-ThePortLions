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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Your Perfect Ride - Register</title>
    <link rel="stylesheet" href="./styles/register.css">
</head>
<body>
<div class="topnav">
    <div class="logo">
        <img src="./images/headerImage.png" alt="Fast and Furious Logo">
    </div>
</div>

<div class='primary'>
    <div class="container-left">
        <div class='titles'>
            <h1>Find Your Perfect Ride!</h1>
            <h3>Create A New Account!</h3>
        </div>

        <div class='register-labels'>
            <form method="POST" action="register.php">

                <!-- <label class='password-label' for="password">Password:</label>
                <input type="password" id="password" name="password" required> -->
                <div>
                <label class='userselect' >Select a user role:</label>
                    <select class = 'role' name="account_type">
                        <option value="1">Admin</option>
                        <option value="2">Buyer</option>
                        <option value="3">Seller</option>
                        <option value="4">Used Car Agent</option>
                    </select>
                </div>

                    <div>
                    <label class='labels' for="profile_id">Profile ID:</label>
                    <input class='input' type="text" name="profile_id" placeholder="Profile ID" required>
                    </div>

                    <label class='labels' for="username">Username:</label>
                    <input class='input' type="text" name="username" placeholder="Username" required>

                    <label class='labels' for="phone_number">Phone Number:</label>
                    <input class='input' type="text" name="phone_number" placeholder="Phone Number">

                    <label class='labels' for="email">Email:</label>
                    <input class='input' type="email" name="email" placeholder="Email" required>

                    <label class='labels' for="password">Password:</label>
                    <input class='input' type="password" name="password" placeholder="Password" required>

                    <label class='labels' for="dob">Date of Birth:</label>
                    <input class='input' type="date" id="dob" name="dob" required>

                    
                    <p>Have an account? <a href="login.php">Login</a></p>

                <button class='submitBtn' type="submit">Register</button>
            </form>
        </div>

    </div>

    <div class="container-right">
        <img class='loginImage' src="./images/loginImage.jpg" alt="login page right side image">
    </div>
</div>

</body>
</html>
