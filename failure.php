
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Failed!</title>
    <link rel="stylesheet" href="success.css">
</head>
<body>
<?php include 'header2.php'; ?>
    <div class="success-box">
        <h1>Payment Failed!</h1>
        <p>Unfortunately, your payment could not be completed. Please try again.</p>
        <a href="newarrival.php" class="btn">Continue Shopping</a>
    </div>
</body>
</html>
