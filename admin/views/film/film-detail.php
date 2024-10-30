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
$item = getByID('Phim', 'MaPhim', check_valid_ID('id'));
if ($item['status'] == 200) {
?>
    <div class="row">
        <div class="col-xl-12 col-lg-12 mx-auto">
            <h2><?= $title ?></h2>
            <div class="text-end mb-4">
                <a class="btn btn-info" href="film-edit.php?id=<?= $id_result; ?>"><i class="bi bi-pencil me-2"></i>Sửa</a>
                <a class="btn btn-secondary" href="../../film.php">
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
                                <label class="fs-6">Mã phim:</label>
                                <span><?= $item['data']['MaPhim']; ?></span>
                            </div>
                            <div class="mb-3">
                                <label class="fs-6">Tên phim:</label>
                                <span>Cuộc Chiến Sinh Tồn</span>
                            </div>
                            <div class="mb-3">
                                <label class="fs-6">Thời lượng:</label>
                                <span>120 phút</span>
                            </div>
                            <div class="mb-3">
                                <label class="fs-6">Quốc gia:</label>
                                <span>Việt Nam</span>
                            </div>
                            <div class="mb-3">
                                <label class="fs-6">Đạo diễn:</label>
                                <span>Nguyễn Văn A</span>
                            </div>
                            <div class="mb-3">
                                <label class="fs-6">Diễn viên:</label>
                                <span>Trần Văn B, Lê Thị C, Phạm Văn D</span>
                            </div>
                            <div class="mb-3">
                                <label class="fs-6">Phân loại:</label>
                                <span>C13</span>
                            </div>
                            <!-- Ảnh phim -->
                            <div class="mb-3">
                                <img src="../../../uploads/film-imgs/curved5-small.jpg" class="img-fluid" alt="Ảnh phim"
                                    style="max-width: 100%; max-height: 300px;">
                            </div>
                        </div>

                        <!-- Cột 2 -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="fs-6">Thể loại:</label>
                                <span>Hành động, Phiêu lưu</span>
                            </div>
                            <div class="mb-3">
                                <label class="fs-6">Người tạo:</label>
                                <span>Nguyễn Văn E</span>
                            </div>
                            <div class="mb-3">
                                <label class="fs-6">Ngày tạo:</label>
                                <span>01/01/2023</span>
                            </div>
                            <div class="mb-3">
                                <label class="fs-6">Người cập nhật:</label>
                                <span>Trần Văn F</span>
                            </div>
                            <div class="mb-3">
                                <label class="fs-6">Ngày cập nhật:</label>
                                <span>01/06/2023</span>
                            </div>
                            <div class="mb-3">
                                <label class="fs-6">Mô tả:</label>
                                <p>Phim nói về cuộc chiến giữa con người và quái vật trong một thế giới hậu tận thế.
                                    Phim nói về cuộc chiến giữa con người và quái vật trong một thế giới hậu tận thế.
                                    Phim nói về cuộc chiến giữa con người và quái vật trong một thế giới hậu tận thế.</p>
                            </div>
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
