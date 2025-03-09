<?php
// Call connection
require_once "../config.php";

// Ensure "uploads" directory exists
if (!is_dir('uploads')) {
    mkdir('uploads', 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id']; // Get slide ID for updating
    $title = $_POST['title'];
    $description = $_POST['description'];
    
    // Check if a new image is uploaded
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image'];
        $imagePath = 'uploads/' . time() . '_' . basename($image['name']);
        move_uploaded_file($image['tmp_name'], $imagePath);
        
        // Update database with new image
        $stmt = $conn->prepare("UPDATE slides SET image_url = ?, title = ?, description = ? WHERE id = ?");
        $stmt->bind_param("sssi", $imagePath, $title, $description, $id);
    } else {
        // Update database without changing the image
        $stmt = $conn->prepare("UPDATE slides SET title = ?, description = ? WHERE id = ?");
        $stmt->bind_param("ssi", $title, $description, $id);
    }
    
    if ($stmt->execute()) {
        // Redirect to index.php
        header("Location: ../index.php?p=slider");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
}
?>
