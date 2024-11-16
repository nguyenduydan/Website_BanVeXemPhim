<?php
require '../../../config/function.php'; // Bao gồm các chức năng từ file function.php
include('../../includes/header.php'); // Bao gồm phần header của trang
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    redirect('sign-in.php', 'error', 'Vui lòng đăng nhập');
}
// Lấy các thông báo lỗi và dữ liệu form từ session, nếu có
$messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : [];
$formData = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];
unset($_SESSION['messages']); // Xóa thông báo lỗi khỏi session sau khi hiển thị
unset($_SESSION['form_data']); // Xóa dữ liệu form khỏi session sau khi hiển thị
?>
<div id="toast"></div>
<?php alertMessage() // Hiển thị thông báo (nếu có) 
?>

<div class="row">
    <div class="col-xl-12 col-lg-12 mx-auto">
        <h2><?php echo htmlspecialchars($title); ?></h2> <!-- Tiêu đề trang -->
        <!-- Nút quay lại nằm sát bên phải -->
        <div class="text-end mb-4">
            <a class="btn btn-secondary" href="../../categories.php">
                Quay lại
            </a>
        </div>
        <!-- Form chỉnh sửa thể loại -->
        <form id="editCategoryForm" action="../../controllers/category-controller.php" method="post"
            enctype="multipart/form-data">
            <?php
            // Kiểm tra tính hợp lệ của ID từ GET request
            $id_result = check_valid_ID('id');
            if (!is_numeric($id_result)) { // Nếu ID không hợp lệ
                echo '<h5>' . $id_result . '</h5>'; // Hiển thị thông báo lỗi
                return false; // Dừng việc thực thi đoạn mã
            }
            // Lấy thông tin thể loại từ cơ sở dữ liệu dựa trên ID
            $category = getByID('theloai', 'MaTheLoai', check_valid_ID('id'));
            if ($category['status'] == 200) { // Nếu thể loại tồn tại trong cơ sở dữ liệu
            ?>
                <!-- Truyền ID thể loại vào trường ẩn để gửi khi form được gửi -->
                <input type="hidden" name="matl" value=<?= $category['data']['MaTheLoai'] ?>>
                <div class="row">
                    <!-- Cột 1: Form nhập tên thể loại và trạng thái -->
                    <div class="col-md-6 m-auto">
                        <!-- Nhập tên thể loại -->
                        <div class="form-group mb-3">
                            <label for="ten_the_loai">Tên thể loại (<span class="text-danger">*</span>)</label>
                            <input type="text"
                                value="<?php echo isset($formData['ten_the_loai']) ? htmlspecialchars($formData['ten_the_loai']) : $category['data']['TenTheLoai']; ?>"
                                class="form-control" id="ten_the_loai" name="ten_the_loai" placeholder="Nhập tên thể loại">
                            <?php if (isset($messages['ten_the_loai'])): ?>
                                <small
                                    class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['ten_the_loai']) ?></small>
                            <?php endif; ?>
                        </div>
                        <!-- Chọn trạng thái thể loại -->
                        <div class="form-group mb-3">
                            <label for="status">Chọn vị trí(<span class="text-danger">*</span>)</label>
                            <select name="vitri" class="form-select" readonly>
                                <!-- Duy trì trạng thái của thể loại (online/offline) -->
                                <option value="1" <?= $category['data']['TrangThai'] == 1 ? 'selected' : ''; ?>>Online
                                </option>
                                <option value="0" <?= $category['data']['TrangThai'] == 0 ? 'selected' : ''; ?>>Offline
                                </option>
                            </select>
                        </div>
                        <!-- Nút lưu -->
                        <button type="submit" name="editCategory" class="btn bg-gradient-info px-5 mt-3">Lưu</button>
                    </div>
                </div>
            <?php
            } else {
                // Nếu không tìm thấy thể loại, hiển thị thông báo lỗi
                echo '<h5>' . $category['message'] . '</h5>';
            }
            ?>

        </form>
    </div>
</div>

<?php include('../../includes/footer.php'); // Bao gồm phần footer của trang 
?>