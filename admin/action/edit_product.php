<?php
    // Call connection
    require_once "../config.php";

    // Ensure "uploads" directory exists
    if (!is_dir('uploads')) {
        mkdir('uploads', 0777, true);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['product_id']; // Get product ID for updating
        $category = $_POST['category'];
        $productName = $_POST['product-name']; // Ensure form name matches this
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $des = $_POST['description'];

        // Check if a new image is uploaded
        if (!empty($_FILES['image']['name'])) {
            $image = $_FILES['image'];
            $imagePath = 'uploads/' . time() . '_' . basename($image['name']);

            if (move_uploaded_file($image['tmp_name'], $imagePath)) {
                // Update database with new image
                $stmt = $conn->prepare("UPDATE products SET category_name = ?, product_name = ?, prices = ?, qualities = ?, descriptions = ?, image = ? WHERE product_id = ?");
                $stmt->bind_param("ssdissi", $category, $productName, $price, $stock, $des, $imagePath, $id);
            } else {
                echo "Failed to upload image.";
                exit();
            }
        } else {
            // Update database without changing the image
            $stmt = $conn->prepare("UPDATE products SET category_name = ?, product_name = ?, prices = ?, qualities = ?, descriptions = ? WHERE product_id = ?");
            $stmt->bind_param("ssdisi", $category, $productName, $price, $stock, $des, $id);
        }
        
        if ($stmt->execute()) {
            // Redirect to index.php
            header("Location: ../index.php?p=product");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        
        $stmt->close();
        $conn->close();
    }
?>
