<?php
require '../../../config/function.php';
include('../../includes/header.php');
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    redirect('sign-in.php', 'error', 'Vui lòng đăng nhập');
}
if (isset($_SESSION['EmployedIn']) && $_SESSION['EmployedIn'] === true) {
    redirect('index.php', 'error', 'Bạn không phải admin!','admin'); 
}
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : []; // Lấy lỗi từ session
$formData = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];
unset($_SESSION['errors']); // Xóa lỗi khỏi session sau khi hiển thị
unset($_SESSION['form_data']);
?>

<div id="toast"></div>
<?php alertMessage() ?>

<div class="row">
    <div class="col-xl-12 col-lg-12 mx-auto">
        <h2><?= $title ?></h2>
        <div class="text-end mb-4">
            <a class="btn btn-secondary" href="../../chair.php">Quay lại</a>
        </div>
        <form id="addChairForm" action="../../controllers/chair-controller.php" method="post" enctype="multipart/form-data">
            <?php
            $id_result = check_valid_ID('id');
            if (!is_numeric($id_result)) {
                echo '<h5>' . $id_result . '</h5>';
                return false;
            }
            $item = getByID('Ghe', 'MaGhe', check_valid_ID('id'));
            if ($item['status'] == 200) {
            ?>
                <input type="hidden" name="maghe" value=<?= $item['data']['MaGhe'] ?>>
                <div class="row">
                    <div class="col-md-6">
                        <label for="tenghe">Tên ghế</label>
                        <input type="text" class="form-control" id="tenghe" name="tenghe" placeholder="Nhập tên ghế"
                            value="<?php echo isset($formData['tenghe']) ? htmlspecialchars($formData['tenghe']) : $item['data']['TenGhe']; ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="loaighe">Loại ghế</label>
                        <select class="form-select" id="loaighe" name="loaighe" required>
                            <option value="" disabled selected>Chọn loại ghế</option>
                            <option value="Đơn" <?= $item['data']['LoaiGhe'] == 'Đơn' ? 'selected' : ''; ?>>Đơn</option>
                            <option value="Đôi" <?= $item['data']['LoaiGhe'] == 'Đôi' ? 'selected' : ''; ?>>Đôi</option>
                            <option value="VIP" <?= $item['data']['LoaiGhe'] == 'VIP' ? 'selected' : ''; ?>>VIP</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="status">Trạng thái</label>
                        <select class="form-select" id="status" name="status">
                            <option value="1" <?= $item['data']['TrangThai'] == 1 ? 'selected' : ''; ?>>Online</option>
                            <option value="0" <?= $item['data']['TrangThai'] == 0 ? 'selected' : ''; ?>>Offline</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="maphong">Tên phòng (<span class="text-danger">*</span>)</label>
                        <select class="form-control" id="maphong" name="maphong" required>
                            <option value="" disabled selected>Chọn phòng</option>
                            <?php
                            $rooms = getAll('Phong');
                            foreach ($rooms as $room): ?>
                                <option value="<?= htmlspecialchars($room['MaPhong']); ?>"
                                    <?= (isset($formData['maphong']) && $formData['maphong'] == $room['MaPhong']) || $item['data']['MaPhong'] == $room['MaPhong'] ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($room['TenPhong']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (isset($messages['maphong'])): ?>
                            <small class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['maphong']) ?></small>
                        <?php endif; ?>
                    </div>
                </div>
            <?php
            } else {
                echo '<h5>' . $content['message'] . '</h5>';
            }
            ?>
            <button type="submit" name="editChair" class="btn bg-gradient-info px-5 mt-3">Lưu</button>
        </form>
    </div>
</div>
<?php include('../../includes/footer.php'); ?>