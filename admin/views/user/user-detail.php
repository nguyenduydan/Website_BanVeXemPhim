<?php

require '../../../config/function.php';
include('../../includes/header.php');

// Kiểm tra xem người dùng đã đăng nhập chưa, nếu chưa thì chuyển hướng đến trang đăng nhập
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    redirect('sign-in.php', 'error', 'Vui lòng đăng nhập');
}
if (isset($_SESSION['EmployedIn']) && $_SESSION['EmployedIn'] === true) {
    redirect('index.php', 'error', 'Bạn không phải admin!', 'admin');
}
?>

<div id="toast">
</div>
<?php
// Kiểm tra ID hợp lệ của người dùng từ URL
$id_result = check_valid_ID('id');
if (!is_numeric($id_result)) {
    echo '<h5>' . $id_result . '</h5>';
    return false;
}

// Lấy thông tin người dùng và tài khoản từ cơ sở dữ liệu dựa trên ID
$user = getByID('NguoiDung', 'MaND', check_valid_ID('id'));
$taikhoan = getByID('TaiKhoan', 'MaND', check_valid_ID('id'));

if ($user['status'] == 200) { // Kiểm tra xem có lấy thành công thông tin người dùng không
?>
<div class="row">
    <div class="col-xl-12 col-lg-12 mx-auto">
        <h2><?= $title ?></h2>

        <!-- Nút sửa và quay lại -->
        <div class="text-end mb-4">
            <a class="btn btn-info" href="user-edit.php?id=<?= $id_result; ?>"><i class="bi bi-pencil me-2"></i>Sửa</a>
            <a class="btn btn-secondary" href="../../user.php">Quay lại</a>
        </div>

        <!-- Thông tin chi tiết người dùng -->
        <div class="card">
            <div class="card-body">
                <div class="row fs-6">
                    <!-- Cột 1 chứa các thông tin cá nhân -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="fs-6">Mã ND:</label>
                            <span><?= $user['data']['MaND']; ?></span>
                        </div>
                        <div class="mb-3">
                            <label class="fs-6">Họ và tên:</label>
                            <span><?= $user['data']['TenND']; ?></span>
                        </div>
                        <div class="mb-3">
                            <label class="fs-6">Tên đăng nhập:</label>
                            <span><?= $taikhoan['data']['TenDangNhap']; ?></span>
                        </div>
                        <div class="mb-3">
                            <label class="fs-6">Ngày sinh:</label>
                            <span><?= date('d/m/Y', strtotime($user['data']['NgaySinh'])); ?></span>
                        </div>
                        <div class="mb-3">
                            <label class="fs-6">Giới tính:</label>
                            <span><?= $user['data']['GioiTinh'] == 1 ? 'Nam' : 'Nữ'; ?></span>
                        </div>
                        <div class="mb-3">
                            <label class="fs-6">Số điện thoại:</label>
                            <span><?= $user['data']['SDT']; ?></span>
                        </div>
                        <div class="mb-3">
                            <label class="fs-6">Email:</label>
                            <span><?= $user['data']['Email']; ?></span>
                        </div>
                    </div>

                    <!-- Cột 2 chứa thông tin tạo và cập nhật tài khoản -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="fs-6">Người tạo:</label>
                            <span><?= $admin['data']['TenND'] ?></span>
                        </div>
                        <div class="mb-3">
                            <label class="fs-6">Ngày tạo:</label>
                            <span><?= $user['data']['NgayTao']; ?></span>
                        </div>
                        <div class="mb-3">
                            <label class="fs-6">Người cập nhật:</label>
                            <span><?= $admin['data']['TenND'] ?></span>
                        </div>
                        <div class="mb-3">
                            <label class="fs-6">Ngày cập nhật:</label>
                            <span><?= $user['data']['NgayCapNhat']; ?></span>
                        </div>
                        <div class="form-group mb-3">
                            <!-- Ảnh đại diện người dùng -->
                            <img id="preview"
                                src="<?php echo isset($user['data']['Anh']) ? '../../../uploads/avatars/' . htmlspecialchars($user['data']['Anh']) : '#'; ?>"
                                alt="Ảnh xem trước" class="img-fluid"
                                style="display: <?php echo isset($user['data']['Anh']) ? 'block' : 'none'; ?>; max-width: 100%; max-height: 150px;" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
} else {
    // Hiển thị thông báo nếu không lấy được thông tin người dùng
    echo '<h5>' . $user['message'] . '</h5>';
}
    ?>

    <?php include('../../includes/footer.php'); ?>
