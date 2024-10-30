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
$item = getByID('Ghe', 'MaGhe', check_valid_ID('id'));
if ($item['status'] == 200) {
?>
<div class="row">
    <div class="col-xl-12 col-lg-12 mx-auto">
        <h2><?= $title ?></h2>
        <!-- Nút quay lại nằm sát bên phải -->
        <div class="text-end mb-4">
            <a class="btn btn-info" href="chair-edit.php?id=<?= $id_result; ?>"><i class="bi bi-pencil me-2"></i>Sửa</a>
            <a class="btn btn-secondary" href="../../chair.php">
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
                            <label class="fs-6">Mã ghế:</label>
                            <span><?= $item['data']['MaGhe']; ?></span>
                        </div>
                        <div class="mb-3">
                            <label class="fs-6">Tên ghế:</label>
                            <span><?= $item['data']['TenGhe']; ?></span>
                        </div>
                        <div class="mb-3">
                            <label class="fs-6">Tên phòng:</label>
                            <span><?= $item['data']['TenPhong']; ?></span>
                        </div>
                        <div class="mb-3">
                            <label class="fs-6">Loại ghế:</label>
                            <span><?= $item['data']['LoaiGhe']; ?></span>
                        </div>
                        <div class="mb-3">
                            <label class="fs-6">Giá ghế:</label>
                            <span><?= number_format($item['data']['GiaGhe']); ?> VNĐ</span>
                        </div>
                    </div>

                    <!-- Cột 2 -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="fs-6">Người tạo:</label>
                            <span><?= $item['data']['NguoiTao']; ?></span>
                        </div>
                        <div class="mb-3">
                            <label class="fs-6">Ngày tạo:</label>
                            <span><?= $item['data']['NgayTao']; ?></span>
                        </div>
                        <div class="mb-3">
                            <label class="fs-6">Người cập nhật:</label>
                            <span><?= $item['data']['NguoiCapNhat']; ?></span>
                        </div>
                        <div class="mb-3">
                            <label class="fs-6">Ngày cập nhật:</label>
                            <span><?= $item['data']['NgayCapNhat']; ?></span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <?php
} else {
    echo '<h5>' . $item['message'] . '</h5>';
}
    ?>

    <?php include('../../includes/footer.php'); ?>
