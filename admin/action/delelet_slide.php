<?php 

    // echo "Hello World❤️❤️❤️";
    // call connection
    require_once "../config.php";
    $delete_id = $_GET['p'];
    $delete = "DELETE FROM slides WHERE id = '$delete_id'";
    $result = $conn->query($delete);
    if ($result) {
        echo "<script>
            alert('Delete succeeded!');
            window.location.href = '../index.php?p=slider';
        </script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    

?>