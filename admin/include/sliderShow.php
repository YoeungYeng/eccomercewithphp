<?php

$selected = "SELECT * FROM `slides`";
$result = $conn->query($selected);
if (!$result) {
    die("Query Failed: " . $conn->error);
}

?>
<link rel="stylesheet" href="style.css">
<div class="body-wrapper">

    <div class="container-fluid ">
        <form action="action/save_slide.php" method="POST" enctype="multipart/form-data" class="mb-4">
            <div class="row">
                <h2 class="mb-4">Manage Slideshow</h2>
                <hr>
                <div class="col-md-12 mt-4 no-image" style="width: 150px; height: 150px; cursor: pointer; border: 1px solid #000; border-radius: 5px 7px; padding: 12px 14px; background: url('assets/images/no-image-icon-23485.png'); background-size: cover;">
                    <!-- <label>Upload Image</label> -->
                    <input type="file" name="image" style="opacity: 0;" id="txt-image" class="form-control" required>
                </div>
                <div class="col-md-12 mt-4">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div> <br />
                <div class="col-md-12 mt-4">
                    <label>Product Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div> <br />
                <div class="col-md-12 mt-4">
                    <label>Description</label>
                    <input type="text" name="description" class="form-control" required>
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
                                <a href="edit_slideshow.php?p=<?php echo $row['id']; ?>"><button class="btn btn-primary"> Edit </button></a>
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
document.getElementById("txt-image").addEventListener("change", function(event) {
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