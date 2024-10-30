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
        <h2><?= $title ?></h2>
        <div class="text-end mb-4">
            <a class="btn btn-secondary" href="../../content.php">Quay lại</a>
        </div>
        <form id="addcontentForm" action="../../controllers/content-controller.php" method="post" enctype="multipart/form-data">
            <?php
            $id_result = check_valid_ID('id');
            if (!is_numeric($id_result)) {
                echo '<h5>' . $id_result . '</h5>';
                return false;
            }
            $content = getByID('NguoiDung', 'MaND', check_valid_ID('id'));
            if ($content['status'] == 200) {
            ?>
                <input type="hidden" name="mand" value=<?= $content['data']['MaND'] ?>>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="name">Họ và tên người dùng(<span class="text-danger">*</span>)</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= $content['data']['TenND']; ?>" placeholder="Nhập họ và tên"
                                value="<?php echo isset($formData['name']) ? htmlspecialchars($formData['name']) : ''; ?>">
                            <?php if (isset($errors['name'])): ?>
                                <small class="text-danger m-2 text-xs"><?= htmlspecialchars($errors['name']) ?></small>
                            <?php endif; ?>
                        </div>
                        <div class="form-group mb-3">
                            <label for="contentname">Tên đăng nhập (<span class="text-danger">*</span>)</label>
                            <input type="text" class="form-control" id="contentname" name="contentname" value="<?= $content['data']['contentname']; ?>" placeholder="Nhập tên đăng nhập"
                                value="<?php echo isset($formData['contentname']) ? htmlspecialchars($formData['contentname']) : ''; ?>">
                            <?php if (isset($errors['contentname'])): ?>
                                <small class="text-danger m-2 text-xs"><?= htmlspecialchars($errors['contentname']) ?></small>
                            <?php endif; ?>
                        </div>
                        <div class="form-group row mb-3">
                            <div class="col-6">
                                <label for="gioi_tinh">Giới tính</label>
                                <select class="form-select" id="gioi_tinh" name="gioi_tinh">
                                    <option value="1" <?php echo (isset($formData['gioi_tinh']) && $formData['gioi_tinh'] == '1') ? 'selected' : ($content['data']['GioiTinh'] == '1' ? 'selected' : ''); ?>>Nam</option>
                                    <option value="0" <?php echo (isset($formData['gioi_tinh']) && $formData['gioi_tinh'] == '0') ? 'selected' : ($content['data']['GioiTinh'] == '0' ? 'selected' : ''); ?>>Nữ</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="ngay_sinh">Ngày sinh (<span class="text-danger">*</span>)</label>
                                <input type="date" class="form-control" id="ngay_sinh"
                                    value="<?= isset($content['data']['NgaySinh']) ? htmlspecialchars($content['data']['NgaySinh']) : ''; ?>"
                                    name="ngay_sinh">
                            </div>

                        </div>
                        <div class="form-group mb-3">
                            <label for="sdt">Số điện thoại</label>
                            <input type="number" class="form-control" id="sdt" name="sdt" value="<?= $content['data']['SDT']; ?>" placeholder="Nhập số điện thoại"
                                value="<?php echo isset($formData['sdt']) ? htmlspecialchars($formData['sdt']) : ''; ?>">
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email (<span class="text-danger">*</span>)</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= $content['data']['Email']; ?>" placeholder="Nhập email"
                                value="<?php echo isset($formData['email']) ? htmlspecialchars($formData['email']) : ''; ?>">
                            <?php if (isset($errors['email'])): ?>
                                <small class="text-danger m-2 text-xs"><?= htmlspecialchars($errors['email']) ?></small>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row mb-3">
                            <div class="col-6">
                                <label for="role">Vai trò</label>
                                <select class="form-select" id="role" name="role">
                                    <option value="1">Admin</option>
                                    <option value="0">content</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="status">Trạng thái</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="1">Online</option>
                                    <option value="0">Offline</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="avatar">Chọn ảnh</label>
                            <input type="file" class="form-control" id="avatar" value="<?= $content['data']['Anh']; ?>" name="avatar" accept="image/*" onchange="previewImage(event)">
                        </div>
                        <div class="form-group d-flex justify-content-center mb-3">
                            <img id="preview" src="#" alt="Ảnh xem trước" class="img-fluid" style="display:none; max-width: 100%; max-height: 15rem;" />
                        </div>
                    </div>
                </div>
            <?php
            } else {
                echo '<h5>' . $content['message'] . '</h5>';
            }
            ?>
            <button type="submit" name="editcontent" class="btn bg-gradient-info px-5 mt-3">Lưu</button>
        </form>
    </div>
</div>
<?php include('../../includes/footer.php'); ?>
