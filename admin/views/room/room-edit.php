<?php
require '../../../config/function.php';
include('../../includes/header.php');
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    redirect('sign-in.php', 'error', 'Vui lòng đăng nhập');
}
if (isset($_SESSION['EmployedIn']) && $_SESSION['EmployedIn'] === true) {
    redirect('index.php', 'error', 'Bạn không phải admin!','admin'); 
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
        <h2><?php echo htmlspecialchars($title); ?></h2>
        <!-- Nút quay lại nằm sát bên phải -->
        <div class="text-end mb-4">
            <a class="btn btn-secondary" href="../../room.php">
                Quay lại
            </a>
        </div>
        <form id="editRoomForm" action="../../controllers/room-controller.php" method="post">
            <?php
            $id_result = check_valid_ID('id');
            if (!is_numeric($id_result)) {
                echo '<h5>' . $id_result . '</h5>';
                return false;
            }
            $room = getByID('Phong', 'MaPhong', check_valid_ID('id'));
            if ($room['status'] == 200) {
            ?>
                <input type="hidden" name="maphong" value=<?= $room['data']['MaPhong'] ?>>
                <div class="row">
                    <!-- Cột -->
                    <div class="col-md-4 m-auto">
                        <!-- Nhập tên phòng -->
                        <div class="form-group mb-3">
                            <label for="ten_phong">Tên phòng(<span class="text-danger">*</span>)</label>
                            <input type="text"
                                value="<?php echo isset($formData['ten_phong']) ? htmlspecialchars($formData['ten_phong']) : $room['data']['TenPhong']; ?>"
                                class="form-control" id="ten_phong" name="ten_phong" placeholder="Nhập tên phòng">
                            <?php if (isset($messages['ten_phong'])): ?>
                                <small class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['ten_phong']) ?></small>
                            <?php endif; ?>
                        </div>
                        <div class="form-group mb-3">
                            <label for="status">Trạng thái</label>
                            <select class="form-select" id="status" name="status">
                                <option value="1" <?= $room['data']['TrangThai'] == 1 ? 'selected' : ''; ?>>Online</option>
                                <option value="0" <?= $room['data']['TrangThai'] == 0 ? 'selected' : ''; ?>>Offline</option>
                            </select>
                        </div>
                        <button type="submit" name="editRoom" class="btn bg-gradient-info px-5 mt-3">Lưu</button>
                    </div>
                </div>
            <?php
            } else {
                echo '<h5>' . $room['message'] . '</h5>';
            }
            ?>
        </form>
    </div>
</div>

<?php include('../../includes/footer.php'); ?>
