<?php include('includes/header.php'); ?>

<div id="formErrors" class="alert alert-danger" style="display:none;"></div>
<div class="row">
    <div class="col-xl-12 col-lg-12 mx-auto">
        <h2><?php echo $title ?></h2>
        <!-- Nút quay lại nằm sát bên phải -->
        <div class="text-end mb-4">
            <a class="btn btn-secondary" href="javascript:window.history.back(-1);"><i class="bi bi-arrow-left-short"></i> Quay lại</a>
        </div>
        <form id="addUserForm" action="../admin/controllers/code.php" method="post">
            <div class="row">
                <!-- Cột 1 -->
                <div class="col-md-6">
                    <!-- Nhập tên người dùng -->
                    <div class="form-group mb-3">
                        <label for="name"> Họ và tên người dùng</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nhập họ và tên" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="username">Tên người dùng</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Nhập tên đăng nhập" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">Mật khẩu</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="re_password">Nhập lại mật khẩu</label>
                        <input type="password" class="form-control" id="re_password" name="re_password" placeholder="Nhập lại mật khẩu" required>
                    </div>

                    <!-- Dropdown giới tính-->
                    <div class="form-group mb-3">
                        <label for="gioi_tinh">Giới tính</label>
                        <select class="form-control" id="gioi_tinh" name="gioi_tinh" required>
                            <option value="Active">Nam</option>
                            <option value="Inactive">Nữ</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="sdt">Số điện thoại</label>
                        <input type="number" class="form-control" id="sdt" name="sdt" placeholder="Nhập số điện thoại" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email" required>
                    </div>
                </div>
                <!-- Cột 2 -->
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="ngay_sinh">Ngày sinh</label>
                        <input type="date" class="form-control" id="ngay_sinh" name="ngay_sinh" placeholder="Nhập ngày sinh" required>
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
                    <!-- Hiển thị ảnh đã chọn -->
                    <div class="form-group mb-3">
                        <img id="preview" src="#" alt="Ảnh xem trước" class="img-fluid" style="display:none; max-width: 100%; max-height: 220px;" />
                    </div>
                </div>
            </div>
            <!-- Nút submit -->
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
