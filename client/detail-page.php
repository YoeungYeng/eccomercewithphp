<?php
require_once "include/connection.php";

// Get product ID from URL and validate it
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$p = isset($_GET['p']) ? $_GET['p'] : '';

// Fetch product details for the specific ID
$stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();
?>


<!-- head -->
<?php require_once "include/head.php" ?>
<!-- cart -->
<?php require "include/cart.php"; ?>
<!-- navbar -->
<?php require_once "include/navbar.php"; ?>
<div class="container mt-5">
    <div class="row">
        <!-- Product Image -->
        <div class="col-md-6">
            <?php if ($product): ?>
                <?php $img = "../admin/action/" . htmlspecialchars($product['image']); ?>
                <img src="<?= $img; ?>" class="img-fluid rounded shadow-lg" style="padding: 14px 16px;" alt="Product Image">
            <?php else: ?>
                <p class="text-danger">Product not found.</p>
            <?php endif; ?>
        </div>

        <!-- Product Info -->
        <div class="col-md-6">
            <?php if ($product): ?>
                <h1 class="display-5 fw-bold"><?= htmlspecialchars($product['category_name']); ?></h1>
                <h3 class="text-success fw-bold">$<?= htmlspecialchars($product['prices']); ?></h3>
                <p class="text-muted"><?= nl2br(htmlspecialchars($product['descriptions'])); ?></p>

                <!-- Quantity Selector -->
                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity:</label>
                    <input type="number" id="quantity" class="form-control w-50" value="1" min="1">
                </div>

                <!-- Add to Cart Button -->
                <button class="btn btn-primary btn-lg"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
            <?php endif; ?>
        </div>
    </div>

    <hr>

    <!-- Related Products -->
    <h3 class="mt-5">Related Products</h3>
    <div class="row">
        <?php
        if ($product) {
            // Fetch related products based on the same category (excluding the current product)
            $related_stmt = "SELECT * FROM products";
            $result = $conn->query($related_stmt);

            while ($related = $result->fetch_assoc()):
                ?>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm mb-4">
                        <?php $related_img = "../admin/action/" . htmlspecialchars($related['image']); ?>
                        <img src="<?= $related_img; ?>" class="card-img-top rounded" alt="Product Image">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?= htmlspecialchars($related['category_name']); ?></h5>
                            <p class="text-success fw-bold">$<?= htmlspecialchars($related['prices']); ?></p>
                            <a href="detail-page.php?id=<?= $related['product_id']; ?>" class="btn btn-outline-primary">View
                                Product</a>
                        </div>
                    </div>
                </div>
                <?php
            endwhile;
        } else {
            echo "<p class='text-muted'>No related products found.</p>";
        }
        ?>
    </div>
</div>

<!-- Include Bootstrap 5 & FontAwesome -->

<?php require_once "include/footer.php"; ?>
<!-- foot -->
<?php require_once "include/foot.php"; ?>

<?php
$stmt->close();
$conn->close();
?>