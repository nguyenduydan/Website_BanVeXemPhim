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
        <form id="editShowtimeForm" action="../../controllers/showtime-controller.php" method="post">
            <div class="row">
                <!-- Giờ chiếu -->
                <div class="col-md-4 m-auto">
                    <div class="form-group mb-3">
                        <label for="gio_chieu">Giờ chiếu</label>
                        <input type="datetime-local" class="form-control" id="gio_chieu" name="gio_chieu" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="ma_phim">Mã phim</label>
                        <select class="form-control" id="ma_phim" name="ma_phim" required>
                            <option value="">Chọn mã phim</option>
                            <?php
                            // Giả sử bạn có một mảng $films chứa danh sách phim
                            foreach ($films as $film): ?>
                            <option value="<?php echo htmlspecialchars($film['id']); ?>">
                                <?php echo htmlspecialchars($film['ten_phim']); ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" name="editShowtime" class="btn bg-gradient-info px-5 mt-3">Lưu</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include('../../includes/footer.php'); ?>