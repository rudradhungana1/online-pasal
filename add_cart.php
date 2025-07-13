<?php
session_start();

// Check if the cart session exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Get product details from the form
$product_id = $_POST['product_id'];
$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];

// Get product image from the database (fetch from your products table)
require_once('db_config.php');
$stmt = $conn->prepare("SELECT image_path FROM products WHERE id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$stmt->bind_result($product_image);
$stmt->fetch();
$stmt->close();

// Add product to cart (if it's not already added)
$exists = false;
foreach ($_SESSION['cart'] as &$item) {
    if ($item['id'] == $product_id) {
        $item['quantity']++;
        $exists = true;
        break;
    }
}

if (!$exists) {
    $_SESSION['cart'][] = [
        'id' => $product_id,
        'name' => $product_name,
        'price' => $product_price,
        'quantity' => 1,
        'image' => 'uploads/' . $product_image, // Add image path with the 'uploads/' folder
    ];
}

// Redirect to the cart page
header('Location: cart.php');
exit;
?>
