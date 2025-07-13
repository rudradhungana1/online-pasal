<?php
session_start();
require_once('db_config.php');

// Fetch existing product details
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $product = $stmt->get_result()->fetch_assoc();
    $stmt->close();
}

// Handle update form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Update database
    $stmt = $conn->prepare("UPDATE products SET name=?, price=?, description=? WHERE id=?");
    $stmt->bind_param("sdsi", $name, $price, $description, $product_id);

    if ($stmt->execute()) {
        header("Location: showproducts.php");
        exit;
    } else {
        echo "Error updating product: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link rel="stylesheet" href="css/update.css">
</head>
<body>
     <!-- HEADER -->
     <?php include 'header2.php'; ?>
    <h2>Update Product</h2>
    <div>
    <form class= "updatebox" method="POST">
        <label>Product Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required><br>

        <label>Price (Rs):</label>
        <input type="number" name="price" value="<?php echo $product['price']; ?>" required><br>

        <label>Description:</label>
        <textarea name="description" required><?php echo htmlspecialchars($product['description']); ?></textarea><br>

        <button type="submit">Update</button>
    </form>
</div>
</body>
</html>
