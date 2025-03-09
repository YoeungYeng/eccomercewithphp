<?php

require_once "./config.php";
$id = $_GET['p']; // retrieve the id from the URL



?>



<div class="container mt-5">
    <div class="card shadow-sm p-4">
        <h2 class="text-center mb-4"> this is About </h2>

        <form action="action/save_about.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Title </label>
                <input type="hidden" name="about_id" value="<?= $id ?>">
                <input type="text" class="form-control" id="title" name="txt-title" placeholder="Enter title" required>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Sub Title </label>
                <input type="hidden" name="about_id" value="<?= $id ?>">
                <input type="text" class="form-control" id="title" name="txt-subtitle" placeholder="Enter sub title"
                    required>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Name Team</label>
                <input type="hidden" name="about_id" value="<?= $id ?>">
                <input type="text" class="form-control" id="title" name="txt-nameTeam" placeholder="Enter team name"
                    required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4"
                    placeholder="Enter description" required></textarea>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Support Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label"> Phone </label>
                <input type="number" class="form-control" id="txt-phone" name="number" placeholder="Enter phone"
                    required>
            </div>
            <div class="mb-3">
            <label for="Position" class="form-label"> Position </label>
                <select class="form-select" name="select-role">
                    <option value="Frontend">Frontend</option>
                    <option value="Backend">Backend</option>
                    <option value="Fullstack">Fullstack</option>
                    <option value="UI/UX">UI/UX</option>
                </select>
            </div>

            <!-- image -->
            <div class="mb-3 no-image"
                style="padding: 12px 14px; width: 150px; height: 150px; cursor: pointer;  border-radius: 5px 7px; background: url('assets/images/no-image-icon-23485.png'); background-size: cover;">
                <!-- <label for="image" class="form-label">Product Image</label> -->
                <input type="file" style="width: 100%; height: 100px; opacity: 0" class="form-control" accept="image/*"
                    id="image" name="image" accept="image/*" required>
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