<?php
// Include database connection
require_once "../include/connection.php";

header('Content-Type: application/json'); // Set response type to JSON

$response = ["success" => false, "message" => ""];

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['add_cart'])) {
    $productName = trim($_POST['product_title']);
    $productPrice = floatval($_POST['product_price']);
    $productImage = trim($_POST['product_image']);
    $quantity = 1;

    // Check if the product is already in the cart
    $selectCart = "SELECT * FROM carts WHERE name = ?";
    $stmt = $conn->prepare($selectCart);
    $stmt->bind_param("s", $productName);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Update quantity if the product exists
        $update = "UPDATE carts SET quality = quality + 1 WHERE name = ?";
        $stmt = $conn->prepare($update);
        $stmt->bind_param("s", $productName);

        if ($stmt->execute()) {
            $response["success"] = true;
            $response["message"] = "Product quantity updated in cart.";
        } else {
            $response["message"] = "Error updating product: " . $conn->error;
        }
    } else {
        // Insert new product
        $insert = "INSERT INTO carts (name, price, image, quality) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insert);
        $stmt->bind_param("sdsi", $productName, $productPrice, $productImage, $quantity);

        if ($stmt->execute()) {
            $response["success"] = true;
            $response["message"] = "Product added to cart.";
        } else {
            $response["message"] = "Error adding product: " . $conn->error;
        }
    }

    $stmt->close();
} else {
    $response["message"] = "Invalid request.";
}

echo json_encode($response);
exit();
?>