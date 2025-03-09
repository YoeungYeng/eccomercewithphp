<?php
// call connection
require_once "../config.php";
// Ensure "uploads" directory exists
if (!is_dir('newArrival')) {
    mkdir('newArrival', 0777, true);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $image = $_FILES['image'];
    $title = $_POST['txt-title'];
    $price = $_POST['txt-price'];
   
    // Generate unique filename
    $imagePath = 'newArrival/' . time() . '_' . basename($image['name']);
    move_uploaded_file($image['tmp_name'], $imagePath);
    // Save to database
    $stmt = $conn->prepare("INSERT INTO tbl_newarival (title, price, image) VALUES (?, ?, ?)");
    $stmt->execute([$title, $price, $imagePath]);
    echo "Slide uploaded successfully!";
   // Redirect to index.php
   header("Location: ../index.php?p=newArrial");
    exit();
}


?>