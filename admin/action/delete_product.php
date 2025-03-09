<?php 
    // echo "Hello World❤️❤️❤️";
    // call connection
    require_once "../config.php";
    $delete_id = $_GET['id'];
    $delete = "DELETE FROM `products` WHERE product_id = '$delete_id'";
    $result = $conn->query($delete);
    if ($result) {
        header("Location: ../index.php?p=product");
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
?>