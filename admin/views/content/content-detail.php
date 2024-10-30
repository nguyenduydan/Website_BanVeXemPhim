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
$content = getByID('NguoiDung', 'MaND', check_valid_ID('id'));
if ($content['status'] == 200) {
?>
    <div class="row">
        <div class="col-xl-12 col-lg-12 mx-auto">
            <h2><?= $title ?></h2>
            <!-- Nút quay lại nằm sát bên phải -->
            <div class="text-end mb-4">
                <a class="btn btn-info" href="content-edit.php?id=<?= $id_result; ?>"><i class="bi bi-pencil me-2"></i>Sửa</a>
                <a class="btn btn-secondary" href="../../content.php">
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
                                <span><?= $content['data']['MaND']; ?></span>
                            </div>
                            <div class="mb-3">
                                <label class="fs-6">Họ và tên:</label>
                                <span><?= $content['data']['TenND']; ?></span>
                            </div>
                            <div class="mb-3">
                                <label class="fs-6">Tên đăng nhập:</label>
                                <span><?= $content['data']['contentname']; ?></span>
                            </div>
                            <div class="mb-3">
                                <label class="fs-6">Ngày sinh:</label>
                                <span><?= date('d/m/Y', strtotime($content['data']['NgaySinh'])); ?></span>
                            </div>
                            <div class="mb-3">
                                <label class="fs-6">Giới tính:</label>
                                <span><?= $content['data']['GioiTinh'] == 1 ? 'Nam' : 'Nữ'; ?></span>
                            </div>
                            <div class="mb-3">
                                <label class="fs-6">Số điện thoại:</label>
                                <span><?= $content['data']['SDT']; ?></span>
                            </div>
                            <div class="mb-3">
                                <label class="fs-6">Email:</label>
                                <span><?= $content['data']['Email']; ?></span>
                            </div>
                            <div class="mb-3">
                                <label class="fs-6">Role:</label>
                                <span><?= $content['data']['Role'] == 1 ? 'Admin' : 'content'; ?></span>
                            </div>
                        </div>

                        <!-- Cột 2 -->
                        <div class="col-md-6">

                            <div class="mb-3">
                                <label class="fs-6">Người tạo:</label>
                                <span><?= $content['data']['NguoiTao']; ?></span>
                            </div>
                            <div class="mb-3">
                                <label class="fs-6">Ngày tạo:</label>
                                <span><?= $content['data']['NgayTao']; ?></span>
                            </div>
                            <div class="mb-3">
                                <label class="fs-6">Người cập nhật:</label>
                                <span><?= $content['data']['NguoiCapNhat']; ?></span>
                            </div>
                            <div class="mb-3">
                                <label class="fs-6">Ngày cập nhật:</label>
                                <span><?= $content['data']['NgayCapNhat']; ?></span>
                            </div>
                            <div class="form-group mb-3">
                                <img id="preview" src="<?php echo isset($content['data']['Anh']) ? '../../../uploads/avatars/' . htmlspecialchars($content['data']['Anh']) : '#'; ?>" alt="Ảnh xem trước" class="img-fluid" style="display: <?php echo isset($content['data']['Anh']) ? 'block' : 'none'; ?>; max-width: 100%; max-height: 150px;" />
                                <!-- Ảnh phim -->
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    <?php
} else {
    echo '<h5>' . $content['message'] . '</h5>';
}
    ?>

    <?php include('../../includes/footer.php'); ?>
