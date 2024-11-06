<?php

require '../../../config/function.php';
include('../../includes/header.php');
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    redirect('sign-in.php', 'error', 'Vui lòng đăng nhập');
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
$item = getByID('Chude', 'Id', check_valid_ID('id'));
if ($item['status'] == 200) {
?>
<div class="row">
    <div class="col-xl-12 col-lg-12 mx-auto">
        <h2><?= $title ?></h2>
        <!-- Nút quay lại nằm sát bên phải -->
        <div class="text-end mb-4">
            <a class="btn btn-info" href="topic-edit.php?id=<?= $id_result; ?>"><i class="bi bi-pencil me-2"></i>Sửa</a>
            <a class="btn btn-secondary" href="../../topic.php">
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
                            <label class="fs-6">Mã chủ đề: </label>
                            <span><?= $item['data']['Id']; ?></span>
                        </div>
                        <div class="mb-3">
                            <?php
                                global $conn;
                                $tenphim = ""; // Khởi tạo biến $tenphim
                                $query = "SELECT PHIM.TENPHIM
                                        FROM CHUDE
                                        JOIN PHIM ON PHIM.MAPHIM = CHUDE.MAPHIM
                                        WHERE PHIM.MAPHIM = {$item['data']['MaPhim']}
                                        GROUP BY PHIM.MAPHIM";

                                $result = $conn->query($query);

                                // Kiểm tra xem có kết quả trả về không
                                if ($result && $result->num_rows > 0) {
                                    // Lấy tên phim từ kết quả
                                    $row = $result->fetch_assoc();
                                    $tenphim = $row['TENPHIM']; // Gán tên phim vào biến $tenphim
                                }
                                ?>
                            <label class="fs-6">Phim: </label>
                            <span><?= $tenphim; ?></span>
                        </div>
                        <div class="mb-3">
                            <label class="fs-6">Tên chủ đề: </label>
                            <span><?= $item['data']['TenChuDe']; ?></span>
                        </div>
                        <div class="mb-3">
                            <label class="fs-6">Từ khóa: </label>
                            <span><?= $item['data']['TuKhoa']; ?></span>
                        </div>
                        <div class="mb-3">
                            <label class="fs-6">Tên rút gọn: </label>
                            <span><?= $item['data']['TenRutGon']; ?></span>
                        </div>
                    </div>

                    <!-- Cột 2 -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="fs-6">Mô tả: </label>
                            <span><?= $item['data']['MoTa']; ?></span>
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
