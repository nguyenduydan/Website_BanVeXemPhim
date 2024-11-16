<?php
require '../../../config/function.php';  // Kết nối tới tệp chứa các hàm cơ bản
include('../../includes/header.php'); // Thêm header trang
// Kiểm tra đăng nhập
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    redirect('sign-in.php', 'error', 'Vui lòng đăng nhập');
}
if (isset($_SESSION['EmployedIn']) && $_SESSION['EmployedIn'] === true) {
    redirect('index.php', 'error', 'Bạn không phải admin!','admin'); 
}
// Lấy dữ liệu lỗi và dữ liệu form từ session (nếu có) và xóa chúng khỏi session sau khi hiển thị
$messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : [];
$formData = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];
unset($_SESSION['messages']);
unset($_SESSION['form_data']);
?>

<div id="toast"></div>
<?php alertMessage() // Hiển thị thông báo lỗi hoặc thành công từ session 
?>

<div class="row">
    <div class="col-xl-12 col-lg-12 mx-auto">
        <h2><?= $title ?></h2>
        <div class="text-end mb-4">
            <a class="btn btn-secondary" href="../../user.php">Quay lại</a>
        </div>
        <form id="addUserForm" action="../../controllers/user-controller.php" method="post"
            enctype="multipart/form-data">
            <?php
            // Kiểm tra ID hợp lệ của người dùng từ URL
            $id_result = check_valid_ID('id');
            if (!is_numeric($id_result)) {
                echo '<h5>' . $id_result . '</h5>';
                return false;
            }

            // Lấy thông tin người dùng từ cơ sở dữ liệu dựa trên ID
            $user = getByID('nguoidung', 'MaND', check_valid_ID('id'));
            if ($user['status'] == 200) { // Kiểm tra xem có lấy thành công thông tin người dùng không
            ?>
                <input type="hidden" name="mand" value=<?= $user['data']['MaND'] ?>>

                <!-- Thông tin người dùng (Cột 1) -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="name">Họ và tên người dùng(<span class="text-danger">*</span>)</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="<?= $user['data']['TenND']; ?>" placeholder="Nhập họ và tên"
                                value="<?php echo isset($formData['name']) ? htmlspecialchars($formData['name']) : $user['data']['TenND']; ?>">
                            <?php if (isset($messages['name'])): ?>
                                <small class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['name']) ?></small>
                            <?php endif; ?>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email (<span class="text-danger">*</span>)</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="<?= $user['data']['Email']; ?>" placeholder="Nhập email"
                                value="<?php echo isset($formData['email']) ? htmlspecialchars($formData['email']) :$user['data']['Email']; ?>">
                            <?php if (isset($messages['email'])): ?>
                                <small class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['email']) ?></small>
                            <?php endif; ?>
                        </div>
                        <div class="form-group row mb-3">
                            <div class="col-6">
                                <label for="gioi_tinh">Giới tính</label>
                                <select class="form-select" id="gioi_tinh" name="gioi_tinh">
                                    <option value="1"
                                        <?php echo (isset($formData['gioi_tinh']) && $formData['gioi_tinh'] == '1') ? 'selected' : ($user['data']['GioiTinh'] == '1' ? 'selected' : ''); ?>>
                                        Nam</option>
                                    <option value="0"
                                        <?php echo (isset($formData['gioi_tinh']) && $formData['gioi_tinh'] == '0') ? 'selected' : ($user['data']['GioiTinh'] == '0' ? 'selected' : ''); ?>>
                                        Nữ</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="ngay_sinh">Ngày sinh (<span class="text-danger">*</span>)</label>
                                <input type="date" class="form-control" id="ngay_sinh"
                                    max="<?php echo date('Y-m-d', strtotime('-5 years')); ?>"
                                    value="<?= isset($user['data']['NgaySinh']) ? htmlspecialchars($user['data']['NgaySinh']) : ''; ?>"
                                    name="ngay_sinh">
                            </div>
                        </div>
                    </div>

                    <!-- Thông tin người dùng (Cột 2) -->
                    <div class="col-md-6">
                        <div class="form-group row mb-3">
                            <div class="col-6">
                                <label for="sdt">Số điện thoại</label>
                                <input type="number" class="form-control" id="sdt" name="sdt"
                                    value="<?= $user['data']['SDT']; ?>" placeholder="Nhập số điện thoại"
                                    value="<?php echo isset($formData['sdt']) ? htmlspecialchars($formData['sdt']) : $user['data']['SDT']; ?>">
                            </div>
                            <div class="col-6">
                                <label for="status">Trạng thái</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="1" <?= $user['data']['TrangThai'] == 1 ? 'selected' : ''; ?>>Online
                                    </option>
                                    <option value="0" <?= $user['data']['TrangThai'] == 0 ? 'selected' : ''; ?>>Offline
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="avatar">Chọn ảnh</label>
                            <input type="file" class="form-control" id="avatar" value="<?= $user['data']['Anh']; ?>"
                                name="avatar" accept="image/*" onchange="previewImage(event)">
                        </div>
                        <div class="form-group d-flex justify-content-center mb-3">
                            <img id="preview" src="#" alt="Ảnh xem trước" class="img-fluid"
                                style="display:none; max-width: 100%; max-height: 15rem;" />
                        </div>
                    </div>
                </div>
            <?php
            } else {
                // Hiển thị lỗi nếu không lấy được thông tin người dùng
                echo '<h5>' . $user['message'] . '</h5>';
            }
            ?>
            <button type="submit" name="editUser" class="btn bg-gradient-info px-5 mt-3">Lưu</button>
        </form>
    </div>
</div>
<?php include('../../includes/footer.php'); ?>