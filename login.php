<?php
session_start();
include 'UserController.php'; // Make sure this path is correct

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $loginController = new LoginUser(); // Using the LoginUser class from UserController.php

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Attempt to log in
    $user = $loginController->login($username, $password);

    // Check if login is successful
    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['account_type'] = $user['account_type'];

        // Redirect based on account type
        if ($user['status'] === 'active') {
            if ($user['account_type'] == 1) {
                header("Location: admin_dashboard.php"); // Admin dashboard
            } elseif ($user['account_type'] == 2) {
                header("Location: buyer_dashboard.php"); // Buyer dashboard
            } elseif ($user['account_type'] == 3) {
                header("Location: seller_dashboard.php"); // Seller dashboard
            } elseif ($user['account_type'] == 4) {
                header("Location: agent_dashboard.php"); // Used Car Agent dashboard
            }
            exit();
        } else {
            echo "Account suspended.";
        }
    } else {
        echo "Invalid credentials.";
    }
}
?>

<!-- HTML Form for Login -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Your Perfect Ride - Login</title>
    <link rel="stylesheet" href="./styles/login.css">
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
            <h3>Login to Your Account</h3>
        </div>

        <div class='login-labels'>
            <form action="login.php" method="post">
                <label class='username-label' for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                
                <label class='password-label' for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <button class='submitBtn' type="submit">Login</button>
            </form>
        </div>

        <p>Don't have an account? <a href="register.php">Sign Up</a></p>
    </div>

    <div class="container-right">
        <img class='loginImage' src="./images/loginImage.jpg" alt="login page right side image">
    </div>
</div>

</body>
</html>
