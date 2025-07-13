<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <link rel="stylesheet" href="success.css">
</head>
<body>
<?php include 'header2.php'; ?>
    <div class="success-box">
        <h1>Payment Successful!</h1>
        <p>Thank you for your payment. Your order has been confirmed.</p>
        <a href="newarrival.php" class="btn">Continue Shopping</a>
    </div>
</body>
</html>
