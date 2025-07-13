
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Add Products</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/add.css">
</head>
<body>
    <!-- HEADER -->
    <?php include 'header2.php'; ?>
    <div class="admin-header">New Arrivals
    <a href="showproducts.php">View Products </a>
    </div>
    <div class="form-container">
        <h2>Add New Product</h2>
        <form id="productForm" action="adminhandle.php" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" placeholder="Enter product name" required>
    </div>
    <div class="form-group">
        <label for="price">Product Price (Rs):</label>
        <input type="number" id="price" name="price" placeholder="Enter product price" required>
    </div>
    <div class="form-group">
        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="3" placeholder="Enter product description" required></textarea>
    </div>
    <div class="form-group">
        <label for="image">Product Image:</label>
        <input type="file" id="image" name="image" accept="image/*" required>
    </div>
    <button type="submit">Add Product</button>
</form>
    </div>


    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('productForm');

        form.addEventListener('submit', function (e) {
            // Allow form to submit normally to the server
            console.log('Submitting product form...');
        });
    });
</script>
</body>
</html>
