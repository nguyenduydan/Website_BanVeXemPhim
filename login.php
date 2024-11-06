<?php include('includes/header.php');
$messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : []; // Lấy lỗi từ session
$formData = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];
unset($_SESSION['messages']); // Xóa lỗi khỏi session sau khi hiển thị
unset($_SESSION['form_data']);
?>

<div id="toast"></div>

<?php alertMessage() ?>

<div class="container my-5" id="container">
    <div class="form-container sign-in">
        <form class="py-2" action="views/controllers/user-controller.php" method="post">
            <div class="mb-3">
                <span class="fw-bolder fs-3">Đăng Nhập Tài Khoản</span>
            </div>

            <!-- Email -->
            <?php if (isset($messages['email'])): ?>
            <small class="text-danger m-2"><?= htmlspecialchars($messages['email']) ?></small>
            <?php endif; ?>
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                <input type="email" class="form-control" name="email" placeholder="Email"
                    value="<?php echo isset($formData['email']) ? htmlspecialchars($formData['email']) : ''; ?>">
            </div>

            <!-- Mật khẩu -->
            <?php if (isset($messages['password'])): ?>
            <small class="text-danger m-2"><?= htmlspecialchars($messages['password']) ?></small>
            <?php endif; ?>
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input type="password" class="form-control" id="password_login" name="password"
                    placeholder="Nhập mật khẩu">
                <span class="input-group-text iconEye" style="cursor: pointer;"
                    onclick="togglePassword('password_login', 'togglePasswordLogin')">
                    <i class="fas fa-eye-slash" id="togglePasswordLogin"></i>
                </span>
            </div>

            <!-- Ghi nhớ đăng nhập -->
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="remember_me" id="remember_me">
                <label class="form-check-label" for="remember_me">Ghi nhớ đăng nhập</label>
            </div>

            <!-- Nút Đăng Nhập -->
            <button type="submit" class="btn btn-primary w-100" name="login">Đăng Nhập</button>

            <!-- Liên kết Quên mật khẩu -->
            <div class="text-center mt-3">
                <a href="#">Quên mật khẩu?</a>
            </div>

            <!-- Liên kết Đăng ký -->
            <div class="text-center mt-2">
                <span>Chưa có tài khoản? <a href="register.php">Đăng ký</a></span>
            </div>
        </form>
    </div>
</div>

<?php include('includes/footer.php'); ?>