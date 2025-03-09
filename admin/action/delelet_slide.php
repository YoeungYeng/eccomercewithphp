<?php 

    echo "Hello World❤️❤️❤️";
    // call connection
    require_once "../config.php";
    $delete_id = $_GET['p'];
    $delete = "DELETE FROM slides WHERE id = '$delete_id'";
    $result = $conn->query($delete);
    if ($result) {
        header("Location: ../index.php?p=slider");
    } else {
        echo "Error deleting record: " . $conn->error;
    }

?>