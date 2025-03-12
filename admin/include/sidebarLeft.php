<?php 
  // $p = $_GET['p'];
?>
<!-- Sidebar Start -->
<aside class="left-sidebar">
  <!-- Sidebar scroll-->
  <div>
    <div class="brand-logo d-flex align-items-center justify-content-between">
      <a href="./index.html" class="text-nowrap logo-img">
        <img src="./assets/images/elogo.png" style="margin-top: 20px;" width="90" alt="" />
      </a>
      <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
        <i class="ti ti-x fs-8"></i>
      </div>
    </div>
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
      <ul id="sidebarnav">
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">Home</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="index.php" aria-expanded="false">
            <span>
              <i class="ti ti-layout-dashboard"></i>
            </span>
            <span class="hide-menu">Dashboard</span>
          </a>
        </li>

        <!-- slider show -->
        <li class="sidebar-item">
          <a class="sidebar-link" href="index.php?p=slider" aria-expanded="false" <?php echo ($p == "slider") ? "style='background: #5D87FF; color: #fff'" : ""; ?>>
            <span>
              <i class="ti ti-wallet"></i>
            </span>
            <span class="hide-menu"> slide show </span>
          </a>
        </li>
        <!-- brand -->
        <li class="sidebar-item">
          <a class="sidebar-link" href="index.php?p=brand" aria-expanded="false" <?php echo ($p == "brand") ? "style='background: #5D87FF; color: #fff'" : ""; ?>>
            <span>
              <i class="ti ti-car"></i>
            </span>
            <span class="hide-menu"> Brand </span>
          </a>
        </li>
        <!-- product product.php-->
        <li class="sidebar-item">
          <a class="sidebar-link" href="index.php?p=product" aria-expanded="false" <?php echo ($p == "product") ? "style='background: #5D87FF; color: #fff'" : ""; ?>>
            <span>
              <i class="ti ti-article"></i>
            </span>
            <span class="hide-menu"> Product </span>
          </a>
        </li>

        <!-- pages -->
        
        <li class="nav-item dropdown sidebar-item" style="margin-left: 12px;">
          <a class="nav-link dropdown-toggle ml-2 mb-3" href="index.php?p=pages" <?php $p == "pages" ? "style='color: red'" : "" ?>
            id="dropdownPages" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span>
              <i class="ti ti-folder" style="font-size: 24px;"></i>
            </span>
              Pages
            </a>
          <ul class="dropdown-menu list-unstyled" aria-labelledby="dropdownPages">
            <li>
              <a href="index.php?p=about" class="dropdown-item item-anchor">About </a>
            </li>
            <li>
              <a href="#" class="dropdown-item item-anchor">Cart </a>
            </li>
            <li>
              <a href="index.php?p=checkout" class="dropdown-item item-anchor">Checkout </a>
            </li>
            <li>
              <a href="index.php?p=newArrial" class="dropdown-item item-anchor"> New Arrivals </a>
            </li>

          </ul>
        </li>
        <!-- user -->
        <li class="sidebar-item">
          <a class="sidebar-link" href="index.php?p=user" <?php echo ($p == "user") ? "style='background: #5D87FF; color: #fff'" : ""; ?> aria-expanded="false">
            <span>
              <i class="ti ti-user"></i>
            </span>
            <span class="hide-menu"> Users </span>
          </a>
        </li>
        <!-- setting -->
        <li class="sidebar-item">
          <a class="sidebar-link" href="index.php?p=setting" <?php echo ($p == "setting") ? "style='background: #5D87FF; color: #fff'" : ""; ?> aria-expanded="false">
            <span>
              <i class="ti ti-settings"></i>
              <!-- <i class="fa-duotone fa-solid fa-gear"></i> -->
            </span>
            <span class="hide-menu"> Setting </span>
          </a>
        </li>




        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">AUTH😊</span>
        </li>
        <?php

        ?>
        <li class="sidebar-item">
          <a class="sidebar-link" href="logoutForm.php" aria-expanded="false">
            <span>
              <i class="ti ti-login"></i>
            </span>
            <span class="hide-menu">Logout</span>
          </a>
        </li>
        <?php
        ?>
        


      </ul>

    </nav>
    <!-- End Sidebar navigation -->
  </div>
  <!-- End Sidebar scroll-->
</aside>