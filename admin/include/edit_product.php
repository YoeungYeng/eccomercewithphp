<?php
// require_once "../config.php";
$id = $_GET['p'];

$select = "SELECT * FROM `products` WHERE product_id = '$id'";
$result = $conn->query($select);
// check connection
if (!$result) {
    die("Query Failed: " . $conn->error);
}

// result
$row = $result->fetch_assoc();
$id_ = $row['product_id'];
$category = $row['category_name'];
$productName = $row['product_name'];
$price = $row['prices'];
$stock = $row['qualities'];
$des = $row['descriptions'];
$im = htmlspecialchars($row['image']);  // Correct way to handle the image URL
$img = "../admin/action/" . $im;


?>
<div class="">
    <!--  Header Start -->

    <!--  Header End -->
    <div class="container">
        <!-- forms -->
        <div class="card">
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <div class="container">
                            <h5 class="card-title fw-semibold">Information about Product</h5>
                            <hr>
                            <h2 class="mb-4 text-center">Add Product</h2>
                            <form action="action/edit_product.php" method="POST" enctype="multipart/form-data">
                                <!-- category name -->
                                <div class="mb-3">
                                    <label for="category" class="form-label">Category</label>
                                    <input type="hidden" name="product_id" value="<?= $id_ ?>">
                                    <input type="text" value="<?= $category ?>" name="category" class="form-control"
                                        id="category">
                                </div>
                                <!-- product name -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">Product Name</label>
                                    <input type="text" value="<?= $productName ?>" class="form-control"
                                        id="product-name" name="product-name">
                                </div>

                                <!-- price -->
                                <div class="mb-3">
                                    <label for="price" class="form-label">Price ($)</label>
                                    <input type="number" value="<?= $price ?>" class="form-control" id="price"
                                        name="price" step="0.01">
                                </div>
                                <!-- stock -->
                                <div class="mb-3">
                                    <label for="stock" class="form-label">Stock</label>
                                    <input type="number" value="<?= $stock ?>" class="form-control" id="stock"
                                        name="stock">
                                </div>

                                <!-- description -->
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description"
                                        rows="3"><?=$des ?></textarea>
                                </div>
                                <!-- image -->
                                <div class="mb-3 no-image">
                                    <input type="file" id="image" name="image"
                                        style="opacity: 0; position: absolute; width: 150px; height: 150px; cursor: pointer;"
                                        class="form-control" accept="image/*" >

                                    <img src="<?= $img ?>" id="imagePreview" alt="image"
                                        style="height: 150px; padding: 12px 16px; border-radius: 12px 17px; object-fit: cover; width: 150px; border: 1px solid #000; cursor: pointer;">
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                    <!-- inforamtion -->

                </div>

                <table class="table shadow ">
                    <h2> Information of Products </h2>
                    <hr class="shadow">
                    <thead>
                        <tr>

                            <th scope="col">Product Name</th>
                            <th scope="col">Categories</th>
                            <th scope="col">Prices</th>
                            <th scope="col">Qualities</th>
                            <th scope="col">Descriptions</th>
                            <th scope="col">image</th>
                            <th scope="col">actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $selected = "SELECT *FROM `products`";
                        $result = $conn->query($selected);
                        if ($result->num_rows > 0) {

                            while ($row = $result->fetch_assoc()) {
                                $im = htmlspecialchars($row['image']);  // Correct way to handle the image URL
                                $img = "../admin/action/" . $im;

                                ?>
                                <tr>
                                    <td> <?php echo htmlspecialchars($row['category_name']) ?> </td>
                                    <td> <?php echo htmlspecialchars($row['product_name']) ?> </td>
                                    <td> <?php echo htmlspecialchars($row['prices']) ?> </td>
                                    <td> <?php echo htmlspecialchars($row['qualities']) ?> </td>
                                    <td> <?php echo htmlspecialchars($row['descriptions']) ?> <br /> </td>
                                    <td> <img src="<?= $img ?>" alt="image" style='width: 40px; height: auto; '>
                                    </td>
                                    <td style="width: 200px; display: flex; gap: 10px;">
                                        <a href="editProduct.php?p=<?php echo $row['product_id']; ?>" class="btn btn-warning">
                                            <span class="glyphicon glyphicon-pencil"></span> Edit</a>
                                        <br>
                                        <a href="action/delete_product.php?id=<?php echo $row['product_id']; ?>"
                                                class="btn btn-danger"> <span class="glyphicon glyphicon-trash"></span>
                                                Delete</a>
                                    </td>
                                </tr>

                                <?php


                            }
                        }
                        ?>

                    </tbody>
                </table>

            </div>
        </div>

    </div>

    <!--  -->

</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const imageInput = document.getElementById("image");
        const imagePreview = document.getElementById("imagePreview");

        // When clicking on the preview, trigger file input
        imagePreview.addEventListener("click", function () {
            imageInput.click();
        });

        // Handle file input change
        imageInput.addEventListener("change", function () {
            const file = imageInput.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    imagePreview.src = e.target.result;
                };

                reader.readAsDataURL(file);
            }
        });
    });
</script>