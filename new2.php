<?php
// Start session and connect to the database
session_start();
require_once('db_config.php');

// Fetch products from the database
$query = "SELECT * FROM products ORDER BY created_at DESC LIMIT 4";
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
.section-p1 {
    padding: 40px 20px;
    text-align: center;
    background-color: #ffffff;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    margin: 20px;
    border-radius: 10px;
}

.section-p1 h2 {
    font-size: 2.5rem;
    color: #ff6f61;
    margin-bottom: 10px;
}

.section-p1 p {
    font-size: 1rem;
    color: #666;
    margin-bottom: 20px;
}
        .header {
            background-color: #34495e;
            color: white;
            text-align: center;
            padding: 20px;
            font-size: 1em;
        }

        .header a {
            background-color: #34495e;
            color: white;
            padding: 15px 20px;
            text-align: center;
            font-size: 1em;
            text-decoration: none;
            border-radius: 5px;
        }

        .header a:hover {
            background-color: #2c3e50;
        }

        .product-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin: 20px;
        }

        .product-card {
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.31);
            overflow: hidden;
            text-align: center;
            padding: 20px;
            transition: transform 0.2s ease-in-out;
        }

        .product-card:hover {
            transform: scale(1.05);
        }

        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .product-card h3 {
            font-size: 1em;
            color: #333;
        }

        .product-card p {
            color: #777;
            font-size: 1.1em;
        }

        .product-card .price {
            font-size: 1.2em;
            color: #2ecc71;
            margin: 15px 0;
        }

        .product-card .actions {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .product-card .actions button {
            padding: 10px 20px;
            font-size: 1em;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .product-card .actions .cart-btn {
            background-color: #27ae60;
        }

        .product-card .actions .cart-btn:hover {
            background-color: #2ecc71;
        }
    </style>
</head>
<body>
<section id="products1" class="section-p1">
   <h2>New Arrivals</h2>
        <p>Summer Colection New Morden Design</p>
    <div class="product-container">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="product-card">
                    <img src="<?php echo htmlspecialchars($row['image_path']); ?>" alt="Product Image">
                    <h><?php echo htmlspecialchars($row['name']); ?></h>
                    <p><?php echo nl2br(htmlspecialchars($row['description'])); ?></p>
                    <div class="price">Rs <?php echo number_format($row['price'], 2); ?></div>
                    <div class="actions">
                        <form action="add_cart.php" method="POST">
                            <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                            <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($row['name']); ?>">
                            <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
                            <button type="submit" class="cart-btn">Add to Cart</button>
                        </form>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p style="text-align: center; font-size: 1.2em; color: #777;">No products found in the database.</p>
        <?php endif; ?>
    </div>
    </section>
    <?php $conn->close(); ?>
</body>
</html>
