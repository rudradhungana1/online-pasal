<?php
session_start();

// Check if order details exist in the session
if (!isset($_SESSION['order_details'])) {
    header('Location: checkout.php');
    exit();
}

// Order details from session
$order_details = $_SESSION['order_details'];
$total_amount = $order_details['total'];
$order_id = uniqid(); // Generate a unique order ID for this transaction

// Esewa Payment Gateway URL (Sandbox Environment for testing)
$esewa_payment_url = "https://uat.esewa.com.np/epay/main";

// Esewa required parameters
$params = [
    'amt' => $total_amount, // Total amount
    'pdc' => 0,             // Tax or partial payment (0 for now)
    'psc' => 0,             // Service charge (0 for now)
    'txAmt' => 0,           // Tax amount (0 for now)
    'tAmt' => $total_amount, // Final payable amount
    'pid' => $order_id,      // Unique product ID for transaction
    'scd' => 'EPAYTEST',     // Merchant code for sandbox (replace with live code)
    'su' => 'http://localhost/gitashop/success.php', // Success URL
    'fu' => 'http://localhost/gitashop/failure.php', // Failure URL
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esewa Payment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .container {
            margin: 100px auto;
            background-color: white;
            padding: 20px;
            width: 50%;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #27ae60;
        }

        p {
            font-size: 1.2em;
        }

        .loading {
            margin-top: 20px;
            font-size: 1.1em;
            color: #34495e;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Redirecting to Esewa...</h1>
        <p>Please wait while we process your payment.</p>
        <p>Total Amount: <strong>Rs <?php echo number_format($total_amount, 2); ?></strong></p>
        <p>Order ID: <strong><?php echo $order_id; ?></strong></p>
        <p class="loading">Loading Esewa payment page...</p>
    </div>

    <!-- Form to automatically submit to Esewa -->
    <form id="esewa_form" action="<?php echo $esewa_payment_url; ?>" method="POST">
        <input type="hidden" name="amt" value="<?php echo $params['amt']; ?>">
        <input type="hidden" name="pdc" value="<?php echo $params['pdc']; ?>">
        <input type="hidden" name="psc" value="<?php echo $params['psc']; ?>">
        <input type="hidden" name="txAmt" value="<?php echo $params['txAmt']; ?>">
        <input type="hidden" name="tAmt" value="<?php echo $params['tAmt']; ?>">
        <input type="hidden" name="pid" value="<?php echo $params['pid']; ?>">
        <input type="hidden" name="scd" value="<?php echo $params['scd']; ?>">
        <input type="hidden" name="su" value="<?php echo $params['su']; ?>">
        <input type="hidden" name="fu" value="<?php echo $params['fu']; ?>">
    </form>

    <script>
        // Automatically submit the form to Esewa
        document.getElementById('esewa_form').submit();
    </script>
</body>
</html>
