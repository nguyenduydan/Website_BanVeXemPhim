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
            <a class="btn btn-secondary" href="../../menu.php">
                Quay lại
            </a>
        </div>
        <form id="editMenuForm" action="../../controllers/menu-controller.php" method="post"
            enctype="multipart/form-data">
            <?php
            $id_result = check_valid_ID('id');
            if (!is_numeric($id_result)) {
                echo '<h5>' . $id_result . '</h5>';
                return false;
            }
            $item = getByID('Menu', 'Id', check_valid_ID('id'));
            if ($item['status'] == 200) {
            ?>
                <input type="hidden" name="mamenu" value=<?= $item['data']['Id'] ?>>
                <div class="row">
                <!-- Cột -->
                 
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="tenmenu">Tên Menu (<span class="text-danger">*</span>)</label>
                        <input type="text" class="form-control" id="tenmenu" name="tenmenu" placeholder="Nhập tên menu"
                            value="<?php echo isset($formData['tenmenu']) ? htmlspecialchars($formData['tenmenu']) : $item['data']['TenMenu']; ?>" readonly>
                        <?php if (isset($messages['tenmenu'])): ?>
                        <small class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['tenmenu']) ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="kieumenu">Kiểu Menu (<span class="text-danger">*</span>)</label>
                        <input type="text" class="form-control" id="kieumenu" name="kieumenu"
                            placeholder="Nhập kiểu menu"
                            value="<?php echo isset($formData['kieumenu']) ? htmlspecialchars($formData['kieumenu']) : $item['data']['KieuMenu']; ?>" readonly>
                        <?php if (isset($messages['kieumenu'])): ?>
                        <small class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['kieumenu']) ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="status">Trạng thái</label>
                        <div id="status" class="form-control">
                            <?= $item['data']['TrangThai'] == 1 ? 'Online' : 'Offline'; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="status">Chọn vị trí(<span class="text-danger">*</span>)</label>
                                <select name="vitri" class="form-select" readonly>
                                    <option value="header" <?= $item['data']['ViTri'] == 'header' ? 'selected' : ''; ?>>Header</option>
                                    <option value="footer" <?= $item['data']['ViTri'] == 'footer' ? 'selected' : ''; ?>>Footer</option>
                                </select>
                        </div>
                    <div class="form-group mb-3">
                        <label for="lienket">Liên Kết (<span class="text-danger">*</span>)</label>
                        <input type="text" class="form-control" id="lienket" name="lienket" placeholder="Nhập liên kết"
                            value="<?php echo isset($formData['lienket']) ? htmlspecialchars($formData['lienket']) : $item['data']['LienKet']; ?>" readonly>
                        <?php if (isset($messages['lienket'])): ?>
                        <small class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['lienket']) ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="ordermenu">Thứ Tự</label>
                        <input type="number" class="form-control" id="ordermenu" name="ordermenu"
                            placeholder="Nhập thứ tự"
                            value="<?php echo isset($formData['ordermenu']) ? htmlspecialchars($formData['ordermenu']) : $item['data']['Order']; ?>">
                    </div>
                    
                </div>
            </div>
            <?php
            } else {
                echo '<h5>' . $item['message'] . '</h5>';
            }
            ?>
            <!-- Nút submit -->
            <button type="submit" name="editMenu" class="btn bg-gradient-info px-5 mt-3">Lưu</button>
        </form>

    </div>
</div>

<?php include('../../includes/footer.php'); ?>
