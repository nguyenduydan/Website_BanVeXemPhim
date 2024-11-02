<?php
require '../../../config/function.php';
include('../../includes/header.php');

$messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : []; // Lấy lỗi từ session
$formData = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];
unset($_SESSION['messages']); // Xóa lỗi khỏi session sau khi hiển thị
unset($_SESSION['form_data']);
?>
<div id="toast"></div>
<?php alertMessage() ?>
<div class="row">
    <div class="col-xl-12 col-lg-12 mx-auto">
        <h2>Thêm suất chiếu</h2>
        <!-- Nút quay lại nằm sát bên phải -->
        <div class="text-end mb-4">
            <a class="btn btn-secondary" href="../../showtime.php">
                Quay lại
            </a>
        </div>

        <!-- Form thêm suất chiếu -->
        <form id="addShowtimeForm" action="../../controllers/showtime-controller.php" method="post">
            <div class="row">
                <!-- Giờ chiếu -->
                <div class="col-md-4 m-auto">
                    <div class="form-group mb-3">
                        <label for="giochieu">Giờ chiếu</label>
                        <input type="datetime-local" class="form-control" id="giochieu" name="giochieu" 
                        value="<?php echo isset($formData['giochieu']) ? htmlspecialchars($formData['giochieu']) : ''; ?>" >
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
                                    <?php echo (isset($formData['maphim']) && $formData['maphim'] == $film['MaPhim']) ? 'selected' : ''; ?>>
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
                            <option value="1" <?php echo (isset($formData['status']) && $formData['status'] == '1') ? 'selected' : ''; ?>>Online</option>
                            <option value="0" <?php echo (isset($formData['status']) && $formData['status'] == '0') ? 'selected' : ''; ?>>Offline</option>
                        </select>
                    </div>
                    <button type="submit" name="savesc" class="btn bg-gradient-info px-5 mt-3">Lưu</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include('../../includes/footer.php'); ?>
