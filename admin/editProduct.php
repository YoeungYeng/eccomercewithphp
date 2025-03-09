<?php
// Call connection
$p = $_GET['p'] ?? ''; // Avoid undefined index error
require_once "config.php";
?>

<?php require_once "include/head.php"; ?>

<!-- Bootstrap container -->
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar (Fixed & Scrollable) -->
        <nav class="col-md-3 col-lg-2 d-md-block sidebar vh-100 position-fixed">
            <div class="position-sticky pt-3">
                <?php require_once "include/sidebarLeft.php"; ?>
            </div>
        </nav>

        <!-- Main Content (Scrollable) -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <?php require_once "include/Header.php"; ?>
            
            <div class="content pt-4">
                <?php require_once "include/edit_product.php"; ?>
            </div>

            <?php require_once "include/Footer.php"; ?>
        </main>
    </div>
</div>

<?php require_once "include/foot.php"; ?>
