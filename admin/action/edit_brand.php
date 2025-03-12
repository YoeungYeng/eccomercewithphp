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
    $id = $_POST['id'];
    $brand_name = $_POST['txt-name'];

    $des = $_POST['txt-des'];
    $status = $_POST['txt-status'];
    $image = $_FILES['image'];


    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image'];
        $imagePath = 'brand/' . time() . '_' . basename($image['name']);

        if (move_uploaded_file($image['tmp_name'], $imagePath)) {
            // Update database with new image
            $stmt = $conn->prepare("UPDATE tbl_brand SET brand_name = ?, image = ?, des = ?, status = ? WHERE brand_id = ?");
            $stmt->bind_param("ssisi", $brand_name, $imagePath, $des, $status, $id);
            echo "Product updated successfully.";
            header("Location: ../index.php?p=brand");
        } else {
            echo "Failed to upload image.";
            exit();
        }
    } else {
        $stmt = $conn->prepare("UPDATE tbl_brand SET brand_name = ?, des = ?, status = ? WHERE brand_id = ?");
        $stmt->bind_param("ssisi", $brand_name, $des, $status, $id);
        echo "Product updated successfully.";
        header("Location: ../index.php?p=brand");
    }

    if($stmt->execute()){
        echo "update succefully";
        header("Location: ../index.php?p=brand");
    }else{
        echo "error update";
        header("Location: ../index.php?p=brand");
    }

    // echo "Brand uploaded successfully!";
    
    // header("Location: ../index.php?p=brand");
} else {
    echo "Error server";
}
?>