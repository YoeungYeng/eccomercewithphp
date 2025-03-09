
<?php 
    $page = "home.php";
    $p ='home';
    // check p have or not
    if(isset($_GET['p'])){
        $p = $_GET['p'];
        // switch
        switch($p){
            case "shop": $page = "Shop.php";
                break;
            case "blog": $page = "Bloge.php";
                break;
            case 'contact' : $page = "Contact.php";
                break;
            case 'checkout' : $page = "shopCart.php";
                break;
            case 'about' : $page = "about.php";
                break;
        }
    }
?>
<!-- main -->
<!DOCTYPE html>
<html lang="en">
<?php require "./include/head.php"; ?>
<body>
    <main>
        <?php  require "$page"; ?>
    </main>
</body>
<?php 
    require_once "./include/foot.php";
?>
</html>