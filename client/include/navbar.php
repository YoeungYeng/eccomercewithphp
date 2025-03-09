
<nav class="navbar navbar-expand-lg bg-light text-uppercase fs-6 p-3 border-bottom align-items-center">
    <div class="container-fluid">
      <div class="row justify-content-between align-items-center w-100">

        <div class="col-auto">
          <a class="navbar-brand text-white" href="index.html">
           <img src="images/elogo.png" alt="" style="height: 80px; object-fit: cover;">
          </a>
        </div>

        <div class="col-auto">
          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
            aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
              <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
            </div>

            <div class="offcanvas-body">
              <ul class="navbar-nav justify-content-end flex-grow-1 gap-1 gap-md-5 pe-3">
                <li class="nav-item">
                  <a class="nav-link " href="index.php" <?php echo ($p == "home") ? "style='color: red'" : ""; ?> id="" data-bs-toggle=""
                    aria-haspopup="true" aria-expanded="false">Home</a>
                 
                </li>
                <li class="nav-item ">
                  <a class="nav-link " href="index.php?p=shop" <?php echo ($p == "shop") ? "style='color: red'" : ""; ?> id="" data-bs-toggle=""
                    aria-haspopup="true">Shop</a>
                 
                </li>
               
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="index.php?p=pages" <?php $p== "pages" ? "style='color: red'" : "" ?> id="dropdownPages" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">Pages</a>
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
                      <a href="#" class="dropdown-item item-anchor">Coming Soon </a>
                    </li>
                    
                  </ul>
                </li>
                <li class="nav-item" >
                  <a class="nav-link" href="index.php?p=blog" <?php echo ($p == "blog") ? "style='color: red'" : ""; ?> > Blog</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="index.php?p=contact" <?php echo ($p == "contact") ? "style='color: red'" : ""; ?> >Contact</a>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <!-- select from database -->
         <?php 
           $selectCart = "SELECT * FROM carts";
           $row = mysqli_query($conn, $selectCart);
           $count = mysqli_num_rows($row);
         ?>
        <div class="col-3 col-lg-auto">
          <ul class="list-unstyled d-flex m-0">
            <li class="d-none d-lg-block">
              <a href="index.html" class="text-uppercase mx-3">Wishlist <span class="wishlist-count">(0)</span>
              </a>
            </li>
            <li class="d-none d-lg-block">
              <a href="index.html" class="text-uppercase mx-3" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart"
                aria-controls="offcanvasCart">Cart <span class="cart-count"><?=$count; ?></span>
              </a>
            </li>
            <li class="d-lg-none">
              <a href="#" class="mx-2">
                <svg width="24" height="24" viewBox="0 0 24 24">
                  <use xlink:href="#heart"></use>
                </svg>
              </a>
            </li>
            <li class="d-lg-none">
              <a href="#" class="mx-2" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart"
                aria-controls="offcanvasCart">
                <svg width="24" height="24" viewBox="0 0 24 24">
                  <use xlink:href="#cart"></use>
                </svg>
              </a>
            </li>
            <li class="search-box" class="mx-2">
              <a href="#search" class="search-button">
                <svg width="24" height="24" viewBox="0 0 24 24">
                  <use xlink:href="#search"></use>
                </svg>
              </a>
            </li>
          </ul>
        </div>

      </div>

    </div>
</nav>