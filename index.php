<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Mart</title>
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
    </style>
</head>
<body>

    <!-- Navigation bar with links -->
    <div class="navbar">
        <a href="addCar.php">Add Car</a>
        <a href="viewCar.php">View Cars</a> <!-- Link to viewCar.php -->
    </div>

    <div class="container">
        <h1>Welcome to the Car Mart!</h1>
        <p>Your one-stop shop for adding and viewing car listings.</p>
    </div>

</body>
</html>
