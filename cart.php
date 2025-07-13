<?php
session_start();

// Check if the cart is set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle removal of item from cart
if (isset($_GET['remove_id'])) {
    $remove_id = intval($_GET['remove_id']); // Sanitize input

    // Loop through the cart and remove the product by ID
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $remove_id) {
            unset($_SESSION['cart'][$key]);
            break;
        }
    }

    // Reindex the array to prevent gaps in indices
    $_SESSION['cart'] = array_values($_SESSION['cart']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: #34495e;
            color: white;
            text-align: center;
            padding: 20px;
            font-size: 2em;
        }

        .cart-container {
            width: 80%;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .cart-container table {
            width: 100%;
            border-collapse: collapse;
        }

        .cart-container th, .cart-container td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        .cart-container img {
            width: 70px;
            height: auto;
            border-radius: 5px;
        }

        .cart-container button {
            background-color: #e74c3c;
            color: white;
            padding: 6px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .cart-container button:hover {
            background-color: #c0392b;
        }

        .total {
            margin-top: 20px;
            font-size: 1.4em;
            text-align: right;
        }

        .checkout-btn {
            padding: 12px 20px;
            background-color: #27ae60;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .checkout-btn:hover {
            background-color: #2ecc71;
        }
    </style>
</head>
<body>
    <!-- HEADER -->
    <?php include 'header2.php'; ?>
    <div class="header">
        Your Shopping Cart
    </div>

    <div class="cart-container">
        <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
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
                            <td>
                                <a href="?remove_id=<?php echo $item['id']; ?>"><button>Remove</button></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="total">
                <strong>Total: Rs <?php echo number_format($total, 2); ?></strong>
            </div>

            <!-- Form to redirect to checkout page -->
            <div style="text-align: right; margin-top: 20px;">
                <form action="checkout.php" method="">
                    <button type="submit" class="checkout-btn">Proceed to Checkout</button>
                </form>
            </div>

        <?php else: ?>
            <p>Your cart is empty!</p>
        <?php endif; ?>
    </div>

</body>
</html>
