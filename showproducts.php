<?php
// Start session and connect to the database
session_start();
require_once('db_config.php');

// Handle Delete Operation
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']); // Sanitize input

    // Fetch the image path to delete the file
    $stmt = $conn->prepare("SELECT image_path FROM products WHERE id = ?");
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Delete the image file if it exists
        if (file_exists($row['image_path'])) {
            unlink($row['image_path']); 
        }
    }
    $stmt->close();

    // Delete product from database
    $delete_stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $delete_stmt->bind_param("i", $delete_id);

    if ($delete_stmt->execute()) {
        // Redirect back to products page after deletion
        header("Location: showproducts.php");
        exit;
    } else {
        echo "Error deleting product: " . $delete_stmt->error;
    }
    $delete_stmt->close();
}

// Fetch products from the database
$query = "SELECT * FROM products ORDER BY created_at DESC";
$result = $conn->query($query);

if ($result === false) {
    die("Database query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; margin: 0; padding: 0; }
        .header { background-color: #34495e; color: white; text-align: center; padding: 20px; font-size: 1.8em; }
        .header a {background-color: #34495e;color: white;padding: 15px 20px;text-align: center;font-size: 1em;}
        .product-table { width: 90%; margin: 30px auto; border-collapse: collapse; background-color: white; }
        .product-table th, .product-table td { border: 1px solid #ddd; padding: 10px; text-align: center; }
        .product-table th { background-color: #34495e; color: white; }
        .product-table td img { width: 70px; height: auto; border-radius: 5px; }
        .actions button { padding: 5px 10px; margin: 3px; cursor: pointer; border: none; border-radius: 5px; color: white; }
        .delete-btn { background-color: #e74c3c; }
        .delete-btn:hover { background-color: #c0392b; }
        .update-btn { background-color: #3498db; }
        .update-btn:hover { background-color: #2980b9; }
    </style>
</head>
<body>
    <!-- HEADER -->
    <?php include 'header2.php'; ?>
    <div class="header">New Arrivals List
    <a href="admin.php">Add New </a>
    </div>

    <?php if (isset($_GET['success']) && $_GET['success'] === 'deleted'): ?>
        <p style="color: green; text-align: center;">Product successfully deleted!</p>
    <?php endif; ?>

    <?php if ($result->num_rows > 0): ?>
        <table class="product-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Price (Rs)</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $count = 1; ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $count++; ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td>Rs <?php echo number_format($row['price'], 2); ?></td>
                        <td><?php echo nl2br(htmlspecialchars($row['description'])); ?></td>
                        <td><img src="<?php echo htmlspecialchars($row['image_path']); ?>" alt="Product Image"></td>
                        <td class="actions">
                            <a href="?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this product?');">
                                <button class="delete-btn">Delete</button>
                            </a>
                            <a href="update_product.php?id=<?php echo $row['id']; ?>">
                                <button class="update-btn">Update</button>
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p style="text-align: center; font-size: 1.2em; color: #777;">No products found in the database.</p>
    <?php endif; ?>

    <?php $conn->close(); ?>
</body>
</html>
