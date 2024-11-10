<?php
require '../config/function.php';
$messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : []; // Lấy lỗi từ session
$formData = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];
unset($_SESSION['messages']); // Xóa lỗi khỏi session sau khi hiển thị
unset($_SESSION['form_data']);
// Lấy lại dữ liệu từ cookie nếu có
$username = isset($_COOKIE['username']) ? $_COOKIE['username'] : '';
// Kiểm tra trạng thái của checkbox 'Remember me'
$rememberMeChecked = isset($_SESSION['rememberMe']) && $_SESSION['rememberMe'] ? 'checked' : '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Đăng nhập</title>
    <?php require('../admin/includes/links.php'); ?>
    <style>
        .input-group .form-control {
            padding-right: 40px;
            /* Để dành khoảng trống cho icon */
        }

        .input-group {
            position: relative;
        }

        .input-group .icon {
            position: absolute;
            right: 20px;
            /* Đặt icon ở phía bên phải của ô input */
            top: 40%;
            transform: translateY(-50%);
            cursor: pointer;
            z-index: 999;
            /* Đảm bảo icon không bị che khuất */
        }
    </style>
</head>
<div id="toast"></div>

<?php alertMessage() ?>

<body class="">
    <main class="main-content mt-0">
        <section>
            <div class="page-header min-vh-75">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-7 col-md-6 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-8">
                                <div class="card-header pb-0 text-left bg-transparent">
                                    <h1 class="fx- font-weight-bolder text-info text-gradient">Đăng nhập</h1>
                                </div>
                                <div class="card-body">
                                    <form role="form" action="controllers/signin-controller.php" method="post">
                                        <label class="fs-5">Tên đăng nhập</label>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" name="username"
                                                placeholder="Username" aria-label="Username"
                                                aria-describedby="username-addon"
                                                value="<?= isset($formData['username']) ? htmlspecialchars($formData['username']) : htmlspecialchars($username); ?>"
                                                autocomplete="username">
                                            <?php if (isset($messages['username'])): ?>
                                                <small
                                                    class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['username']) ?></small>
                                            <?php endif; ?>
                                        </div>

                                        <label class="fs-5">Mật khẩu</label>
                                        <div class="input-group">
                                            <input type="password" id="password" name="password" class="form-control"
                                                placeholder="Password" aria-label="Password"
                                                aria-describedby="password-addon" autocomplete="password">
                                            <span class="icon" id="password-addon">
                                                <i class="fas fa-eye-slash" id="togglePassword"></i>
                                            </span>
                                        </div>
                                        <?php if (isset($messages['password'])): ?>
                                            <small
                                                class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['password']) ?></small>
                                        <?php endif; ?>
                                        <div class="form-check mt-3 form-switch">
                                            <input class="form-check-input" type="checkbox" id="rememberMe"
                                                name="rememberMe" value="1" <?php echo $rememberMeChecked; ?>>
                                            <label class="form-check-label" for="rememberMe">Ghi nhớ đăng nhập</label>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" name="SignIn"
                                                class="btn bg-gradient-info w-100 mt-4 mb-0 fs-5">Đăng nhập</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6"
                                    style="background-image:url('../assets/imgs/curved-images/curved6.jpg')"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>


    <div class="mt-5">
        <?php include('includes/footer.php'); ?>
    </div>
</body>

</html>
