


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ecoomerce</title>

  <link rel="stylesheet" href="./assets/css/styles.min.css" />
</head>

<body>

  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <!-- <img src="../assets/images/logos/dark-logo.svg" width="180" alt=""> -->
                </a>
                <p class="text-center">Registor Form</p>
                <form action="registorForm.php" id="form" method="post">
                  <div class="mb-3">
                    <label for="exampleInputtext1" class="form-label">Username</label>
                    <input type="text" class="form-control" name="txt-user-name" id="txt-user-name" aria-describedby="textHelp" required>
                  </div>
                  
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email Address</label>
                    <input type="email" name="txt-email" class="form-control" id="txt-email" aria-describedby="emailHelp" required>
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Phone</label>
                    <input type="number" name="txt-phone" class="form-control" id="txt-phone" aria-describedby="emailHelp" required>
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="txt-password" class="form-control" id="txt-password" required>
                  </div>
                  <button type="submit" name="created" id="registor" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2"> Sign Up </button>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">Already have an Account?</p>
                    <a class="text-primary fw-bold ms-2" href="login.php">Sign In</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="./assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- jqery -->
  <!-- <script>
    $(document).ready(function() {


      $("#registor").click((e) => {

        var valid = document.getElementById('form');


        // chekc true or false
        if (valid && valid.checkValidity()) {
          
          var firstName = $("#txt-first-name").val();
          var lastName = $("#txt-last-name").val();
          var email = $("#txt-email").val();
          var phone = $("#txt-phone").val();
          var password = $("#txt-password").val();
          e.preventDefault();
          // AJAX request to submit data
          $.ajax({
            url: "registorForm.php",
            type: "POST",
            data: {
              firstName: firstName,
              lastName: lastName,
              email: email,
              phone: phone,
              password: password,
            },
            success: function(data) {
              Swal.fire({
                title: "Registration Successful",
                text: "Your account has been created!",
                icon: "success",
              });
            },
            error: function(data) {
              Swal.fire({
                title: "Error",
                text: "Failed to save data. Check console for details.",
                icon: "error",
              });
            },
          });
        } else {

        }

      });


    });
  </script> -->
</body>


</html>