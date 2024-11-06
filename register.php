<?php include('includes/header.php');
$messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : []; // Lấy lỗi từ session
$formData = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];
unset($_SESSION['messages']); // Xóa lỗi khỏi session sau khi hiển thị
unset($_SESSION['form_data']);
?>

<div class="container my-5" id="container">
    <div class="form-container sign-up">
        <form class="py-2" action="views/controllers/user-controller.php" method="post">
            <span class="fw-bolder fs-3">Đăng Ký Tài Khoản</span>

            <!-- Họ và tên -->
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
                <input type="text" class="form-control" name="name" placeholder="Họ và tên">
                
            </div>
            <?php if (isset($messages['name'])): ?>
                    <small class="text-danger m-2"><?= htmlspecialchars($messages['name']) ?></small>
                <?php endif; ?>
            <!-- Email -->
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                <input type="email" class="form-control" name="email" placeholder="Email">
                
            </div>
            <?php if (isset($messages['email'])): ?>
                    <small class="text-danger m-2"><?= htmlspecialchars($messages['email']) ?></small>
                <?php endif; ?>
            <!-- Mật khẩu -->
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu">
                <span class="input-group-text iconEye" style="cursor: pointer;"
                    onclick="togglePassword('password', 'togglePassword')">
                    <i class="fas fa-eye-slash" id="togglePassword"></i>
                </span>
            </div>
            <?php if (isset($messages['password'])): ?>
                <small class="text-danger m-2"><?= htmlspecialchars($messages['password']) ?></small>
            <?php endif; ?>

            <!-- Nhập lại mật khẩu -->
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
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

            <!-- Nút Hoàn Thành -->
            <button type="submit" class="btn btn-primary w-100 mt-3" name="signup">Hoàn Thành</button>
        </form>
    </div>
</div>

<?php include('includes/footer.php'); ?>