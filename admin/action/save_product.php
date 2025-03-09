<?php
// call connection
require_once "../config.php";
// Ensure "uploads" directory exists
if (!is_dir('products')) {
    mkdir('products', 0777, true);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $image = $_FILES['image'];
    $productName = $_POST['product-name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $category = $_POST['category'];
    // Generate unique filename
    $imagePath = 'products/' . time() . '_' . basename($image['name']);
    move_uploaded_file($image['tmp_name'], $imagePath);
    // Save to database
    $stmt = $conn->prepare("INSERT INTO products (category_name, product_name, prices, qualities, descriptions, image) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$category, $productName, $price, $stock , $description,  $imagePath]);
    echo "Slide uploaded successfully!";
   // Redirect to index.php
   header("Location: ../index.php?p=product");
    exit();
}


?>