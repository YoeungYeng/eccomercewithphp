<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
$p = $_GET['p'] ?? ''; // Avoid undefined index error
require_once "../config.php";

if (!is_dir('aboutImage')) {
    mkdir('aboutImage', 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['txt-title'];
    $subTitle = $_POST['txt-subtitle'];
    $nameTeam = $_POST['txt-nameTeam'];
    $des = $_POST['description'];
    $email = $_POST['email'];
    $phone = $_POST['number'];
    $position = $_POST['select-role'];
    $image = $_FILES['image'];

    if ($image['error'] !== UPLOAD_ERR_OK) {
        die("Error uploading file: " . $image['error']);
    }

    $imagePath = "aboutImage/" . time() . "_" . basename($image['name']);
    if (!move_uploaded_file($image['tmp_name'], $imagePath)) {
        die("Failed to move uploaded file.");
    }

    $stmt = $conn->prepare("INSERT INTO tbl_about (title, subTitle, team_name, description, email, phone, image, position) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    
    if ($stmt->execute([$title, $subTitle, $nameTeam, $des, $email, $phone, $imagePath, $position])) {
        header("Location: ../index.php?p=about");
        exit;
    } else {
        die("Database insertion failed.");
    }
} else {
    die("Invalid request.");
}
