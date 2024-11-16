<?php
$title = "Đăng nhập";
include('includes/header.php');
$messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : []; // Lấy lỗi từ session
$formData = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];
unset($_SESSION['messages']); // Xóa lỗi khỏi session sau khi hiển thị
unset($_SESSION['form_data']);

// Lấy lại dữ liệu từ cookie nếu có
$username = isset($_COOKIE['username']) ? $_COOKIE['username'] : '';
// Kiểm tra trạng thái của checkbox 'Remember me'
$rememberMeChecked = isset($_SESSION['rememberMe']) && $_SESSION['rememberMe'] ? 'checked' : '';
?>

<div id="toast"></div>

<?php alertMessage(); ?>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-4 shadow rounded">
            <div class="form-container sign-in">
                <form id="login-form" class="py-4" action="views/controllers/user-controller.php" method="post">
                    <div class="mb-3 text-center">
                        <span class="fw-bolder fs-3">Đăng Nhập Tài Khoản</span>
                    </div>
                    <!-- Tên đăng nhập -->
                    <div class="mb-3">
                        <div class="input-group mb-1">
                            <span class="input-group-text bg-primary"><i class="fas fa-envelope text-white"></i></span>
                            <input type="text" class="form-control" name="tendn" placeholder="Tên đăng nhập"
                                autocomplete="username"
                                value="<?php echo isset($formData['tendn']) ? htmlspecialchars($formData['tendn']) : htmlspecialchars($username); ?>">
                        </div>
                        <?php if (isset($messages['tendn'])): ?>
                        <small class="text-danger m-2"><?= htmlspecialchars($messages['tendn']) ?></small>
                        <?php endif; ?>
                    </div>

                    <!-- Mật khẩu -->
                    <div class="mb-3">
                        <div class="input-group mb-1">
                            <span class="input-group-text bg-primary"><i class="fas fa-lock text-white"></i></span>
                            <input type="password" class="form-control" id="password_login" name="password"
                                placeholder="Nhập mật khẩu">
                            <span class="input-group-text iconEye me-2" style="cursor: pointer;"
                                onclick="togglePassword('password_login', 'togglePasswordLogin')">
                                <i class="fas fa-eye-slash" id="togglePasswordLogin"></i>
                            </span>
                        </div>
                        <?php if (isset($messages['password'])): ?>
                        <small class="text-danger m-2"><?= htmlspecialchars($messages['password']) ?></small>
                        <?php endif; ?>
                    </div>

                    <!-- Ghi nhớ đăng nhập -->
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" name="remember_me" id="remember_me"
                            <?php echo $rememberMeChecked; ?>>
                        <label class="form-check-label" for="remember_me">Ghi nhớ đăng nhập</label>
                    </div>

                    <!-- Nút Đăng Nhập -->
                    <button type="submit" class="btn btn-primary w-100" id="login-sigin" name="login">Đăng Nhập</button>

                    <!-- Liên kết Quên mật khẩu -->
                    <div class="text-center mt-3">
                        <a href="#" data-bs-toggle="modal" data-url="views/controllers/user-controller.php"
                            data-bs-target="#confirmModal">Quên mật khẩu?</a>
                    </div>

                    <!-- Modal Quên Mật Khẩu -->
                    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog mt-5">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmModalLabel">Quên mật khẩu</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="username-fpwd">Tên đăng nhập:</label>
                                        <input type="text" class="form-control mt-2" id="username-fpwd"
                                            name="username-fpwd">
                                        <?php if (isset($messages['username-fpwd'])): ?>
                                        <small
                                            class="text-danger m-2"><?= htmlspecialchars($messages['username-fpwd']) ?></small>
                                        <?php endif; ?>
                                        <label for="email-fpwd">Địa chỉ email:</label>
                                        <input type="email" class="form-control mt-2" id="email-fpwd" name="email-fpwd">
                                        <?php if (isset($messages['email-fpwd'])): ?>
                                        <small
                                            class="text-danger m-2"><?= htmlspecialchars($messages['email-fpwd']) ?></small>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="modal-footer d-flex justify-content-center">
                                    <button type="submit" id="forget-password" class="btn btn-sm btn-success px-3"
                                        name="forget-password">Gửi</button>
                                    <button type="button" class="btn btn-sm btn-danger me-2"
                                        data-bs-dismiss="modal">Không</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Liên kết Đăng ký -->
                    <div class="text-center border-bottom pb-3">
                        <span>Chưa có tài khoản? <a href="register.php">Đăng ký</a></span>
                    </div>
                    <?php
                    // Tạo đường dẫn đăng nhập Google
                    $client_id = '918231739151-2cmcgr7vv80e5bq71uhce9kqfqoopfbt.apps.googleusercontent.com'; // Thay bằng Client ID từ Google Cloud Console
                    $redirect_uri = 'http://localhost/Website_BanVeXemPhim/views/controllers/google-callback.php'; // URL để xử lý phản hồi của Google
                    $scope = 'email profile';

                    $google_login_url = 'https://accounts.google.com/o/oauth2/auth?' . http_build_query([
                        'client_id' => $client_id,
                        'redirect_uri' => $redirect_uri,
                        'response_type' => 'code',
                        'scope' => $scope,
                        'access_type' => 'offline',
                        'prompt' => 'select_account'
                    ]);

                    // Hiển thị nút đăng nhập Google
                    // echo '<a href="' . htmlspecialchars($google_login_url) . '">Đăng nhập bằng Google</a>';
                    ?>
                    <!-- Nút Đăng Nhập Google -->
                    <div class="text-center mt-2" id="btn-google">
                        <a href="<?= htmlspecialchars($google_login_url) ?>" class="btn p-2 shadow">
                            <i class="bi bi-google"></i><span> Đăng nhập bằng Google</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>