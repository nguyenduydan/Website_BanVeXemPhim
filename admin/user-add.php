<?php
require '../config/function.php';
include('includes/header.php');

?>

<div id="toast"></div>
<script src="/Website_BanVeXemPhim/assets/js/toast.js"></script>
<?php alertMessage() ?>

<div class="row">
    <div class="col-xl-12 col-lg-12 mx-auto">
        <h2><?php echo htmlspecialchars($title); ?></h2>
        <div class="text-end mb-4">
            <a class="btn btn-secondary" href="user.php">Quay lại</a>
        </div>
        <form id="addUserForm" action="../admin/controllers/user-controller.php" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="name">Họ và tên người dùng</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nhập họ và tên"
                            value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                    </div>
                    <div class="form-group mb-3">
                        <label for="username">Tên người dùng</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Nhập tên đăng nhập"
                            value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">Mật khẩu</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu">
                    </div>
                    <div class="form-group mb-3">
                        <label for="re_password">Nhập lại mật khẩu</label>
                        <input type="password" class="form-control" id="re_password" name="re_password" placeholder="Nhập lại mật khẩu">
                    </div>
                    <div class="form-group mb-3">
                        <label for="gioi_tinh">Giới tính</label>
                        <select class="form-control" id="gioi_tinh" name="gioi_tinh">
                            <option value="Nam" <?php echo (isset($_POST['gioi_tinh']) && $_POST['gioi_tinh'] === 'Nam') ? 'selected' : ''; ?>>Nam</option>
                            <option value="Nữ" <?php echo (isset($_POST['gioi_tinh']) && $_POST['gioi_tinh'] === 'Nữ') ? 'selected' : ''; ?>>Nữ</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="sdt">Số điện thoại</label>
                        <input type="number" class="form-control" id="sdt" name="sdt" placeholder="Nhập số điện thoại"
                            value="<?php echo isset($_POST['sdt']) ? htmlspecialchars($_POST['sdt']) : ''; ?>">
                    </div>
                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email"
                            value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="ngay_sinh">Ngày sinh</label>
                        <input type="date" class="form-control" id="ngay_sinh" name="ngay_sinh" required>
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
                            <option value="1">Online</option>
                            <option value="0">Offline</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="avatar">Chọn ảnh</label>
                        <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*" required onchange="previewImage(event)">
                    </div>
                    <div class="form-group mb-3">
                        <img id="preview" src="#" alt="Ảnh xem trước" class="img-fluid" style="display:none; max-width: 100%; max-height: 220px;" />
                    </div>
                </div>
            </div>
            <button type="submit" name="saveUser" class="btn btn-success w-15 mt-3">Lưu</button>
        </form>
    </div>
</div>

<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('preview');
            output.src = reader.result;
            output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

<?php include('includes/footer.php'); ?>
