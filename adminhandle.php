<?php
session_start();
require_once('db_config.php'); // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $price = floatval($_POST['price']);
    $description = trim($_POST['description']);
    $image = $_FILES['image'];

    // Check if file upload is successful
    if ($image['error'] === UPLOAD_ERR_OK) {
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        // Unique file name to avoid overwriting
        $imageName = time() . '_' . basename($image["name"]);
        $imagePath = $targetDir . $imageName;

        if (move_uploaded_file($image["tmp_name"], $imagePath)) {
            // Insert into database
            $stmt = $conn->prepare("INSERT INTO products (name, price, description, image_path) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("sdss", $name, $price, $description, $imagePath);

            if ($stmt->execute()) {
                echo "<script>alert('Product added successfully!'); window.location.href = 'admin.php';</script>";
            } else {
                echo "Error inserting into database: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error uploading image.";
        }
    } else {
        echo "File upload error: " . $image['error'];
    }
}

$conn->close();
?>
