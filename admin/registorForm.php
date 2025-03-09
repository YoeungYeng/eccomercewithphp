<?php
    require_once("config.php");


    if (isset($_POST)) {
        
        $username = $_POST['txt-user-name'];
        
        $email = $_POST['txt-email'];
        $phone = $_POST["txt-phone"];
        $password = $_POST['txt-password'];
        
        $sql = "INSERT INTO user(email, phone, password, username) VALUES(?,?,?,?)";
        $strmInsert = $conn->prepare($sql);
        $result = $strmInsert->execute([$email, $phone, $password, $username]);
        // check if user save or not 
        if($result){
            echo "Succesfully Saved";
            header("index.php");
        }else{
            echo "error saving data";
            header("registor.php");
        }
        // show result
        echo  " " . $email . " " . $phone . $password . " ". $username;
    }
