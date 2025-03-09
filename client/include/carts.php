<?php
require_once "connection.php";
header('Content-Type: application/json');

if (isset($_POST['action']) && isset($_POST['name'])) {
    $action = $_POST['action'];
    $name = $_POST['name'];

    if ($action == "increase") {
        $updateCart = "UPDATE carts SET quality = quality + 1 WHERE name = ?";
    } elseif ($action == "decrease") {
        // Check current quantity
        $checkCart = "SELECT quality FROM carts WHERE name = ?";
        $stmt = $conn->prepare($checkCart);
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row && $row['quality'] > 1) {
            $updateCart = "UPDATE carts SET quality = quality - 1 WHERE name = ?";
        } else {
            $updateCart = "DELETE FROM carts WHERE name = ?";
        }
    }

    // Execute Update or Delete
    $stmt = $conn->prepare($updateCart);
    $stmt->bind_param("s", $name);
    if ($stmt->execute()) {
        // Fetch updated cart
        $cartData = [];
        $query = "SELECT * FROM carts";
        $result = $conn->query($query);
        
        while ($row = $result->fetch_assoc()) {
            $cartData[] = [
                "name" => $row["name"],
                "quantity" => (int) $row["quality"],
                "price" => (float) $row["price"]
            ];
        }

        echo json_encode(["success" => true, "cart" => $cartData]);
    } else {
        echo json_encode(["success" => false]);
    }
    exit();
}
