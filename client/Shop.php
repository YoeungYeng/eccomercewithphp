<?php
require_once "include/connection.php";
$p = isset($_GET['p']) ? $_GET['p'] : '';
// Fetch search query from user input
$searchQuery = isset($_GET['txt-search']) ? trim($_GET['txt-search']) : "";

// Base SQL query
$sql = "SELECT * FROM `products`";
$params = [];

// Modify query if search input exists
if (!empty($searchQuery)) {
    $sql .= " WHERE `category_name` LIKE ? OR `product_name` LIKE ?";
    $params[] = "%$searchQuery%";
    $params[] = "%$searchQuery%";
}
$sql .= " ORDER BY `product_name` ASC"; // Ensuring consistent ordering

// Prepare and execute query
$stmt = $conn->prepare($sql);
if (!empty($searchQuery)) {
    $stmt->bind_param("ss", ...$params);
}
$stmt->execute();
$result = $stmt->get_result();

// Store fetched products
$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

// Fetch unique categories for sidebar
$categoryQuery = "SELECT DISTINCT category_name FROM products ORDER BY category_name ASC";
$categoryResult = $conn->query($categoryQuery);
$categories = [];
if ($categoryResult->num_rows > 0) {
    while ($category = $categoryResult->fetch_assoc()) {
        $categories[] = $category['category_name'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php require "include/head.php"; ?>

<body>
    <?php require "include/icons.php"; ?>
    <?php require "include/cart.php"; ?>
    <?php require "include/navbar.php"; ?>

    <div class="container mt-4">
        <div class="row">
            <!-- Sidebar -->
            <aside class="col-md-3">
                <form method="GET" action="shop.php">
                    <input type="search" class="form-control" placeholder="Search by name or category..."
                        name="txt-search" id="txt-search" value="<?= htmlspecialchars($searchQuery); ?>">
                    <button type="submit" class="btn btn-primary w-100 mt-2">Search</button>
                </form>

                <h5 class="mt-4">Product Categories</h5>
                <div class="text-success">
                    <hr>
                </div>
                <ul class="list-group">
                    <?php foreach ($categories as $category): ?>
                        <li class="list-group-item">
                            <a href="shop.php?txt-search=<?= urlencode($category); ?>">
                                <?= htmlspecialchars($category); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </aside>

            <!-- Product Listing -->
            <main class="col-md-9">
                <div class="row">
                    <?php if (count($products) > 0): ?>
                        <?php foreach ($products as $row): ?>
                            <?php $img = "../admin/action/" . htmlspecialchars($row['image']); ?>
                            <div class="col-md-4">
                                <form  method="POST">
                                    <div class="card mb-3">
                                        <a href="detail-page.php?id=<?= htmlspecialchars($row['product_id']); ?>">
                                            <img src="<?= htmlspecialchars($img); ?>" class="card-img-top"
                                                style="height: 250px; object-fit: contain; padding: 12px 16px" alt="Product">
                                        </a>
                                        <div class="card-body">
                                            <h5 class="card-title"><?= htmlspecialchars($row['product_name']); ?></h5>
                                            <p class="text-muted">$<?= htmlspecialchars($row['prices']); ?></p>

                                            <input type="hidden" name="product_id"
                                                value="<?= htmlspecialchars($row['product_id']); ?>">
                                            <input type="hidden" name="product_image" value="<?= htmlspecialchars($img); ?>">
                                            <input type="hidden" name="product_title"
                                                value="<?= htmlspecialchars($row['product_name']); ?>">
                                            <input type="hidden" name="product_price"
                                                value="<?= htmlspecialchars($row['prices']); ?>">

                                            <button class="btn btn-primary w-100" type="submit" name="add_cart"
                                                style="border-radius: 5px 7px;">
                                                Add to cart
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-danger">No results found.</p>
                    <?php endif; ?>
                </div>
            </main>
        </div>
    </div>

    <?php require "include/footer.php"; ?>
</body>

<?php require "include/foot.php"; ?>
<script>
    $(document).on("click", ".add-to-cart", function (e) {
        e.preventDefault();

        let productData = {
            add_cart: true,
            product_title: $(this).data("name"),
            product_price: $(this).data("price"),
            product_image: $(this).data("image")
        };

        $.ajax({
            url: "action/add_to_cart.php",
            type: "POST",
            data: productData,
            dataType: "json",
            success: function (response) {
                alert(response.message);
                if (response.success) {
                    fetchCart(); // Refresh cart without reloading
                }
            },
            error: function () {
                alert("Something went wrong. Please try again.");
            }
        });
    });

</script>
</html>
