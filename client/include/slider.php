<?php
require_once "include/connection.php";
$select = "SELECT * FROM `slides`";
$result = $conn->query($select);

?>
<div class="body-wrapper">
  <section id="billboard" style="background-color: red;" class="bg-light py-5">
    <div class="container">
      <div class="row justify-content-center">
        <!-- <h1 class="section-title text-center mt-4" data-aos="fade-up">New Technology</h1> -->
        <div class="col-md-6 text-center" data-aos="fade-up" data-aos-delay="300">

        </div>
      </div>
      <div class="row">
        <div class="swiper main-swiper py-4" data-aos="fade-up" data-aos-delay="600">
          <div class="swiper-wrapper d-flex border-animation-left">
            <?php
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                $im = htmlspecialchars($row['image_url']);  // Correct way to handle the image URL
                $img = "../admin/action/" . $im;
                ?>
                <div class="swiper-slide">
                  <div class="banner-item image-zoom-effect">
                    <div class="image-holder">
                      <a href="#">
                        <!-- <img src="images/banner-image-6.jpg" alt="product" class="img-fluid"> -->
                        <img src="<?= $img ?>" alt="product" class="img-fluid">
                      </a>
                    </div>
                    <div class="banner-content py-4">
                      <h5 class="element-title text-uppercase">
                        <!-- title -->
                        <a href="index.html" class="item-anchor"> <?= htmlspecialchars($row['title']) ?></a>
                      </h5>
                      <!-- description -->
                      <p>
                        <?= htmlspecialchars($row['description']) ?>
                      </p>
                      <div class="btn-left">
                        <a href="index.php?p=shop" class="btn-link fs-6 text-uppercase item-anchor text-decoration-none"> Show Now </a>
                      </div>
                    </div>
                  </div>
                </div>

                <?php
              }
            }
            ?>

          </div>
          <div class="swiper-pagination"></div>
        </div>
        <div class="icon-arrow icon-arrow-left"><svg width="50" height="50" viewBox="0 0 24 24">
            <use xlink:href="#arrow-left"></use>
          </svg></div>
        <div class="icon-arrow icon-arrow-right"><svg width="50" height="50" viewBox="0 0 24 24">
            <use xlink:href="#arrow-right"></use>
          </svg></div>
      </div>
    </div>
  </section>
</div>