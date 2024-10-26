<?php
require '../../../config/function.php';
include('../../includes/header.php');

$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : []; // Lấy lỗi từ session
unset($_SESSION['errors']); // Xóa lỗi khỏi session sau khi hiển thị

?>

<div id="toast"></div>
<?php alertMessage() ?>

<div class="row">
    <div class="col-xl-12 col-lg-12 mx-auto">
        <h2><?php echo $title ?></h2>
        <div class="text-end mb-4">
            <a class="btn btn-secondary" href="../../user.php">Quay lại</a>
        </div>
        <form id="addUserForm" action="../../controllers/user-controller.php" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="name">Họ và tên người dùng (<span class="text-danger">*</span>)</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nhập họ và tên"
                            value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                        <?php if (isset($errors['name'])): ?>
                            <small class="text-danger m-2 text-xs"><?= htmlspecialchars($errors['name']) ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="username">Tên người dùng (<span class="text-danger">*</span>)</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Nhập tên đăng nhập"
                            value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                        <?php if (isset($errors['username'])): ?>
                            <small class="text-danger m-2 text-xs"><?= htmlspecialchars($errors['username']) ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">Mật khẩu (<span class="text-danger">*</span>)</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu">
                            <span class="input-group-text iconEye" id="password-addon" style="cursor: pointer;">
                                <i class="fas fa-eye-slash " id="togglePassword"></i>
                            </span>
                        </div>
                        <?php if (isset($errors['password'])): ?>
                            <small class="text-danger m-2 text-xs"><?= htmlspecialchars($errors['password']) ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="re_password">Nhập lại mật khẩu (<span class="text-danger">*</span>)</label>
                        <input type="password" class="form-control" id="re_password" name="re_password" placeholder="Nhập lại mật khẩu">
                        <?php if (isset($errors['re_password'])): ?>
                            <small class="text-danger m-2 text-xs"><?= htmlspecialchars($errors['re_password']) ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="gioi_tinh">Giới tính (<span class="text-danger">*</span>)</label>
                        <select class="form-control" id="gioi_tinh" name="gioi_tinh">
                            <option value="1" <?php echo (isset($_POST['gioi_tinh']) && $_POST['gioi_tinh'] === 'Nam') ? 'selected' : ''; ?> selected>Nam</option>
                            <option value="0" <?php echo (isset($_POST['gioi_tinh']) && $_POST['gioi_tinh'] === 'Nữ') ? 'selected' : ''; ?>>Nữ</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="sdt">Số điện thoại</label>
                        <input type="number" class="form-control" id="sdt" name="sdt" placeholder="Nhập số điện thoại"
                            value="<?php echo isset($_POST['sdt']) ? htmlspecialchars($_POST['sdt']) : ''; ?>">
                    </div>
                    <div class="form-group mb-3">
                        <label for="email">Email (<span class="text-danger">*</span>)</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email"
                            value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                        <?php if (isset($errors['email'])): ?>
                            <small class="text-danger m-2 text-xs"><?= htmlspecialchars($errors['email']) ?></small>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="ngay_sinh">Ngày sinh (<span class="text-danger">*</span>)</label>
                        <input type="date" class="form-control" id="ngay_sinh" name="ngay_sinh">
                        <?php if (isset($errors['ngay_sinh'])): ?>
                            <small class="text-danger m-2 text-xs"><?= htmlspecialchars($errors['ngay_sinh']) ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-5 me-6">
                            <label for="role">Vai trò</label>
                            <select class="form-control" id="role" name="role">
                                <option value="1">Admin</option>
                                <option value="0">User</option>
                            </select>

                        </div>
                        <div class="col-5">
                            <label for="status">Trạng thái</label>
                            <select class="form-control" id="status" name="status">
                                <option value="1">Online</option>
                                <option value="0">Offline</option>
                            </select>
                        </div>

                    </div>
                    <div class="form-group mb-3">
                        <label for="avatar">Chọn ảnh</label>
                        <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*" onchange="previewImageAdd(event)">
                    </div>
                    <div class="form-group mb-3">
                        <img id="preview" src="#" alt="Ảnh xem trước" class="img-fluid" style="display:none; max-width: 100%; max-height: 300px;" />
                    </div>
                </div>
            </div>
            <button type="submit" name="saveUser" class="btn btn-success w-15 mt-3">Lưu</button>
        </form>
    </div>
</div>

<?php include('../../includes/footer.php'); ?>
