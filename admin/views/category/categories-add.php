<?php
require '../../../config/function.php'; // Bao gồm file function.php để sử dụng các hàm
include('../../includes/header.php'); // Bao gồm file header của trang
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    redirect('sign-in.php', 'error', 'Vui lòng đăng nhập');
}
// Lấy thông báo lỗi và dữ liệu form từ session nếu có
$messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : []; // Lấy lỗi từ session
$formData = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : []; // Lấy dữ liệu form từ session
unset($_SESSION['messages']); // Xóa lỗi khỏi session sau khi hiển thị
unset($_SESSION['form_data']); // Xóa dữ liệu form khỏi session sau khi hiển thị

?>

<div class="row">
    <div class="col-xl-12 col-lg-12 mx-auto">
        <h2><?php echo htmlspecialchars($title); ?></h2>
        <!-- Nút quay lại nằm sát bên phải -->
        <div class="text-end mb-4">
            <a class="btn btn-secondary" href="../../categories.php">
                Quay lại
            </a>
        </div>
        <form id="addCategoryForm" action="../../controllers/category-controller.php" method="post">
            <div class="row">
                <div class="col-md-6 m-auto">
                    <!-- Nhập tên thể loại -->
                    <div class="form-group mb-3">
                        <label for="ten_the_loai">Tên thể loại (<span class="text-danger">*</span>)</label>
                        <input type="text"
                            value="<?php echo isset($formData['ten_the_loai']) ? htmlspecialchars($formData['ten_the_loai']) : ''; ?>"
                            class="form-control" id="ten_the_loai" name="ten_the_loai" placeholder="Nhập tên thể loại">
                        <?php if (isset($messages['name'])): ?>
                        <small class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['name']) ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="status">Trạng thái</label>
                        <select class="form-select" id="status" name="status">
                            <option value="1">Online</option>
                            <option value="0">Offline</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" name="saveCategory" class="btn bg-gradient-info px-5 mt-3">Lưu</button>
                        <button type="button" class="btn  bg-gradient-primary px-5  mt-3 ms-5" data-bs-toggle="modal"
                            data-bs-target="#importModal">
                            Nhập Thể Loại Từ Excel
                        </button>
                    </div>
                </div>
            </div>
        </form>

        <!-- Modal Nhập File -->
        <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="importModalLabel">Nhập Thể Loại Từ Excel</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" enctype="multipart/form-data"
                            action="../../controllers/category-controller.php">
                            <div class="mb-3">
                                <label for="excel_file" class="form-label">Chọn tệp Excel:</label>
                                <input type="file" class="form-control" name="excel_file" id="excel_file" required>
                            </div>
                            <button type="submit" class="btn btn-success">Nhập</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../../includes/footer.php'); ?>