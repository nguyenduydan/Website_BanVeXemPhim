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
        <h2><?php echo htmlspecialchars($title); ?></h2>
        <!-- Nút quay lại nằm sát bên phải -->
        <div class="text-end mb-4">
            <a class="btn btn-secondary" href="../../room.php">
                Quay lại
            </a>
        </div>
        <form id="editRoomForm" action="../../controllers/room-controller.php" method="post">
            <div class="row">
                <!-- Cột -->
                <div class="col-md-4 m-auto">
                    <!-- Nhập tên phòng -->
                    <div class="form-group mb-3">
                        <label for="ten_phong">Tên phòng</label>
                        <input type="text" class="form-control" id="ten_phong" name="ten_phong"
                            placeholder="Nhập tên phòng" required>
                        <?php if (isset($messages['TenPhong'])): ?>
                        <small class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['TenPhong']) ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="status">Trạng thái</label>
                        <select class="form-select" id="status" name="status">
                            <option value="1">Online</option>
                            <option value="0">Offline</option>
                        </select>
                    </div>
                    <button type="submit" name="editRoom" class="btn bg-gradient-info px-5 mt-3">Lưu</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include('../../includes/footer.php'); ?>