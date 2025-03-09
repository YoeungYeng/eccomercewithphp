<?php

require_once "./config.php";
$id = $_GET['p']; // retrieve the id from the URL
$sql = "SELECT * FROM `tbl_about` WHERE about_id = '$id'";

$result = $conn->query($sql);
$row = $result->fetch_assoc();
$teamName = $row['team_name'];
$description = $row['description'];
$email = $row['email'];
$phone = $row['phone'];
$im = htmlspecialchars($row['image']);  // Correct way to handle the image URL
$img = "../admin/action/" . $im;
?>



<div class="container mt-5">
    <div class="card shadow-sm p-4">
        <h2 class="text-center mb-4"> this is About </h2>

        <form action="action/edit_about.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Name Team</label>
                <input type="hidden" name="about_id" value="<?= $id ?>">
                <input type="text" class="form-control" id="title" name="txt-nameTeam" value="<?= $teamName ?>"
                    placeholder="Enter team name">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4"
                    placeholder="Enter description">
                    <?= $description ?>
                </textarea>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Support Email</label>
                <input type="email" class="form-control" value="<?= $email ?>" id="email" name="email"
                    placeholder="Enter email">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label"> Phone </label>
                <input type="number" class="form-control" value="<?= $phone ?>" id="txt-phone" name="number"
                    placeholder="Enter phone">
            </div>
            <!-- image -->
            <div class="mb-3 no-image">
                <input type="file" id="image" name="image"
                    style="opacity: 0; position: absolute; width: 150px; height: 150px; cursor: pointer;"
                    class="form-control" accept="image/*">

                <img src="<?= $img ?>" id="imagePreview" alt="image"
                    style="height: 150px; padding: 12px 16px; border-radius: 12px 17px; object-fit: cover; width: 150px; border: 1px solid #000; cursor: pointer;">
            </div>
            <div class="mb-3">
                <label for="social" class="form-label">Social Media</label>
                <div>
                    <a href="#" class="btn btn-outline-primary me-2"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="btn btn-outline-info me-2"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="btn btn-outline-danger me-2"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="btn btn-outline-dark"><i class="bi bi-github"></i></a>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100">Save</button>
        </form>
        <!-- table -->
        <table class="table shadow ">
            <h2> Information of Products </h2>
            <hr class="shadow">
            <thead>
                <tr>

                    <th scope="col">Team Name</th>
                    <th scope="col">Description</th>

                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">image</th>
                    <th scope="col">actions</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $selected = "SELECT * FROM `tbl_about`";
                $result = $conn->query($selected);
                if ($result->num_rows > 0) {

                    while ($row = $result->fetch_assoc()) {
                        $im = htmlspecialchars($row['image']);  // Correct way to handle the image URL
                        $img = "../admin/action/" . $im;

                        ?>
                        <tr>
                            <td> <?php echo htmlspecialchars($row['team_name']) ?> </td>
                            <td> <?php echo htmlspecialchars($row['description']) ?> </td>
                            <td> <?php echo htmlspecialchars($row['email']) ?> </td>
                            <td> <?php echo htmlspecialchars($row['phone']) ?> </td>

                            <td> <img src="<?= $img ?>" alt="image" style='width: 40px; height: auto; '>
                            </td>
                            <td style="width: 200px; display: flex; gap: 10px;">
                                <a href="editabout.php?p=<?php echo $row['about_id']; ?>" class="btn btn-warning">
                                    <span class="glyphicon glyphicon-pencil"></span> Edit</a>
                                <br>
                                <a href="action/delete_about.php?p=<?php echo $row['about_id']; ?>">
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


</html>

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