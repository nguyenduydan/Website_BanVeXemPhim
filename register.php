<?php include('includes/header.php'); ?>

<div class="container my-5" id="container">
    <div class="form-container sign-up">
        <form class="py-2" action="views/controllers/user-controller.php" method="post">
            <span class="fw-bolder fs-3">Đăng Ký Tài Khoản</span>

            <!-- Họ và tên -->
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
                <input type="text" class="form-control" name="name" placeholder="Họ và tên">
                <?php if (isset($messages['name'])): ?>
                    <small class="text-danger m-2"><?= htmlspecialchars($messages['name']) ?></small>
                <?php endif; ?>
            </div>

            <!-- Email -->
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                <input type="email" class="form-control" name="email" placeholder="Email">
                <?php if (isset($messages['email'])): ?>
                    <small class="text-danger m-2"><?= htmlspecialchars($messages['email']) ?></small>
                <?php endif; ?>
            </div>

            <!-- Số điện thoại -->
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                <input type="tel" class="form-control" name="phone" placeholder="Số điện thoại">
                <?php if (isset($messages['phone'])): ?>
                    <small class="text-danger m-2"><?= htmlspecialchars($messages['phone']) ?></small>
                <?php endif; ?>
            </div>

            <!-- Giới tính -->
            <div class="mb-3">
                <label class="form-label">Giới tính</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="male" value="Nam">
                    <label class="form-check-label" for="male">Nam</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="female" value="Nữ">
                    <label class="form-check-label" for="female">Nữ</label>
                </div>
            </div>

            <!-- Ngày sinh -->
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                <input type="date" class="form-control" name="birthdate" placeholder="Ngày sinh">
                <?php if (isset($messages['birthdate'])): ?>
                    <small class="text-danger m-2"><?= htmlspecialchars($messages['birthdate']) ?></small>
                <?php endif; ?>
            </div>

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