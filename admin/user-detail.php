<?php

require '../config/function.php';
include('includes/header.php');

?>

<div id="toast">
</div>
<?php
    $id_result = check_valid_ID('id');
    if (!is_numeric($id_result)) {
        echo '<h5>' . $id_result . '</h5>';
        return false;
    }
    $user = getByID('NguoiDung', 'MaND', check_valid_ID('id'));
    if ($user['status'] == 200) {
        ?>
            <div class="row">
    <div class="col-xl-12 col-lg-12 mx-auto">
        <h2>Chi tiết người dùng</h2>
        <!-- Nút quay lại nằm sát bên phải -->
        <div class="text-end mb-4">
            <a class="btn btn-secondary" href="film.php">
                Quay lại
            </a>
        </div>

        <!-- Thông tin chi tiết phim -->
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <!-- Cột 1 -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <strong>Mã ND:</strong>
                            <p><?= $user['data']['MaND']; ?></p>
                        </div>
                        <div class="mb-3">
                            <strong>Họ và tên:</strong>
                            <p><?= $user['data']['TenND']; ?></p>
                        </div>
                        <div class="mb-3">
                            <strong>Tên đăng nhập:</strong>
                            <p><?= $user['data']['username']; ?></p>
                        </div>
                        <div class="mb-3">
                            <strong>Ngày sinh:</strong>
                            <p><?= date('d/m/Y', strtotime($user['data']['NgaySinh'])); ?></p>
                        </div>
                        <div class="mb-3">
                            <strong>Giới tính:</strong>
                            <p><?= $user['data']['GioiTinh'] == 1 ? 'Nam': 'Nữ'; ?></p>
                        </div>
                        <div class="mb-3">
                            <strong>Số điện thoại:</strong>
                            <p><?= $user['data']['SDT']; ?></p>
                        </div>
                    </div>

                    <!-- Cột 2 -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <strong>Email:</strong>
                            <p><?= $user['data']['Email']; ?></p>
                        </div>
                        <div class="mb-3">
                            <strong>Role:</strong>
                            <p><?= $user['data']['Role'] == 1 ? 'Admin': 'User'; ?></p>
                        </div>
                        <div class="mb-3">
                            <strong>Người tạo:</strong>
                            <p><?= $user['data']['NguoiTao']; ?></p>
                        </div>
                        <div class="mb-3">
                            <strong>Ngày tạo:</strong>
                            <p><?= $user['data']['NgayTao']; ?></p>
                        </div>
                        <div class="mb-3">
                            <strong>Người cập nhật:</strong>
                            <p><?= $user['data']['NguoiCapNhat']; ?></p>
                        </div>
                        <div class="mb-3">
                            <strong>Ngày cập nhật:</strong>
                            <p><?= $user['data']['NgayCapNhat']; ?></p>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                    <img id="preview" src="<?php echo isset($user['data']['Anh']) ? '../uploads/avatars/' . htmlspecialchars($user['data']['Anh']) : '#'; ?>" alt="Ảnh xem trước" class="img-fluid" style="display: <?php echo isset($user['data']['Anh']) ? 'block' : 'none'; ?>; max-width: 100%; max-height: 220px;" />
                    <!-- Ảnh phim -->
                </div>
            </div>
        </div>
    </div>
</div>
        <?php
        } else {
            echo '<h5>' . $user['message'] . '</h5>';
        }
?>

<?php include('includes/footer.php'); ?>