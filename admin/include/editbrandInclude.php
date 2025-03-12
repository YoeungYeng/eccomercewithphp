<?php 

    $id = $_GET['p'];
    require_once "./config.php";
   
    $select = "SELECT *FROM tbl_brand WHERE brand_id = '$id'";
    $result = $conn->query($select);

    $row = $result->fetch_assoc();
    $brand_name = $row['brand_name'];
    $im = htmlspecialchars($row['image']);
    $img = "../admin/action/" . $im;
    $des = $row['des'];
    $status = $row['status'];
?>





<div class=" p-3">
    <div class="card shadow-lg" style="margin-top: 120px;">
        <div class="card-header bg-primary text-white" style="margin-top: -30px;">
            <h4 class="mb-0">Brand Form</h4>
        </div>
        <div class="card-body">
            <form action="action/edit_brand.php" method="post" enctype="multipart/form-data">
                <!-- Brand Name -->
                <div class="mb-3">
                    <label for="brandName" class="form-label">Brand Name</label>
                    <input type="hidden" name="id" value="<?php echo $row['brand_id'] ?>">
                    <input type="text" value="<?php echo $brand_name ?>" class="form-control" name="txt-name" id="brandName"
                        placeholder="Enter brand name" required>
                </div>

                <!-- Brand Logo Upload -->
                <div class="mb-3 no-image">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <!-- image -->
                    <input type="file" id="image" name="image"
                        style="opacity: 0; position: absolute; width: 150px; height: 150px; cursor: pointer;"
                        class="form-control" accept="image/*">

                    <img src="<?= $img ?>" id="imagePreview" alt="image"
                        style="height: 150px; padding: 12px 16px; border-radius: 12px 17px; object-fit: cover; width: 150px; border: 1px solid #000; cursor: pointer;">
                </div>
                <!-- Brand Description -->
                <div class="mb-3">
                    <label for="brandDescription" class="form-label">Description</label>
                    <textarea class="form-control" name="txt-des" id="brandDescription" rows="3"
                        placeholder="Enter brand description"><?php echo $des ?></textarea>
                </div>

                <!-- Status Dropdown -->
                <div class="mb-3">
                    <label for="brandStatus" class="form-label">Status</label>
                    <!-- <select class="form-select" id="brandStatus" name="txt-status" required>

                        
                        <option value="inactive">Inactive</option>
                    </select> -->
                    <input type="text" value="<?php $status ?>" name="txt-status" id="">
                </div>

                <!-- Submit and Reset Buttons -->
                <div class="d-flex justify-content-end">
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
             <!-- table -->
        <table class="table shadow ">
            <h2> Information of Brand </h2>
            <hr class="shadow">
            <thead>
                <tr>

                    <th scope="col">Brand Name</th>
                    <th scope="col">image</th>
                    <th scope="col">Description</th>

                    <!-- <th scope="col">Email</th> -->
                    <th scope="col">Status</th>
                    
                    <th scope="col">actions</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $selected = "SELECT * FROM `tbl_brand`";
                $result = $conn->query($selected);
                if ($result->num_rows > 0) {

                    while ($row = $result->fetch_assoc()) {
                        $im = htmlspecialchars($row['image']);  // Correct way to handle the image URL
                        $img = "../admin/action/" . $im;

                        ?>
                        <tr>
                            <td> <?php echo htmlspecialchars($row['brand_name']) ?> </td>
                            <td> <?php echo htmlspecialchars($row['image']) ?> </td>
                            <td> <?php echo htmlspecialchars($row['des']) ?> </td>
                            <td> <?php echo htmlspecialchars($row['status']) ?> </td>

                            <td> <img src="<?= $img ?>" alt="image" style='width: 40px; height: auto; '>
                            </td>
                            <td style="width: 200px; display: flex; gap: 10px;">
                                <a href="editbrand.php?p=<?php echo $row['brand_id'] ?>" class="btn btn-warning">
                                    <span class="glyphicon glyphicon-pencil"></span> Edit</a>
                                <br>
                                <a href="#">
                                    <button class="btn btn-danger"> Delete </button>
                                </a>
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

<!-- script for change image -->
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