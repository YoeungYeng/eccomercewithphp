<?php
require_once "include/head.php";
require_once "include/connection.php";

// Fetch about section data
$selectAbout = "SELECT * FROM `tbl_about` LIMIT 1";
$result = $conn->query($selectAbout);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $title = $row['title'];
    $subTitle = $row['subTitle'];
    $des = $row['description'];
} else {
    die("No data found.");
}
?>

<!-- Navbar -->
<?php require_once "include/navbar.php"; ?>

<!-- About Section -->
<div class="container text-center py-5">
    <h1 class="fw-bold"><?= $title ?></h1>
    <p class="lead"><?= $subTitle ?></p>
</div>

<!-- Team Section -->
<div class="container">
    <h2 class="text-center my-4">Our Team</h2>
    <div class="row">
        <?php
        $selectTeam = "SELECT * FROM `tbl_about`";
        $result = $conn->query($selectTeam);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $img = "../admin/action/" . htmlspecialchars($row['image']);
        ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <img src="<?= $img ?>" class="" style="width: 100%; object-fit: cover; height: 250px; padding: 14px 16px;" alt="<?= htmlspecialchars($row['team_name']) ?>">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?= htmlspecialchars($row['team_name']) ?></h5>
                            <p class="text-muted"><?= htmlspecialchars($row['position']) ?></p>
                            <p><?= htmlspecialchars($row['description']) ?></p>
                            <p class="text-primary"><?= htmlspecialchars($row['email']) ?></p>
                            <a href="mailto:<?= htmlspecialchars($row['email']) ?>" class="btn btn-primary">Contact</a>
                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>
</div>

<!-- Call to Action -->
<section class="bg-light py-5 text-center">
    <div class="container">
        <h2>Want to Work with Us?</h2>
        <p>We are always looking for passionate individuals to join our team.</p>
        <a href="contact.html" class="btn btn-primary">Get in Touch</a>
    </div>
</section>

<!-- Footer -->
<?php require_once "include/footer.php"; ?>
<!-- Scripts -->
<?php require_once "include/foot.php"; ?>
