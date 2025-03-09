<?php 
    // echo "Hello about❤️❤️❤️";

    // connect to database
    include "../config.php";
    // get id
    $id = $_GET['p'];
    // delete query
    $delete = "DELETE FROM `tbl_about` WHERE `about_id` = '$id'";
    $result = $conn->query($delete);
    if ($result) {
        header("Location: ../index.php?p=about");
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
?>