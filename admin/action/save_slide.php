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
    $imagePath = 'uploads/' . time() . '_' . basename($image['name']);
    move_uploaded_file($image['tmp_name'], $imagePath);
    // Save to database
    $stmt = $conn->prepare("INSERT INTO slides (image_url, title, description) VALUES (?, ?, ?)");
    $stmt->execute([$imagePath, $title, $description]);
    // echo "Slide uploaded successfully!";
   // Redirect to index.php
   header("Location: ../index.php?p=slider");
    exit();
}


?>