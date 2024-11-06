<?php include('includes/header.php');
$messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : []; // Lấy lỗi từ session
$formData = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];
unset($_SESSION['messages']); // Xóa lỗi khỏi session sau khi hiển thị
unset($_SESSION['form_data']);
?>

<div id="toast"></div>

<?php alertMessage() ?>

<div class="container my-5" id="container">
    <div class="form-container sign-up">
        <form class="py-2" action="views/controllers/user-controller.php" method="post">
            <div class="mb-3 ">
                <div class="mb-3 text-center">
                    <span class="fw-bolder fs-3">Đăng Ký Tài Khoản</span>
                </div>

                <!-- Họ và tên -->
                <div class="mb-3">
                    <div class="input-group mb-1">
                        <span class="input-group-text bg-primary"><i class="fas fa-user text-white"></i></span>
                        <input type="text" class="form-control" name="name" placeholder="Họ và tên">

                    </div>
                    <?php if (isset($messages['name'])): ?>
                        <small class="text-danger m-2"><?= htmlspecialchars($messages['name']) ?></small>
                    <?php endif; ?>
                </div>
                <!-- Email -->
                <div class="mb-3">
                    <div class="input-group mb-1">
                        <span class="input-group-text bg-primary"><i class="fas fa-envelope text-white"></i></span>
                        <input type="email" class="form-control" name="email" placeholder="Email">

                    </div>
                    <?php if (isset($messages['email'])): ?>
                        <small class="text-danger m-2"><?= htmlspecialchars($messages['email']) ?></small>
                    <?php endif; ?>
                </div>

                <!-- Mật khẩu -->
                <div class="mb-3">
                    <div class="input-group mb-1">
                        <span class="input-group-text bg-primary"><i class="fas fa-lock text-white"></i></span>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Nhập mật khẩu">
                        <span class="input-group-text iconEye" style="cursor: pointer;"
                            onclick="togglePassword('password', 'togglePassword')">
                            <i class="fas fa-eye-slash" id="togglePassword"></i>
                        </span>
                    </div>
                    <?php if (isset($messages['password'])): ?>
                        <small class="text-danger m-2"><?= htmlspecialchars($messages['password']) ?></small>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <!-- Nhập lại mật khẩu -->
                    <div class="input-group mb-1">
                        <span class="input-group-text bg-primary"><i class="fas fa-lock text-white"></i></span>
                        <input type="password" class="form-control" id="re_password" name="re_password"
                            placeholder="Nhập lại mật khẩu">
                        <span class="input-group-text iconEye" style="cursor: pointer;"
                            onclick="togglePassword('re_password', 'toggleRePassword')">
                            <i class="fas fa-eye-slash" id="toggleRePassword"></i>
                        </span>
                    </div>
                    <?php if (isset($messages['re_password'])): ?>
                        <small class="text-danger m-2"><?= htmlspecialchars($messages['re_password']) ?></small>
                    <?php endif; ?>
                </div>


                <!-- Nút Hoàn Thành -->
                <button type="submit" class="btn w-100 mt-3" id="login-sigin" name="signup">Đăng ký</button>

                <!-- Liên kết đến trang đăng nhập -->
                <div class="text-center mt-2">
                    <span>Đã có tài khoản? <a href="login.php">Đăng nhập</a></span>
                </div>
        </form>
    </div>
</div>

<?php include('includes/footer.php'); ?>
