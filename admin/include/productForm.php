<?php
require_once "./config.php";
$select = "SELECT * FROM `products`";
$result = $conn->query($select);

?>
<div class="body-wrapper">
    <!--  Header Start -->

    <!--  Header End -->
    <div class="container-fluid">
        <div class="container-fluid">
            <!-- forms -->
            <div class="card">
                <div class="card-body">


                    <div class="card">
                        <div class="card-body">

                            <div class="container mt-5">
                                <h5 class="card-title fw-semibold">Information about Product</h5>
                                <hr>
                                <h2 class="mb-4 text-center">Add Product</h2>
                                <form action="action/save_product.php" method="POST" enctype="multipart/form-data">
                                    <!-- category name -->
                                    <div class="mb-3">
                                        <label for="category" class="form-label">Category</label>
                                        <input type="text" name="category" class="form-control" id="category">
                                    </div>
                                    <!-- product name -->
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Product Name</label>
                                        <input type="text" class="form-control" id="product-name" name="product-name"
                                            required>
                                    </div>

                                    <!-- price -->
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Price ($)</label>
                                        <input type="number" class="form-control" id="price" name="price" step="0.01"
                                            required>
                                    </div>
                                    <!-- stock -->
                                    <div class="mb-3">
                                        <label for="stock" class="form-label">Stock</label>
                                        <input type="number" class="form-control" id="stock" name="stock" required>
                                    </div>

                                    <!-- description -->
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="3"
                                            required></textarea>
                                    </div>
                                    <!-- image -->
                                    <div class="mb-3 no-image" style="padding: 12px 14px; width: 150px; height: 150px; cursor: pointer; border: 1px solid #000; border-radius: 5px 7px; padding: 12px 14px; background: url('assets/images/no-image-icon-23485.png'); background-size: cover;">
                                        <!-- <label for="image" class="form-label">Product Image</label> -->
                                        <input type="file" style="width: 100%; height: 100px; opacity: 0" class="form-control" accept="image/*" id="image" name="image"
                                            accept="image/*" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                        <!-- inforamtion -->

                    </div>

                    <table class="table shadow">
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
                                        <td> <?php echo htmlspecialchars($row['descriptions']) ?> </td>
                                        <td> <img src="<?= $img ?>" alt="image" style='width: 60px; height: auto; '>
                                        </td>
                                        <td>
                                            <a href="editProduct.php?p=<?php echo $row['product_id']; ?>"
                                                class="btn btn-warning">
                                                <span class="glyphicon glyphicon-pencil"></span> Edit</a>
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

    <!--  -->

</div>

<script>
document.getElementById("image").addEventListener("change", function(event) {
    const file = event.target.files[0];

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.querySelector(".no-image").style.backgroundImage = `url('${e.target.result}')`;
        };
        reader.readAsDataURL(file);
    }
});
</script>