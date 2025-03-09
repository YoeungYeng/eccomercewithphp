
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Information about Product</h5>
            <hr>
            <div class="card">
                <div class="card-body">
                    <form method="post" action="productForm.php" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label"> Category </label>
                            <input type="hidden" name="id">
                            <input type="text" class="form-control" name="category-name"
                                id="exampleInputEmail1" aria-describedby="emailHelp" required>
                            <div id="emailHelp" class="form-text">Please, Customer entry your category
                                name.</div>
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label"> Product Name </label>
                            <input type="text" class="form-control" name="product-name"
                                id="exampleInputEmail1" aria-describedby="emailHelp" required>
                            <div id="emailHelp" class="form-text">Please, Customer entry your name
                                product.</div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Regular price
                                ($)</label>
                            <input type="number" name="price" class="form-control"
                                id="exampleInputPassword1" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">qualities</label>
                            <input type="number" name="quality" class="form-control"
                                id="exampleInputPassword1" required>
                        </div>
                        <div class="mb-3">
                            <div class="form-floating">
                                <textarea class="form-control" name="description"
                                    placeholder="Leave a comment here" required id="floatingTextarea2"
                                    style="height: 100px"></textarea>
                                <label for="floatingTextarea2">Descriptions</label>
                            </div>
                        </div>
                        <div class="mb-3 form-check">
                            <div class="input-group mb-3"
                                style="position: relative; width: 210px; height: 210px;">
                                <!-- Hidden File Input -->
                                <input type="file" name="image" id="image" class="visually-hidden"
                                    accept="image/*" required onchange="previewImage(event)">

                                <!-- Image Preview -->
                               
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
                <!-- inforamtion -->

            </div>

            <!-- <table class="table shadow">
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
                    ?>
                            <tr>
                                <td> <?php echo  htmlspecialchars($row['category_name']) ?> </td>
                                <td> <?php echo  htmlspecialchars($row['product_name']) ?> </td>
                                <td> <?php echo  htmlspecialchars($row['prices']) ?> </td>
                                <td> <?php echo   htmlspecialchars($row['qualities']) ?> </td>
                                <td> <?php echo  htmlspecialchars($row['descriptions']) ?> </td>
                                <td> <?php echo  "<img src='" . htmlspecialchars($row['image']) . "' alt='Image' style='width:100px;height:auto;'>" ?> </td>
                                <td>
                                    <a href="edit.php?id=<?php echo $row['product_id']; ?>" class="btn btn-warning"> <span class="glyphicon glyphicon-pencil"></span> Edit</a>
                                    <a href="deleteForm.php?id=<?php echo $row['product_id']; ?>" class="btn btn-danger"> <span class="glyphicon glyphicon-trash"></span> Delete</a>
                                </td>
                            </tr>

                    <?php


                        }
                    }
                    ?>

                </tbody>
            </table> -->

        </div>
    </div>

</html>