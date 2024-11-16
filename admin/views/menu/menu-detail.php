<?php

require '../../../config/function.php';
include('../../includes/header.php');
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    redirect('sign-in.php', 'error', 'Vui lòng đăng nhập');
}
if (isset($_SESSION['EmployedIn']) && $_SESSION['EmployedIn'] === true) {
    redirect('index.php', 'error', 'Bạn không phải admin!','admin'); 
}
?>

<div id="toast">
</div>
<?php
$id_result = check_valid_ID('id');
if (!is_numeric($id_result)) {
    echo '<h5>' . $id_result . '</h5>';
    return false;
}
$item = getByID('Menu', 'Id', check_valid_ID('id'));
if ($item['status'] == 200) {
?>
<div class="row">
    <div class="col-xl-12 col-lg-12 mx-auto">
        <h2><?= $title ?></h2>
        <!-- Nút quay lại nằm sát bên phải -->
        <div class="text-end mb-4">
            <a class="btn btn-info" href="menu-edit.php?id=<?= $id_result; ?>"><i class="bi bi-pencil me-2"></i>Sửa</a>
            <a class="btn btn-secondary" href="../../menu.php">
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
                            <label class="fs-6">Mã menu: </label>
                            <span><?= $item['data']['Id']; ?></span>
                        </div>
                        <div class="mb-3">
                            <label class="fs-6">Tên menu: </label>
                            <span><?= $item['data']['TenMenu']; ?></span>
                        </div>
                        <div class="mb-3">
                            <label class="fs-6">Liên kết: </label>
                            <span><?= $item['data']['LienKet']; ?></span>
                        </div>
                        <div class="mb-3">
                            <label class="fs-6">Kiểu menu: </label>
                            <span><?= $item['data']['KieuMenu']; ?></span>
                        </div>
                        <div class="mb-3">
                            <label class="fs-6">Vị trí: </label>
                            <span><?= $item['data']['ViTri']; ?></span>
                        </div>
                    </div>

                    <!-- Cột 2 -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="fs-6">Order: </label>
                            <span><?= $item['data']['Order']; ?></span>
                        </div>
                        <div class="mb-3">
                            <label class="fs-6">Người tạo:</label>
                            <span><?=$admin['data']['TenND']?></span>
                        </div>
                        <div class="mb-3">
                            <label class="fs-6">Ngày tạo:</label>
                            <span><?= $item['data']['NgayTao']; ?></span>
                        </div>
                        <div class="mb-3">
                            <label class="fs-6">Người cập nhật:</label>
                            <span><?=$admin['data']['TenND']?></span>
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