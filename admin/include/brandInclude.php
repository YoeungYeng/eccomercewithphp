<?php 

    require_once "./config.php";
    $p = $_GET['p'];
?>





<div class=" p-3 w-full">
    <div class="card shadow-lg w-full" >
        <div class="card-header bg-primary text-white" >
            <h4 class="mb-0">Brand Form</h4>
        </div>
        <div class="card-body">
            <form action="action/save_brand.php" method="post" enctype="multipart/form-data">
                <!-- Brand Name -->
                <div class="mb-3">
                    <label for="brandName" class="form-label">Brand Name</label>
                    <input type="text" class="form-control" name="txt-name" id="brandName"
                        placeholder="Enter brand name" required>
                </div>

                <!-- Brand Logo Upload -->
                <div class="mb-3 no-image"
                    style="padding: 12px 14px; width: 150px; height: 150px; cursor: pointer;  border-radius: 5px 7px; background: url('assets/images/no-image-icon-23485.png'); background-size: cover;">
                    <!-- <label for="image" class="form-label">Product Image</label> -->
                    <input type="file" style="width: 100%; height: 100px; opacity: 0" class="form-control"
                        accept="image/*" id="image" name="image"  required>
                </div>
                <!-- Brand Description -->
                <div class="mb-3">
                    <label for="brandDescription" class="form-label">Description</label>
                    <textarea class="form-control" name="txt-des" id="brandDescription" rows="3"
                        placeholder="Enter brand description"></textarea>
                </div>

                <!-- Status Dropdown -->
                <div class="mb-3">
                    <label for="brandStatus" class="form-label">Status</label>
                    <!-- <select class="form-select" id="brandStatus" name="txt-status" required>

                        
                        <option value="inactive">Inactive</option>
                    </select> -->
                    <input type="text" name="txt-status" id="">
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
    document.getElementById("image").addEventListener("change", function (event) {
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.querySelector(".no-image").style.backgroundImage = `url('${e.target.result}')`;
            };
            reader.readAsDataURL(file);
        }
    });
</script>