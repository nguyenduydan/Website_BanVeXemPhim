<?php include('includes/header.php'); ?>

<div class="container my-5" id="container">
    <div class="form-container sign-up">
        <form class="py-2" action="views/controllers/user-controller.php" method="post">
            <span class="fw-bolder fs-3">Tạo Tài Khoản</span>
            <input type="text" name="name" placeholder="Họ và tên">
            <?php if (isset($messages['name'])): ?>
                            <small class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['name']) ?></small>
                        <?php endif; ?>
            <input type="email" name="email" placeholder="Email">
            <div class="input-group">
                <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu">
                <span class="input-group-text iconEye" style="cursor: pointer;">
                    <i class="fas fa-eye-slash" id="togglePassword"></i>
                </span>
            </div>
            <?php if (isset($messages['password'])): ?>
                            <small class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['name']) ?></small>
                        <?php endif; ?>
            <div class="input-group">
                <input type="password" class="form-control" id="re_password" name="re_password"
                    placeholder="Nhập lại mật khẩu">
                <span class="input-group-text iconEye" style="cursor: pointer;">
                    <i class="fas fa-eye-slash" id="toggleRePassword"></i>
                </span>
            </div>
            <?php if (isset($messages['re_password'])): ?>
                            <small class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['re_password']) ?></small>
                        <?php endif; ?>
            <button type="submit" name="signup">Đăng Ký</button>
        </form>
    </div>
    <div class="form-container sign-in">
        <form action="views/controllers/user-controller.php" method="post">
            <span class="fw-bolder fs-3">Đăng Nhập</span>
            <input type="email" name="email" placeholder="Email">
            <div class="input-group">
                <input type="password" class="form-control" id="password_login" name="password"
                    placeholder="Nhập mật khẩu">
                <span class="input-group-text iconEye" style="cursor: pointer;">
                    <i class="fas fa-eye-slash" id="togglePasswordLogin"></i>
                </span>
            </div>
            <div class="d-flex input-group flex-nowrap align-items-center">
                <input type="checkbox" class="form-check" name="note_login" id="note_login" placeholder="Mật khẩu">
                <label for="note_login">Ghi nhớ đăng nhập</label>
            </div>
            <button type="submit" name="login">Đăng Nhập</button>
            <a href="#">Quên mật khẩu?</a>
        </form>
    </div>
    <div class="toggle-container">
        <div class="toggle">
            <div class="toggle-panel toggle-left">
                <h1>Chào mừng trở lại!</h1>
                <p>Nhập thông tin cá nhân của bạn để sử dụng tất cả tính năng của trang web</p>
                <button class="hidden" id="login">Đăng Nhập</button>
            </div>
            <div class="toggle-panel toggle-right">
                <h1>Xin chào, Bạn mới!</h1>
                <p>Đăng ký với thông tin cá nhân của bạn để sử dụng tất cả tính năng của trang web</p>
                <button class="hidden" id="register">Đăng Ký</button>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>