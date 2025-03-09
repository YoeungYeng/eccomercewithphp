<?php
    // Call connection
    require_once "../config.php";

    // Ensure "newArrival" directory exists
    if (!is_dir('newArrival')) {
        mkdir('newArrival', 0777, true);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['newArrival_id']; // Get product ID for updating
        $image = $_FILES['image'];
        $title = $_POST['txt-title'];
        $price = $_POST['txt-price'];

        // Check if a new image is uploaded
        if (!empty($_FILES['image']['name'])) {
            $image = $_FILES['image'];
            $imagePath = 'newArrival/' . time() . '_' . basename($image['name']);

            if (move_uploaded_file($image['tmp_name'], $imagePath)) {
                // Update database with new image
                $stmt = $conn->prepare("UPDATE tbl_newarival SET title = ?, price = ?, image = ? WHERE newArrival_id = ?");
                $stmt->bind_param("sssi", $title, $price, $imagePath, $id);
                echo "Product updated successfully.";
                header("Location: ../index.php?p=newArrial");
            } else {
                echo "Failed to upload image.";
                exit();
            }
        } else {
            // Update database without changing the image
            $stmt = $conn->prepare("UPDATE products SET tbl_newarival SET title = ?, price = ? WHERE newArrival_id = ?");
            $stmt->bind_param("ssdisi", $title, $price, $id);
        }
        
        if ($stmt->execute()) {
            echo "Product updated successfully.";
            // Redirect to index.php
            // header("Location: ../index.php?p=newArrial");
            exit();
        } else {
            echo "Error: " . $stmt->error;  
            echo "Error: " . $stmt->error;
        }
        
        $stmt->close();
        $conn->close();
    }
?>
