<?php 

    // echo "Hello World";
    // call connection
    require_once "../include/connection.php";
    $delete_id = $_GET['id'];
    $delete = "DELETE FROM `carts` WHERE id = '$delete_id'";
    $result = $conn->query($delete);
    if ($result) {
        header("Location: ../index.php?p=checkout");
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

?>