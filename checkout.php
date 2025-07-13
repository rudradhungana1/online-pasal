<?php
session_start();

// Check if the cart is empty
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) === 0) {
    header('Location: cart.php');
    exit();
}

// Capture shipping details and handle checkout
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $address = $_POST['address'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $email = $_POST['email'] ?? '';
    $payment_method = $_POST['payment_method'] ?? '';

    // Save order details to session temporarily
    $_SESSION['order_details'] = [
        'name' => $name,
        'address' => $address,
        'phone' => $phone,
        'email' => $email,
        'total' => calculate_total($_SESSION['cart']),
        'payment_method' => $payment_method
    ];

    if ($payment_method === 'esewa') {
        header('Location: esewa_payment.php');
        exit();
    } elseif ($payment_method === 'khalti') {
        // Khalti payments handled via JS SDK
        header('Location: khalti_payment.php');
        exit();
    } else {
        header('Location: order_confirmation.php');
        exit();
    }
}

function calculate_total($cart) {
    $total = 0;
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }
    return $total;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="css/checkout.css">
</head>
<body>
    <?php include 'header2.php'; ?>
    <div class="header">Checkout</div>

    <div class="checkout-container">
        <h3>Shipping Information</h3>
        <form action="checkout.php" method="post">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="text" name="address" placeholder="Shipping Address" required>
            <input type="text" name="phone" placeholder="Phone Number" required>
            <input type="email" name="email" placeholder="Email Address" required>

            <h3>Payment Method</h3>
            <div class="payment-options">
                <label>
                    <input type="radio" name="payment_method" value="esewa" required> Pay with Esewa
                </label>
                <label>
                    <input type="radio" name="payment_method" value="khalti" required> Pay with Khalti
                </label>
            </div>

            <button type="submit">Proceed to Payment</button>
        </form>

        <div class="cart-summary">
            <h3>Your Cart</h3>
            <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    foreach ($_SESSION['cart'] as $item):
                        $total += $item['price'] * $item['quantity'];
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['name']); ?></td>
                        <td>Rs <?php echo number_format($item['price'], 2); ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td>Rs <?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="total">
                <strong>Total: Rs <?php echo number_format($total, 2); ?></strong>
            </div>
        </div>
    </div>
</body>
</html>
