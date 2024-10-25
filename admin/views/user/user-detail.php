<?php

require '../../../config/function.php';
include('../../includes/header.php');
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
            <h2><?= $title ?></h2>
            <!-- Nút quay lại nằm sát bên phải -->
            <div class="text-end mb-4">
                <a class="btn btn-secondary" href="../../user.php">
                    Quay lại
                </a>
            </div>

            <!-- Thông tin chi tiết phim -->
            <div class="card">
                <div class="card-body">
                    <div class="row fs-6">
                        <!-- Cột 1 -->
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
                                <span><?= $user['data']['username']; ?></span>
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
                            <div class="mb-3">
                                <label class="fs-6">Role:</label>
                                <span><?= $user['data']['Role'] == 1 ? 'Admin' : 'User'; ?></span>
                            </div>
                        </div>

                        <!-- Cột 2 -->
                        <div class="col-md-6">

                            <div class="mb-3">
                                <label class="fs-6">Người tạo:</label>
                                <span><?= $user['data']['NguoiTao']; ?></span>
                            </div>
                            <div class="mb-3">
                                <label class="fs-6">Ngày tạo:</label>
                                <span><?= $user['data']['NgayTao']; ?></span>
                            </div>
                            <div class="mb-3">
                                <label class="fs-6">Người cập nhật:</label>
                                <span><?= $user['data']['NguoiCapNhat']; ?></span>
                            </div>
                            <div class="mb-3">
                                <label class="fs-6">Ngày cập nhật:</label>
                                <span><?= $user['data']['NgayCapNhat']; ?></span>
                            </div>
                            <div class="form-group mb-3">
                                <img id="preview" src="<?php echo isset($user['data']['Anh']) ? '../../../uploads/avatars/' . htmlspecialchars($user['data']['Anh']) : '#'; ?>" alt="Ảnh xem trước" class="img-fluid" style="display: <?php echo isset($user['data']['Anh']) ? 'block' : 'none'; ?>; max-width: 100%; max-height: 150px;" />
                                <!-- Ảnh phim -->
                            </div>
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

    <?php include('../../includes/footer.php'); ?>
