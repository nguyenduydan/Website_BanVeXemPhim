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
            <a class="btn btn-secondary" href="../../menu.php">
                Quay lại
            </a>
        </div>
        <form id="addMenuForm" action="../../controllers/menu-controller.php" method="post"
            enctype="multipart/form-data">
            <div class="row">
                <!-- Cột -->
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="tenmenu">Tên Menu (<span class="text-danger">*</span>)</label>
                        <input type="text" class="form-control" id="tenmenu" name="tenmenu" placeholder="Nhập tên menu"
                            value="<?php echo isset($formData['tenmenu']) ? htmlspecialchars($formData['tenmenu']) : ''; ?>">
                        <?php if (isset($messages['tenmenu'])): ?>
                        <small class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['tenmenu']) ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="kieumenu">Kiểu Menu (<span class="text-danger">*</span>)</label>
                        <input type="text" class="form-control" id="kieumenu" name="kieumenu"
                            placeholder="Nhập kiểu menu"
                            value="<?php echo isset($formData['kieumenu']) ? htmlspecialchars($formData['kieumenu']) : ''; ?>">
                        <?php if (isset($messages['kieumenu'])): ?>
                        <small class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['kieumenu']) ?></small>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="vitri">Vị Trí (<span class="text-danger">*</span>)</label>
                        <input type="text" class="form-control" id="vitri" name="vitri" placeholder="Nhập vị trí"
                            value="<?php echo isset($formData['vitri']) ? htmlspecialchars($formData['vitri']) : ''; ?>">
                        <?php if (isset($messages['vitri'])): ?>
                        <small class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['vitri']) ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="lienket">Liên Kết (<span class="text-danger">*</span>)</label>
                        <input type="text" class="form-control" id="lienket" name="lienket" placeholder="Nhập liên kết"
                            value="<?php echo isset($formData['lienket']) ? htmlspecialchars($formData['lienket']) : ''; ?>">
                        <?php if (isset($messages['lienket'])): ?>
                        <small class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['lienket']) ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="ordermenu">Thứ Tự</label>
                        <input type="number" class="form-control" id="ordermenu" name="ordermenu"
                            placeholder="Nhập thứ tự"
                            value="<?php echo isset($formData['ordermenu']) ? htmlspecialchars($formData['ordermenu']) : ''; ?>">
                    </div>
                    <div class="form-group mb-3">
                        <label for="status">Trạng thái</label>
                        <select class="form-select" id="status" name="status">
                            <option value="1">Online</option>
                            <option value="0">Offline</option>
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" name="saveMenu" class="btn bg-gradient-info px-5 mt-3">Lưu</button>
        </form>
    </div>
</div>

<?php include('../../includes/footer.php'); ?>
