<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize inputs
    $totalLoan = isset($_POST['total_loan']) ? floatval($_POST['total_loan']) : 0;
    $interestRate = isset($_POST['interest_rate']) ? floatval($_POST['interest_rate']) : 0;
    $tenure = isset($_POST['tenure']) ? intval($_POST['tenure']) : 0;

    // Calculations
    $monthlyInterestRate = $interestRate / 100 / 12;
    if ($monthlyInterestRate > 0 && $tenure > 0) {
        $monthlyInstallment = $totalLoan * $monthlyInterestRate / (1 - pow(1 + $monthlyInterestRate, -$tenure));
        $totalInterest = ($monthlyInstallment * $tenure) - $totalLoan;
    } else {
        $monthlyInstallment = 0;
        $totalInterest = 0;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Calculator</title>
    <style>
        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            font-family: Arial, sans-serif;
            text-align: center;
        }

        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 8px;
            margin: 10px 0;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #008CBA;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #007BB5;
        }

        .back-button {
            display: inline-block;
            background-color: #333;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }

        .back-button:hover {
            background-color: #555;
        }

        .result {
            margin-top: 20px;
            padding: 10px;
            background-color: #f2f2f2;
            border: 1px solid #ddd;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Loan Calculator</h2>
    <form method="POST">
        <label for="total_loan">Total Loan Amount</label>
        <input type="number" name="total_loan" id="total_loan" step="0.01" required value="<?php echo isset($totalLoan) ? htmlspecialchars($totalLoan) : ''; ?>">

        <label for="interest_rate">Annual Interest Rate (%)</label>
        <input type="number" name="interest_rate" id="interest_rate" step="0.01" required value="<?php echo isset($interestRate) ? htmlspecialchars($interestRate) : ''; ?>">

        <label for="tenure">Tenure (Months)</label>
        <input type="number" name="tenure" id="tenure" required value="<?php echo isset($tenure) ? htmlspecialchars($tenure) : ''; ?>">

        <button type="submit">Calculate</button>
    </form>

    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
        <div class="result">
            <p><strong>Monthly Instalment:</strong> <?php echo number_format($monthlyInstallment, 2); ?> </p>
        </div>
    <?php endif; ?>

    <!-- Centered Back to View Shortlist Button at the Bottom -->
    <a href="buyer_dashboard.php" class="back-button">Back to Dashboard</a>
</div>

</body>
</html>
