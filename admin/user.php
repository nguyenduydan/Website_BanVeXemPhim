<?php include('includes/header.php'); ?>

<!-- Hiển thị nội dung danh sách phim -->
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center pb-0">
                <h5><?php echo $title ?></h5>
                <a href="#" class="btn btn-lg me-5 btn-add"
                    data-bs-toggle="modal" data-bs-target="#addUserModal"
                    style="--bs-btn-padding-y: .5rem; --bs-btn-padding-x: 20px; --bs-btn-font-size: 1.25rem;">Thêm</a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mã thể loại</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Thể loại phim</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Người tạo</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Trạng thái</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ngày tạo</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>

                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <li class="page-item"><a class="page-link bg-dark text-light font-weight-bold" href="#">Trước</a></li>
                        <li class="page-item active" aria-current="page"><a class="page-link mx-1" href="#">1</a></li>
                        <li class="page-item"><a class="page-link mx-1" href="#">2</a></li>
                        <li class="page-item"><a class="page-link mx-1" href="#">3</a></li>
                        <li class="page-item"><a class="page-link bg-dark text-light font-weight-bold" href="#">Tiếp</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Modal Thêm người dùng -->
<div class="modal fade" id="addUserModal" style="--bs-modal-width: 60rem" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Thêm người dùng</h5>
                <button type="button" class="btn btn-danger"
                    style="--bs-btn-padding-y: .2rem; --bs-btn-padding-x: .2rem; --bs-btn-font-size: .75rem;"
                    data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                        <path class="text-border" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-xl-12 col-lg-12 mx-auto">
                    <form action="" method="POST">
                        <div class="row">
                            <!-- Cột 1 -->
                            <div class="col-md-6">
                                <!-- Nhập tên người dùng -->
                                <div class="form-group mb-3">
                                    <label for="ten_nguoi_dung">Tên người dùng</label>
                                    <input type="text" class="form-control" id="ten_nguoi_dung" name="ten_nguoi_dung" placeholder="Nhập tên người dùng" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="password">Mật khẩu</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="re_password">Nhập lại mật khẩu</label>
                                    <input type="password" class="form-control" id="e_password" name="e_password" placeholder="Nhập lại mật khẩu" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="ngay_sinh">Ngày sinh</label>
                                    <input type="text" class="form-control" id="ngay_sinh" name="ngay_sinh" placeholder="Nhập ngày sinh" required>
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
                                    <label for="role">Vai trò</label>
                                    <select class="form-control" id="role" name="role" required>
                                        <option value="Active">Admin</option>
                                        <option value="Inactive">User</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="status">Trạng thái</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="Active">Online</option>
                                        <option value="Inactive">Offline</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="anh_phim">Chọn ảnh phim</label>
                                    <input type="file" class="form-control" id="anh_phim" name="anh_phim" accept="image/*" required onchange="previewImage(event)">
                                </div>
                                <!-- Hiển thị ảnh đã chọn -->
                                <div class="form-group mb-3">
                                    <img id="preview" src="#" alt="Ảnh xem trước" style="display:none; max-width: 100%; height: auto;" />
                                </div>
                            </div>
                        </div>


                        <!-- Các trường tự động (Ẩn đi) -->
                        <input type="hidden" id="ma_the_loai" name="ma_nguoi_dung" value="<?php echo uniqid(); ?>">
                        <input type="hidden" id="nguoi_tao" name="nguoi_tao" value="<?php echo $_SESSION['username']; ?>">
                        <input type="hidden" id="ngay_tao" name="ngay_tao" value="<?php echo date('Y-m-d H:i:s'); ?>">
                        <input type="hidden" id="nguoi_cap_nhat" name="nguoi_cap_nhat" value="<?php echo $_SESSION['username']; ?>">
                        <input type="hidden" id="ngay_cap_nhat" name="ngay_cap_nhat" value="<?php echo date('Y-m-d H:i:s'); ?>">
                        <!-- Nút submit -->
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Modal chỉnh sửa thể loại phim-->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel">Sửa thể loại phim</h5>
                <button type="button" class="btn btn-danger"
                    style="--bs-btn-padding-y: .2rem; --bs-btn-padding-x: .2rem; --bs-btn-font-size: .75rem;"
                    data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                        <path class="text-border" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-xl-12 col-lg-12 mx-auto">
                    <form action="" method="POST">
                        <div class="row">
                            <!-- Cột 1: Tên thể loại và trạng thái -->
                            <div class="col-md">
                                <!-- Nhập tên thể loại -->
                                <div class="form-group mb-3">
                                    <label for="ten_the_loai">Tên thể loại</label>
                                    <input type="text" class="form-control" id="ten_the_loai" name="ten_the_loai" placeholder="Nhập tên thể loại" required>
                                </div>

                                <!-- Dropdown trạng thái -->
                                <div class="form-group mb-3">
                                    <label for="trang_thai">Trạng thái</label>
                                    <select class="form-control" id="trang_thai" name="trang_thai" required>
                                        <option value="Active">Hiển thị</option>
                                        <option value="Inactive">Không hiển thị</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Các trường tự động (Ẩn đi) -->
                            <input type="hidden" id="ma_the_loai" name="ma_the_loai" value="<?php echo uniqid(); ?>">
                            <input type="hidden" id="nguoi_tao" name="nguoi_tao" value="<?php echo $_SESSION['username']; ?>">
                            <input type="hidden" id="ngay_tao" name="ngay_tao" value="<?php echo date('Y-m-d H:i:s'); ?>">
                            <input type="hidden" id="nguoi_cap_nhat" name="nguoi_cap_nhat" value="<?php echo $_SESSION['username']; ?>">
                            <input type="hidden" id="ngay_cap_nhat" name="ngay_cap_nhat" value="<?php echo date('Y-m-d H:i:s'); ?>">

                        </div>

                        <!-- Nút submit -->
                        <button type="submit" class="btn btn-primary">Lưu thể loại</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Modal xóa thể loại phim-->
<div class="modal fade" id="delCategoryModal" tabindex="-1" aria-labelledby="delCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delCategoryModalLabel">Xóa thể loại phim</h5>
                <button type="button" class="btn btn-danger"
                    style="--bs-btn-padding-y: .2rem; --bs-btn-padding-x: .2rem; --bs-btn-font-size: .75rem;"
                    data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                        <path class="text-border" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-xl-12 col-lg-12 mx-auto">
                    <form action="" method="POST" class="text-center">
                        <h5 class="my-5">Bạn có đồng ý xóa không?</h5>
                        <div class="d-flex justify-content-center">
                            <button type="button" class="btn btn-danger me-4" data-bs-dismiss="modal" aria-label="Close" style="width: 7rem;">Hủy</button>
                            <button type="submit" class="btn btn-success" style="width: 7rem;">Đồng ý</button>
                        </div>
                        <!-- Nút submit -->
                    </form>
                </div>
            </div>
        </div>
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
