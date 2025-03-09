<!DOCTYPE html>
<html lang="en">

<?php
$id = $_GET['p'];
require "include/head.php";
require_once "./config.php";

$select = "SELECT * FROM `tbl_newarival` WHERE newArrival_id = '$id'";
$result = $conn->query($select);

$row = $result->fetch_assoc();
$id_ = $row['newArrival_id'];
$title = $row['title'];
$price = $row['price'];
$im = htmlspecialchars($row['image']);  // Correct way to handle the image URL
$img = "../admin/action/" . $im;



?>

<body>

    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0" style="color: #fff;">Add New Arrival</h4>
            </div>
            <div class="card-body">
                <form action="action/edit_newarrival.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="hidden" name="newArrival_id" value="<?= $id_ ?>">
                        <input type="text" class="form-control" value="<?= $title ?>" name="txt-title" id="title"
                            placeholder="Enter product title" required>
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Price ($)</label>
                        <input type="number" class="form-control" value="<?= $price ?>" name="txt-price" id="price"
                            placeholder="Enter price" required>
                    </div>

                    <div class="mb-3 no-image">
                        <input type="file" id="image" name="image"
                            style="opacity: 0; position: absolute; width: 150px; height: 150px; cursor: pointer;"
                            class="form-control" accept="image/*">

                        <img src="<?=$img ?>" id="imagePreview" alt="image"
                            style="height: 150px; padding: 12px 16px; border-radius: 12px 17px; object-fit: cover; width: 150px; border: 1px solid #000; cursor: pointer;">
                    </div>

                    <button type="submit" class="btn btn-success">Update Product</button>

                    
                </form>
                
                <!-- table -->
            <table class="table shadow">
                        <h2> Information of Products </h2>
                        <hr class="shadow">
                        <thead>
                            <tr>

                                <th scope="col">Title</th>
                                <th scope="col">Price</th>
                                <th scope="col">image</th>
                                <th scope="col">actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                $selecTable = "SELECT * FROM `tbl_newarival`";
                                $result = $conn->query($selecTable);
                                while ($row = $result->fetch_assoc()) {
                                    $im = htmlspecialchars($row['image']);  // Correct way to handle the image URL
                                    $img = "../admin/action/" . $im;

                                    ?>
                                    <tr>
                                        <td> <?php echo htmlspecialchars($row['title']) ?> </td>

                                        <td> <?php echo htmlspecialchars($row['price']) ?> </td>


                                        <td> <img src="<?= $img ?>" alt="image" style='width: 60px; height: auto; '>
                                        </td>
                                        <td>
                                            <a href="editnewArrival.php?p=<?php echo $row['newArrival_id']; ?>"
                                                class="btn btn-warning">
                                                <span class="glyphicon glyphicon-pencil"></span> Edit</a>
                                            <a href="action/delet_newArrival.php?id=<?php echo $row['newArrival_id']; ?>"
                                                class="btn btn-danger"> <span class="glyphicon glyphicon-trash"></span>
                                                Delete
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
    <?php require "include/footer.php"; ?>

</body>


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

</html>