<?php
session_start();

// Check if order details exist in the session
if (!isset($_SESSION['order_details'])) {
    header('Location: checkout.php');
    exit();
}

// Order details from session
$order_details = $_SESSION['order_details'];
$total_amount = $order_details['total']; // Amount in NPR
$order_id = uniqid(); // Generate a unique order ID for this transaction
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khalti Payment</title>
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
            color: #34495e;
        }

        p {
            font-size: 1.2em;
        }

        button {
            padding: 12px 20px;
            background-color: #6C5CE7;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
        }

        button:hover {
            background-color: #4d3ed9;
        }
    </style>
    <!-- Khalti SDK -->
    <script src="https://khalti.com/static/khalti-checkout.js"></script>
</head>
<body>
    <div class="container">
        <h1>Pay with Khalti</h1>
        <p>Total Amount: <strong>Rs <?php echo number_format($total_amount, 2); ?></strong></p>
        <p>Order ID: <strong><?php echo $order_id; ?></strong></p>
        <button id="khalti-button">Pay Now</button>
    </div>

    <script>
        // Khalti Payment Configuration
        const config = {
            publicKey: "test_public_key_1234567890", // Replace with your Khalti public key
            productIdentity: "<?php echo $order_id; ?>",
            productName: "Shopping Order",
            productUrl: "http://localhost/your_project/checkout.php",
            amount: <?php echo $total_amount * 100; ?>, // Amount in paisa (1 NPR = 100 paisa)

            // Success Handler
            onSuccess(payload) {
                console.log("Payment successful:", payload);

                // Send the payment details to the server for verification
                fetch('khalti_verify.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(payload)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Payment successful! Redirecting...");
                        window.location.href = 'success.php';
                    } else {
                        alert("Payment verification failed.");
                    }
                })
                .catch(error => console.error('Error:', error));
            },

            // Error Handler
            onError(error) {
                console.log("Error during payment:", error);
                alert("Payment failed. Please try again.");
            },

            // Close Handler
            onClose() {
                console.log("Payment widget closed.");
            }
        };

        // Initialize Khalti Checkout
        const checkout = new KhaltiCheckout(config);

        // Attach the Khalti button click event
        document.getElementById("khalti-button").onclick = () => {
            checkout.show({ amount: <?php echo $total_amount * 100; ?> });
        };
    </script>
</body>
</html>
