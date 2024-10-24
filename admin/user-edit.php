<?php
require '../config/function.php';
include('includes/header.php');

?>

<div id="toast"></div>
<script src="/Website_BanVeXemPhim/assets/js/toast.js"></script>
<?php alertMessage() ?>

<div class="row">
    <div class="col-xl-12 col-lg-12 mx-auto">
        <h2>Cập nhật người dùng</h2>
        <div class="text-end mb-4">
            <a class="btn btn-secondary" href="user.php">Quay lại</a>
        </div>
        <form id="addUserForm" action="../admin/controllers/user-controller.php" method="post" enctype="multipart/form-data">
            <?php
            $id_result = check_valid_ID('id');
            if (!is_numeric($id_result)) {
                echo '<h5>' . $id_result . '</h5>';
                return false;
            }
            $user = getByID('NguoiDung', 'MaND', check_valid_ID('id'));
            if ($user['status'] == 200) {
            ?>
                <input type="hidden" name="mand" value=<?= $user['data']['MaND'] ?>" required>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="name">Họ và tên người dùng</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= $user['data']['TenND']; ?>" placeholder="Nhập họ và tên"
                                value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                        </div>
                        <div class="form-group mb-3">
                            <label for="username">Tên đăng nhập</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?= $user['data']['username']; ?>" placeholder="Nhập tên đăng nhập"
                                value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                        </div>
                        <div class="form-group mb-3">
                            <label for="gioi_tinh">Giới tính</label>
                            <select class="form-control" id="gioi_tinh" name="gioi_tinh">
                                <option value="1" <?php echo (isset($_POST['gioi_tinh']) && $_POST['gioi_tinh'] == '1') ? 'selected' : ($user['data']['GioiTinh'] == '1' ? 'selected' : ''); ?>>Nam</option>
                                <option value="0" <?php echo (isset($_POST['gioi_tinh']) && $_POST['gioi_tinh'] == '0') ? 'selected' : ($user['data']['GioiTinh'] == '0' ? 'selected' : ''); ?>>Nữ</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="sdt">Số điện thoại</label>
                            <input type="number" class="form-control" id="sdt" name="sdt" value="<?= $user['data']['SDT']; ?>" placeholder="Nhập số điện thoại"
                                value="<?php echo isset($_POST['sdt']) ? htmlspecialchars($_POST['sdt']) : ''; ?>">
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= $user['data']['Email']; ?>" placeholder="Nhập email"
                                value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="ngay_sinh">Ngày sinh</label>
                            <input type="date" class="form-control" id="ngay_sinh"
                                value="<?= isset($user['data']['NgaySinh']) ? htmlspecialchars($user['data']['NgaySinh']) : ''; ?>"
                                name="ngay_sinh" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="role">Vai trò</label>
                            <select class="form-control" id="role" name="role" required>
                                <option value="1">Admin</option>
                                <option value="0">User</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="status">Trạng thái</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="1" <?php echo (isset($_POST['status']) && $_POST['status'] == '1') ? 'selected' : ($user['data']['TrangThai'] == '1' ? 'selected' : ''); ?>>Online</option>
                                <option value="0" <?php echo (isset($_POST['status']) && $_POST['status'] == '0') ? 'selected' : ($user['data']['TrangThai'] == '0' ? 'selected' : ''); ?>>Offline</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="avatar">Chọn ảnh</label>
                            <input type="file" class="form-control" id="avatar" value="<?= $user['data']['Anh']; ?>" name="avatar" accept="image/*" required onchange="previewImage(event)">
                        </div>
                        <div class="form-group mb-3">
                            <img id="preview" src="<?php echo isset($user['data']['Anh']) ? '../uploads/avatars/' . htmlspecialchars($user['data']['Anh']) : '#'; ?>" alt="Ảnh xem trước" class="img-fluid" style="display: <?php echo isset($user['data']['Anh']) ? 'block' : 'none'; ?>; max-width: 100%; max-height: 220px;" />
                        </div>
                    </div>
                </div>
            <?php
            } else {
                echo '<h5>' . $user['message'] . '</h5>';
            }
            ?>
            <button type="submit" name="editUser" class="btn btn-success w-15 mt-3">Lưu</button>
        </form>
    </div>
</div>

<script>
    function previewImage(event) {
        var preview = document.getElementById('preview');
        var file = event.target.files[0];
        var reader = new FileReader();

        reader.onload = function() {
            preview.src = reader.result;
            preview.style.display = 'block';
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = '#';
            preview.style.display = 'none';
        }
    }
</script>

<?php include('includes/footer.php'); ?>
