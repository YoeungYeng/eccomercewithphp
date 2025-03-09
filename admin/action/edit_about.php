<?php
// Enable error reporting for debugging
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Call connection
require_once "../config.php";

// Ensure "uploads" directory exists
if (!is_dir('aboutImage')) {
    mkdir('aboutImage', 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate received data
    $id = isset($_POST['about_id']) ? intval($_POST['about_id']) : 0;
    $nameTeam = trim($_POST['txt-nameTeam']);
    $des = trim($_POST['description']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['number']);

    if ($id <= 0) {
        die("Invalid about_id.");
    }

    // Check if a new image is uploaded
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image'];
        $imagePath = 'aboutImage/' . time() . '_' . basename($image['name']);

        // Validate file upload
        if (move_uploaded_file($image['tmp_name'], $imagePath)) {
            // Update database with new image
            $stmt = $conn->prepare("UPDATE tbl_about SET team_name = ?, description = ?, email = ?, phone = ?, image = ? WHERE about_id = ?");
            $stmt->bind_param("sssssi", $nameTeam, $des, $email, $phone, $imagePath, $id);
        } else {
            die("Failed to upload image.");
        }
    } else {
        // Update database without changing the image
        $stmt = $conn->prepare("UPDATE tbl_about SET team_name = ?, description = ?, email = ?, phone = ? WHERE about_id = ?");
        $stmt->bind_param("ssssi", $nameTeam, $des, $email, $phone, $id);
    }

    // Execute statement
    if ($stmt->execute()) {
        header("Location: ../index.php?p=about");
        exit();
    } else {
        die("Error updating record: " . $stmt->error);
    }

    // Close connections
    
  
}
?>
