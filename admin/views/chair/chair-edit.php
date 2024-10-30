<?php
require '../../../config/function.php';
include('../../includes/header.php');
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : []; // Lấy lỗi từ session
$formData = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];
unset($_SESSION['errors']); // Xóa lỗi khỏi session sau khi hiển thị
unset($_SESSION['form_data']);
?>
<div id="toast"></div>
<?php alertMessage() ?>

<div class="row">
    <div class="col-xl-12 col-lg-12 mx-auto">
        <h2><?php echo htmlspecialchars($title); ?></h2>
        <!-- Nút quay lại nằm sát bên phải -->
        <div class="text-end mb-4">
            <a class="btn btn-secondary" href="../../chair.php">
                Quay lại
            </a>
        </div>
        <form id="addChairForm" action="../../controllers/chair-controller.php" method="post"
            enctype="multipart/form-data">
            <div class="row">
                <!-- Cột 1 -->
                <div class="col-md-4">
                    <!-- Nhập tên ghế -->
                    <div class="form-group mb-3">
                        <label for="ten_ghe">Tên ghế</label>
                        <input type="text" class="form-control" id="ten_ghe" name="ten_ghe" placeholder="Nhập tên ghế"
                            required>
                    </div>
                </div>

                <!-- Cột 2 -->
                <div class="col-md-4">
                    <!-- Chọn phòng -->
                    <div class="form-group mb-3">
                        <label for="ten_phong">Tên phòng</label>
                        <select class="form-select" id="ten_phong" name="ten_phong" required>
                            <option value="" disabled selected>Chọn phòng</option>
                            <option value="Phòng A">Phòng A</option>
                            <option value="Phòng B">Phòng B</option>
                            <option value="Phòng C">Phòng C</option>
                            <option value="Phòng D">Phòng D</option>
                        </select>
                    </div>
                </div>

                <!-- Cột 3 -->
                <div class="col-md-4">
                    <!-- Chọn loại ghế -->
                    <div class="form-group mb-3">
                        <label for="loai_ghe">Loại ghế</label>
                        <select class="form-select" id="loai_ghe" name="loai_ghe" required>
                            <option value="" disabled selected>Chọn loại ghế</option>
                            <option value="Ghế xoay">Ghế đôi</option>
                            <option value="Ghế cố định">Ghế đơn</option>
                            <option value="Ghế bành">Ghế vip</option>
                        </select>
                    </div>
                </div>
            </div>

            <button type="submit" name="editChair" class="btn bg-gradient-info px-5 mt-3">Lưu</button>
        </form>
    </div>
</div>

<?php include('../../includes/footer.php'); ?>
