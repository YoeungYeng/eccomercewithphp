<?php 
    echo "Hello World❤️❤️❤️";
    // call connection
    require_once "../config.php";
    $delete_id = $_GET['id'];
    $delete = "DELETE FROM tbl_newarival WHERE newArrival_id = '$delete_id'";
    $result = $conn->query($delete);
    if ($result) {
        header("Location: ../index.php?p=newArrial");
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
?>