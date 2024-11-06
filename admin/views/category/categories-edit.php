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
        <h2><?php echo htmlspecialchars($title); ?></h2>
        <!-- Nút quay lại nằm sát bên phải -->
        <div class="text-end mb-4">
            <a class="btn btn-secondary" href="../../categories.php">
                Quay lại
            </a>
        </div>
        <form id="editCategoryForm" action="../../controllers/category-controller.php" method="post"
            enctype="multipart/form-data">
            <?php
            $id_result = check_valid_ID('id');
            if (!is_numeric($id_result)) {
                echo '<h5>' . $id_result . '</h5>';
                return false;
            }
            $category = getByID('TheLoai', 'MaTheLoai', check_valid_ID('id'));
            if ($category['status'] == 200) {
            ?>
            <input type="hidden" name="matl" value=<?= $category['data']['MaTheLoai'] ?>>
            <div class="row">
                <!-- Cột 1 -->
                <div class="col-md-6 m-auto">
                    <!-- Nhập tên thể loại -->
                    <div class="form-group mb-3">
                        <label for="ten_the_loai">Tên thể loại (<span class="text-danger">*</span>)</label>
                        <input type="text" value="<?php echo isset($formData['ten_the_loai']) ? htmlspecialchars($formData['ten_the_loai']) : $category['data']['TenTheLoai']; ?>"
                            class="form-control" id="ten_the_loai" name="ten_the_loai" placeholder="Nhập tên thể loại">
                        <?php if (isset($messages['ten_the_loai'])): ?>
                        <small class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['ten_the_loai']) ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="status">Chọn vị trí(<span class="text-danger">*</span>)</label>
                            <select name="vitri" class="form-select" readonly>
                            <option value="1" <?= $category['data']['TrangThai'] == 1 ? 'selected' : ''; ?>>Online</option>
                            <option value="0" <?= $category['data']['TrangThai'] == 0 ? 'selected' : ''; ?>>Offline</option>
                            </select>
                    </div>
                    <button type="submit" name="editCategory" class="btn bg-gradient-info px-5 mt-3">Lưu</button>
                </div>
            </div>
            <?php
            } else {
                echo '<h5>' . $category['message'] . '</h5>';
            }
            ?>

        </form>
    </div>
</div>

<?php include('../../includes/footer.php'); ?>