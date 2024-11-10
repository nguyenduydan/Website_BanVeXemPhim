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
$item = getByID('BaiViet', 'Id', check_valid_ID('id'));
if ($item['status'] == 200) {
?>
<div class="row">
    <div class="col-xl-12 col-lg-12 mx-auto">
        <h2><?= $title ?></h2>
        <!-- Nút quay lại nằm sát bên phải -->
        <div class="text-end mb-4">
            <a class="btn btn-info" href="content-edit.php?id=<?= $id_result; ?>"><i
                    class="bi bi-pencil me-2"></i>Sửa</a>
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
                            <label class="fs-6">Chủ đề bài viết:</label>
                            <?php
                                $query = "SELECT TENCHUDE FROM CHUDE WHERE Id = {$item['data']['ChuDeBV']}";
                                $result = $conn->query($query);
                                if ($result && $content = $result->fetch_assoc()) {
                                    echo htmlspecialchars($content['TENCHUDE']);
                                } else {
                                    echo "Không tìm thấy tên chủ đề";
                                }
                                ?>
                        </div>
                        <div class="mb-3">
                            <label class="fs-6">Tên bài viết:</label>
                            <span><?= $item['data']['TenBV']; ?></span>
                        </div>
                        <div class="mb-3">
                            <label class="fs-6">Chi tiết bài viết:</label>
                            <span>
                                <?= (strlen($item['data']['ChiTiet']) > 200) ? substr($item['data']['ChiTiet'], 0, 200) . '...' : $item['data']['ChiTiet']; ?>
                            </span>

                        </div>

                        <div class="mb-3">
                            <label class="fs-6">Mô tả:</label>
                            <span><?= $item['data']['MoTa']; ?></span>
                        </div>
                        <div class="mb-3">
                            <label class="fs-6">Kiểu bài viết:</label>
                            <span><?= $item['data']['KieuBV']; ?></span>
                        </div>
                        <div class="form-group mb-3">
                            <?php

                                $anhArray = explode(',', $item['data']['Anh']);


                                foreach ($anhArray as $anh) {

                                    $anh = trim($anh);
                                    echo '<img src="../../../uploads/content-imgs/' . htmlspecialchars($anh) . '" alt="Ảnh xem trước" class="img-fluid mb-2 mx-2" style="max-width: 100%; max-height: 150px;" />';
                                }
                                ?>
                        </div>
                    </div>

                    <!-- Cột 2 -->
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label class="fs-6">Người tạo:</label>
                            <span><?= $admin['data']['TenND'] ?></span>
                        </div>
                        <div class="mb-3">
                            <label class="fs-6">Ngày tạo:</label>
                            <span><?= isset($item['data']['NgayTao']) ? (new DateTime($item['data']['NgayTao']))->format('d/m/y H:i:s') : 'Chưa xác định'; ?></span>

                        </div>
                        <div class="mb-3">
                            <label class="fs-6">Người cập nhật:</label>
                            <span><?= $admin['data']['TenND'] ?></span>
                        </div>
                        <div class="mb-3">
                            <label class="fs-6">Ngày cập nhật:</label>
                            <span><?= isset($item['data']['NgayCapNhat']) ? (new DateTime($item['data']['NgayCapNhat']))->format('d/m/y H:i:s') : 'Chưa xác định'; ?></span>
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
