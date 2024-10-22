<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>
    Đăng nhập
  </title>
  <?php require('../admin/includes/links.php'); ?>
  <style>
    .input-group .form-control {
      padding-right: 40px;
      /* Để dành khoảng trống cho icon */
    }

    .input-group .icon {
      position: absolute;
      right: 20px;
      /* Đặt icon ở phía bên phải của ô input */
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
    }

    .input-group {
      position: relative;
    }
  </style>
</head>

<body class="">
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-75">
        <div class="container">
          <div class="row">
            <div class="col-xl-6 col-lg-7 col-md-6 d-flex flex-column mx-auto">
              <div class="card card-plain mt-8">
                <div class="card-header pb-0 text-left bg-transparent">
                  <h1 class="fx- font-weight-bolder text-info text-gradient">Đăng nhập</h3>

                </div>
                <div class="card-body">
                  <form role="form">
                    <label class="fs-5">Username</label>
                    <div class="mb-3">
                      <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="username-addon">
                    </div>
                    <label class="fs-5">Password</label>
                    <div class="input-group mb-3">
                      <input type="password" id="passwordInput" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon">
                      <span class="icon d-flex" id="password-addon">
                        <i class="fas fa-eye" id="togglePassword" style="cursor: pointer;"></i>
                      </span>
                    </div>
                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                      <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div>
                    <div class="text-center">
                      <button type="button" class="btn bg-gradient-info w-100 mt-4 mb-0 fs-5">Sign in</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('../assets/imgs/curved-images/curved6.jpg')"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <script>
    const togglePassword = document.querySelector("#togglePassword");
    const passwordInput = document.querySelector("#passwordInput");

    togglePassword.addEventListener("click", function() {
      // Chuyển đổi thuộc tính type giữa password và text
      const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
      passwordInput.setAttribute("type", type);

      // Đổi icon mắt
      this.classList.toggle("fa-eye-slash");
    });
  </script>
  <div class="mt-5">
    <?php include('includes/footer.php'); ?>
  </div>
