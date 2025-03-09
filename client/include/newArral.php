<?php
require_once "connection.php";

$select = "SELECT * FROM tbl_newarival";
$result = $conn->query($select);

// Check if query execution failed
if (!$result) {
    die("Database query failed: " . $conn->error);
}
?>

<section id="new-arrival" class="new-arrival product-carousel py-5 position-relative overflow-hidden">
  <div class="container">
    <div class="d-flex flex-wrap justify-content-between align-items-center mt-5 mb-3">
      <h4 class="text-uppercase">Our New Arrivals</h4>
      <a href="index.php?p=shop" class="btn-link">View All Products</a>
    </div>
    <div class="swiper product-swiper open-up" data-aos="zoom-out">
      <div class="swiper-wrapper d-flex">
        <?php if ($result->num_rows > 0): ?>
          <?php while ($row = $result->fetch_assoc()): ?>
            <?php
            $im = htmlspecialchars($row['image']);  // Correct way to handle the image URL
            $img = "../admin/action/" . $im;
            ?>
            <div class="swiper-slide">
              <div class="product-item image-zoom-effect link-effect">
                <div class="image-holder position-relative">
                  <a href="index.html">
                    <img src="<?= $img; ?>" alt="Product Image" class="product-image img-fluid">
                  </a>
                  <a href="index.html" class="btn-icon btn-wishlist">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                      <use xlink:href="#heart"></use>
                    </svg>
                  </a>
                  <div class="product-content">
                    <h5 class="element-title text-uppercase fs-5 mt-3">
                      <a href="index.html"><?= htmlspecialchars($row['title']) ?></a>
                    </h5>
                    <a href="#" class="text-decoration-none" data-after="Add to cart">
                      <span><?= htmlspecialchars($row['price']) ?></span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
        <?php else: ?>
          <p>No new arrivals available.</p>
        <?php endif; ?>
      </div>
      <div class="swiper-pagination"></div>
    </div>
    <div class="icon-arrow icon-arrow-left">
      <svg width="50" height="50" viewBox="0 0 24 24">
        <use xlink:href="#arrow-left"></use>
      </svg>
    </div>
    <div class="icon-arrow icon-arrow-right">
      <svg width="50" height="50" viewBox="0 0 24 24">
        <use xlink:href="#arrow-right"></use>
      </svg>
    </div>
  </div>
</section>
