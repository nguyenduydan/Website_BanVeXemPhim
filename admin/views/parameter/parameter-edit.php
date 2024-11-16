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
<div class="row">
    <div class="col-xl-12 col-lg-12 mx-auto">
        <h2>Cập nhật suất chiếu</h2>
        <!-- Nút quay lại nằm sát bên phải -->
        <div class="text-end mb-4">
            <a class="btn btn-secondary" href="../../parameter.php">
                Quay lại
            </a>
        </div>

        <!-- Form thêm suất chiếu -->
        <form id="editParameterForm" action="../../controllers/parameter-controller.php" method="post">
            <?php
                $id_result = check_valid_ID('id');
                if (!is_numeric($id_result)) {
                    echo '<h5>' . $id_result . '</h5>';
                    return false;
                }
                $ts = getByID('ThamSo', 'Id', check_valid_ID('id'));
                if ($ts['status'] == 200) {
                ?>
                <input type="hidden" name="mats" value=<?= $ts['data']['Id'] ?>>
                <div class="row">
                <!-- Cột -->
                <div class="row">
                <!-- Cột -->
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="tenthamso">Tên tham số (<span class="text-danger">*</span>)</label>
                        <input type="text" class="form-control" id="tenthamso" name="tenthamso"
                            placeholder="Nhập tên tham số"
                            value="<?php echo isset($formData['tenthamso']) ? htmlspecialchars($formData['tenthamso']) : $ts['data']['TenThamSo']; ?>">
                        <?php if (isset($messages['tenthamso'])): ?>
                            <small class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['tenthamso']) ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="dvt">Đơn vị tính (<span class="text-danger">*</span>)</label>
                        <input type="text" class="form-control" id="dvt" name="dvt"
                            placeholder="Nhập tên đơn vị tính"
                            value="<?php echo isset($formData['dvt']) ? htmlspecialchars($formData['dvt']) : $ts['data']['DonViTinh']; ?>">
                        <?php if (isset($messages['dvt'])): ?>
                            <small class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['dvt']) ?></small>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="giatri">Giá trị (<span class="text-danger">*</span>)</label>
                        <input type="text" class="form-control" id="giatri" name="giatri" placeholder="Nhập giá trị"
                            value="<?php echo isset($formData['giatri']) ? htmlspecialchars($formData['giatri']) : $ts['data']['GiaTri']; ?>">
                        <?php if (isset($messages['giatri'])): ?>
                            <small class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['giatri']) ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="status">Trạng thái</label>
                        <select class="form-select" id="status" name="status">
                            <option value="1" <?= $ts['data']['TrangThai'] == 1 ? 'selected' : ''; ?>>Online</option>
                            <option value="0" <?= $ts['data']['TrangThai'] == 0 ? 'selected' : ''; ?>>Offline</option>
                        </select>
                    </div>
                </div>
            </div>
            </div>
            <?php
            } else {
                echo '<h5>' . $ts['message'] . '</h5>';
            }
            ?>
             <button type="submit" name="editParameter" class="btn bg-gradient-info px-5 mt-3">Lưu</button>
            </form>
    </div>
</div>

<?php include('../../includes/footer.php'); ?>