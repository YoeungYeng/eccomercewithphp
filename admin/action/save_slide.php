<?php
// call connection
require_once "../config.php";

// Ensure "uploads" directory exists
if (!is_dir('uploads')) {
    mkdir('uploads', 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $image = $_FILES['image'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    // Generate unique filename
    $originalFilename = time() . '_' . basename($image['name']);
    $imagePath = 'uploads/' . $originalFilename;

    // Move uploaded file to the "uploads" directory
    if (!move_uploaded_file($image['tmp_name'], $imagePath)) {
        die("Failed to upload the image.");
    }



    $stmt = $conn->prepare("INSERT INTO slides (image_url, title, description) VALUES (?, ?, ?)");
    $stmt->execute([$imagePath, $title, $description]);


    // Redirect to index.php
    header("Location: ../index.php?p=slider");
    exit();
}
?>