
  <!DOCTYPE html>
  <html lang="en">
  <?php 
  require "include/head.php"; 
  $p = $_GET['p'] ?? ''; // Avoid undefined index error
  ?>
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
          <?php include("include/editnewArrivalForm.php") ?>
        </div>
      </div>
    </div>
  </body>
  <!-- script -->
  <?php require "include/foot.php"; ?>
  </html>

