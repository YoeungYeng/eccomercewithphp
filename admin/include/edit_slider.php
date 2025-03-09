<?php
// require_once "../config.php";

$id = $_GET['p'];

$selected = "SELECT * FROM slides WHERE id = $id";
$result = $conn->query($selected);
if (!$result) {
    die("Query Failed: " . $conn->error);
}
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $id_ = $row['id'];
    $des = htmlspecialchars($row['description']);  // Same for description
    $im = htmlspecialchars($row['image_url']);  // Correct way to handle the image URL
    $img = "../admin/action/" . $im;
    $title = $row['title'];
} else {
    echo "no records";
}

?>

<div class="body-wrapper">
    <div class="container">
        <form action="action/save_edit_slide.php" method="POST" enctype="multipart/form-data" class="mb-4">
            <div class="row">
                <h2 class="mb-4">Manage Slideshow</h2>
                <hr>
                <!-- image -->
                <div class="mb-3 no-image">
                    <input type="hidden" name="id" value="<?= $id_ ?>">
                    <!-- image -->
                    <input type="file" id="image" name="image"
                        style="opacity: 0; position: absolute; width: 150px; height: 150px; cursor: pointer;"
                        class="form-control" accept="image/*">

                    <img src="<?= $img ?>" id="imagePreview" alt="image"
                        style="height: 150px; padding: 12px 16px; border-radius: 12px 17px; object-fit: cover; width: 150px; border: 1px solid #000; cursor: pointer;">
                </div>
                <div class="col-md-12 mt-4">
                    <label>Title</label>
                    <input type="text" value="<?= $title ?>" name="title" class="form-control">
                </div> <br />
                <div class="col-md-12 mt-4">
                    <label>Description</label>
                    <input type="text" value="<?= $des ?>" name="description" class="form-control">
                </div>
                <div class="col-md-12 mt-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Add Slide</button>
                </div>


            </div>
        </form>

        <!-- table show image -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $select = "SELECT * FROM `slides`";
                $result = $conn->query($select);
                if ($result->num_rows > 0) {

                    while ($row = $result->fetch_assoc()) {

                        // Fetching each row's data
                        $t = htmlspecialchars($row['title']);  // Use htmlspecialchars for safety
                        $des = htmlspecialchars($row['description']);  // Same for description
                        $im = htmlspecialchars($row['image_url']);  // Correct way to handle the image URL
                        $img = "../admin/action/" . $im;

                        ?>
                        <tr>
                            <td> <img src="<?= $img ?>" alt="image" style='width: 60px; height: auto; '></td>
                            </td>
                            <td>
                                <p> <?= $t; ?> </p>
                            </td>
                            <td>
                                <p> <?= $des; ?> </p>
                            </td>
                            <td>
                                <a href="edit_slideshow.php?p=<?php echo $row['id']; ?>"><button class="btn btn-primary"> Edit
                                    </button></a>
                                <a href="action/delelet_slide.php?p=<?php echo $row['id']; ?>">
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