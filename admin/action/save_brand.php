<?php
// echo "Heelo World";
// call connection
require_once "../config.php";

// if folder desn't exist 
if (!is_dir("brand")) {
    mkdir('brand', 0777, true);
}
// check 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $brand_name = $_POST['txt-name'];

    $des = $_POST['txt-des'];
    $status = $_POST['txt-status'];
    $image = $_FILES['image'];

    $imagePath = 'brand/' . time() . '_' . basename($image['name']);
    move_uploaded_file($image['tmp_name'], $imagePath);
    // insert to database
    $insert_brand = $conn->prepare("INSERT INTO tbl_brand(brand_name, image, des, status) VALUES(?, ?, ?, ?)");
    $insert_brand->execute([$brand_name, $imagePath, $des, $status]);
    echo "Brand uploaded successfully!";
    header("Location: ../index.php?p=brand");
} else {
    echo "Error server";
}
?>