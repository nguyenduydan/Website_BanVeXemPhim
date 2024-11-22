<?php
// Kết nối file cấu hình và header
require '../../../config/function.php';
include('../../includes/header.php');

// Kiểm tra đăng nhập, nếu chưa đăng nhập sẽ chuyển hướng đến trang đăng nhập
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    redirect('sign-in.php', 'error', 'Vui lòng đăng nhập');
}
if (isset($_SESSION['EmployedIn']) && $_SESSION['EmployedIn'] === true) {
    redirect('index.php', 'error', 'Bạn không phải admin!','admin');
}
// Lấy thông báo lỗi từ session nếu có và dữ liệu form người dùng đã nhập trước đó
$messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : [];
$formData = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];
unset($_SESSION['messages']); // Xóa lỗi khỏi session sau khi hiển thị
unset($_SESSION['form_data']);
?>

<div id="toast"></div>
<?php alertMessage() ?>

<div class="row">
    <div class="col-xl-12 col-lg-12 mx-auto">
        <h2><?php echo $title ?></h2>
        <div class="text-end mb-4">
            <a class="btn btn-secondary" href="../../user.php">Quay lại</a>
        </div>
        <form id="addUserForm" action="../../controllers/user-controller.php" method="post"
            enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="name">Họ và tên người dùng (<span class="text-danger">*</span>)</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nhập họ và tên"
                            value="<?php echo isset($formData['name']) ? htmlspecialchars($formData['name']) : ''; ?>">
                        <?php if (isset($messages['name'])): ?>
                        <small class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['name']) ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="username">Tên đăng nhập (<span class="text-danger">*</span>)</label>
                        <input type="text" class="form-control" id="username" name="username"
                            placeholder="Nhập tên đăng nhập"
                            value="<?php echo isset($formData['username']) ? htmlspecialchars($formData['username']) : ''; ?>">
                        <?php if (isset($messages['username'])): ?>
                        <small class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['username']) ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">Mật khẩu (<span class="text-danger">*</span>)</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Nhập mật khẩu">
                            <span class="input-group-text iconEye" style="cursor: pointer;">
                                <i class="fas fa-eye-slash" id="togglePassword"></i>
                            </span>
                        </div>
                        <?php if (isset($messages['password'])): ?>
                        <small class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['password']) ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="re_password">Nhập lại mật khẩu (<span class="text-danger">*</span>)</label>
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
                    </div>

                    <div class="form-group mb-3">
                        <label for="email">Email (<span class="text-danger">*</span>)</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email"
                            value="<?php echo isset($formData['email']) ? htmlspecialchars($formData['email']) : ''; ?>">
                        <?php if (isset($messages['email'])): ?>
                        <small class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['email']) ?></small>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row mb-3">
                        <div class="col-6">
                            <label for="gioi_tinh">Giới tính (<span class="text-danger">*</span>)</label>
                            <select class="form-control form-select" id="gioi_tinh" name="gioi_tinh">
                                <option value="1"
                                    <?php echo (isset($formData['gioi_tinh']) && $formData['gioi_tinh'] === 'Nam') ? 'selected' : ''; ?>
                                    selected>Nam</option>
                                <option value="0"
                                    <?php echo (isset($formData['gioi_tinh']) && $formData['gioi_tinh'] === 'Nữ') ? 'selected' : ''; ?>>
                                    Nữ</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="sdt">Số điện thoại</label>
                            <input type="number" class="form-control" id="sdt" name="sdt"
                                placeholder="Nhập số điện thoại"
                                value="<?php echo isset($formData['sdt']) ? htmlspecialchars($formData['sdt']) : ''; ?>">
                        </div>
                        <div class="col-6">
                            <label for="ngay_sinh">Ngày sinh (<span class="text-danger">*</span>)</label>
                            <input type="date" class="form-control" id="ngay_sinh" name="ngay_sinh"
                                max="<?php echo date('Y-m-d', strtotime('-5 years')); ?>"
                                value="<?php echo isset($formData['ngay_sinh']) ? htmlspecialchars($formData['ngay_sinh']) : ''; ?>">
                            <?php if (isset($messages['ngay_sinh'])): ?>
                            <small
                                class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['ngay_sinh']) ?></small>
                            <?php endif; ?>
                        </div>
                        <div class="col-6">
                            <label for="role">Quyền</label>
                            <select class="form-select" id="role" name="role">
                                <option value="1">Admin</option>
                                <option value="2">Nhân viên</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="status">Trạng thái</label>
                            <select class="form-select" id="status" name="status">
                                <option value="1">Online</option>
                                <option value="0">Offline</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="avatar">Chọn ảnh</label>
                        <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*"
                            onchange="previewImageAdd(event)">
                    </div>
                    <div class="form-group d-flex justify-content-center mb-3">
                        <img id="preview" src="#" alt="Ảnh xem trước" class="img-fluid"
                            style="display:none; max-width: 100%; max-height: 15rem;" />
                    </div>
                </div>
            </div>
            <button type="submit" name="saveUser" class="btn bg-gradient-info px-5 mt-3">Lưu</button>
        </form>
    </div>
</div>

<?php include('../../includes/footer.php'); ?>
