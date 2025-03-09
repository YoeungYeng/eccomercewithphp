<?php


session_start();
include("config.php");

// 
if (isset($_POST["txt-email"]) && isset($_POST["txt-password"])) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}


$email = validate($_POST["txt-email"]);
$pass = validate($_POST["txt-password"]);
// 
if(empty($email)){
    header("Location: index.php?error=Email is required");
    exit();
}else if(empty($pass)){
    header("Location: index.php?error=Password is required");
    exit();
}

// select
$sql = "SELECT * FROM user  WHERE email='$email' AND password='$pass' ";
$result = mysqli_query($conn, $sql);

// check 
if(mysqli_num_rows($result) === 1 ){
    $row = mysqli_fetch_assoc($result);
    if($row['email'] === $email && $row['password'] === $pass){
        echo "Loged in!";
        $_SESSION["email"] = $row["email"];
        $_SESSION["password"] = $row["password"];
        $_SESSION["id"] = $row["id"];
        header("Location: index.php");
        exit();
    }else{

        header("Location: login.php?error=Incorect email or password");
        exit();
    }
}else{
    header("Location: login.php");
    exit();
}
