<!DOCTYPE html>
<html lang="en">

<?php require "include/head.php";
require_once "./config.php";
$id = $_GET['p'];
$select = "SELECT * FROM `tbl_newarival`";
$result = $conn->query($select);


?>

<body>

    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0" style="color: #fff;">Add New Arrival</h4>
            </div>
            <div class="card-body">
                <form action="action/save_newArriaval.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" name="txt-title" id="title"
                            placeholder="Enter product title" required>
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Price ($)</label>
                        <input type="number" class="form-control" name="txt-price" id="price" placeholder="Enter price"
                            required>
                    </div>

                    <div class="mb-3 no-image"
                        style="padding: 12px 14px; width: 150px; height: 150px; cursor: pointer; border: 1px solid #000; border-radius: 5px 7px; padding: 12px 14px; background: url('assets/images/no-image-icon-23485.png'); background-size: cover;">
                        <!-- <label for="image" class="form-label">Product Image</label> -->
                        <input type="file" style="width: 100%; height: 100px; opacity: 0" class="form-control"
                            accept="image/*" id="image" name="image" accept="image/*" required>
                    </div>

                    <button type="submit" class="btn btn-success">Add Product</button>

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
                </form>
            </div>
        </div>
    </div>
    <?php require "include/footer.php"; ?>

</body>


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

</html>