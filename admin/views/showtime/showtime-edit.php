<?php
require '../../../config/function.php';
include('../../includes/header.php');
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    redirect('sign-in.php', 'error', 'Vui lòng đăng nhập');
}
$messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : []; // Lấy lỗi từ session
$formData = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];
unset($_SESSION['messages']); // Xóa lỗi khỏi session sau khi hiển thị
unset($_SESSION['form_data']);
?>
<div id="toast"></div>
<?php alertMessage() ?>
<div class="row">
    <div class="col-xl-12 col-lg-12 mx-auto">
        <h2>Cập nhật suất chiếu</h2>
        <!-- Nút quay lại nằm sát bên phải -->
        <div class="text-end mb-4">
            <a class="btn btn-secondary" href="../../showtime.php">
                Quay lại
            </a>
        </div>

        <!-- Form thêm suất chiếu -->
        <form id="editShowtimeForm" action="../../controllers/showtime-controller.php" method="post">
            <?php
                $id_result = check_valid_ID('id');
                if (!is_numeric($id_result)) {
                    echo '<h5>' . $id_result . '</h5>';
                    return false;
                }
                $sc = getByID('SuatChieu', 'MaSuatChieu', check_valid_ID('id'));
                if ($sc['status'] == 200) {
                ?>
                <input type="hidden" name="masc" value=<?= $sc['data']['MaSuatChieu'] ?>>
                <div class="row">
                <!-- Giờ chiếu -->
                <div class="col-md-4 m-auto">
                    <div class="form-group mb-3">
                        <label for="giochieu">Giờ chiếu</label>
                        <input type="datetime-local" class="form-control" id="giochieu" name="giochieu"
                        value="<?php echo isset($formData['giochieu']) ? htmlspecialchars($formData['giochieu']) : $sc['data']['GioChieu']; ?>" >
                        <?php if (isset($messages['giochieu'])): ?>
                            <small class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['giochieu']) ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="maphim">Tên phim</label>
                        <select class="form-control" id="maphim" name="maphim">
                            <option value="">Chọn tên phim</option>
                            <?php
                            $films = getAll('Phim');
                            foreach ($films as $film): ?>
                                <option value="<?php echo htmlspecialchars($film['MaPhim']); ?>"
                                <?php echo (isset($formData['maphim']) && $formData['maphim'] == $film['MaPhim']) ||
                                (!isset($formData['maphim']) && $sc['data']['MaPhim'] == $film['MaPhim']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($film['TenPhim']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (isset($messages['maphim'])): ?>
                            <small class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['maphim']) ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="status">Trạng thái</label>
                        <select class="form-select" id="status" name="status">
                        <option value="1" <?= $sc['data']['TrangThai'] == 1 ? 'selected' : ''; ?>>Online</option>
                        <option value="0" <?= $sc['data']['TrangThai'] == 0 ? 'selected' : ''; ?>>Offline</option>
                        </select>
                    </div>

                    <button type="submit" name="savesc" class="btn bg-gradient-info px-5 mt-3">Lưu</button>
                </div>
            </div>
            <?php
            } else {
                echo '<h5>' . $sc['message'] . '</h5>';
            }
            ?>
            </form>
    </div>
</div>

<?php include('../../includes/footer.php'); ?>