<?php

$page = "home.php";
$p = "home";
// check
if (isset($_GET['p'])) {
  $p = $_GET['p'];

  switch ($p) {
    case 'slider':
      $page = "sliderShow.php";
      break;
    case 'brand':
      $page = "brand.php";
      break;
    case "product":
      $page = "proudct.php";
      break;
    case "pages":
      $page = "pages.php";
      break;
    case "about":
      $page = "about.php";
      break;
      case "newArrial":
        $page = "newArrival.php";
        break;
    case 'user':
      $page = "users.php";
      break;
    case 'setting':
      $page = "setting.php";
      break;
  }
}



?>
<!DOCTYPE html>
<html lang="en">

<!-- head -->
<?php require "include/head.php"; ?>

<body>

  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- sider bar -->

    <!--  Main wrapper -->
    <div>
      <!--  Header Start -->
      <?php require "$page"; ?>

    </div>
  </div>
</body>
<!-- script -->


</html>

<?php


?>