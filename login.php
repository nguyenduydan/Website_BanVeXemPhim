<?php include('includes/header.php'); ?>

<div class="container my-5" id="container">
    <div class="form-container sign-in">
        <form class="py-2" action="views/controllers/user-controller.php" method="post">
            <span class="fw-bolder fs-3">Đăng Nhập</span>

            <!-- Email -->
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                <input type="email" class="form-control" name="email" placeholder="Email">
                <?php if (isset($messages['email'])): ?>
                    <small class="text-danger m-2"><?= htmlspecialchars($messages['email']) ?></small>
                <?php endif; ?>
            </div>

            <!-- Mật khẩu -->
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input type="password" class="form-control" id="password_login" name="password"
                    placeholder="Nhập mật khẩu">
                <span class="input-group-text iconEye" style="cursor: pointer;"
                    onclick="togglePassword('password_login', 'togglePasswordLogin')">
                    <i class="fas fa-eye-slash" id="togglePasswordLogin"></i>
                </span>
            </div>
            <?php if (isset($messages['password'])): ?>
                <small class="text-danger m-2"><?= htmlspecialchars($messages['password']) ?></small>
            <?php endif; ?>

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