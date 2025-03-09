<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['email'])) {

  ?>
  <!DOCTYPE html>
  <html lang="en">
  <?php require "include/head.php"; ?>
  <body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
      data-sidebar-position="fixed" data-header-position="fixed">
      <!-- sider bar -->
      <?php require_once("include/sidebarLeft.php") ?>
      <!--  Main wrapper -->
      <?php include("include/Header.php") ?>
      <div class="body-wrapper">
        <!--  Header Start -->
        
        <!--  Header End -->
        <div class="container-fluid">
          <!-- rows -->
          <?php include("include/Rows.php") ?>
          <?php include("include/Footer.php") ?>
        </div>
      </div>
    </div>
  </body>
  <!-- script -->
  <?php require "include/foot.php"; ?>
  </html>

  <?php
} else {
  header("Location: login.php");
  exit();
}

?>