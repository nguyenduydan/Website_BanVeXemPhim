<?php include('includes/header.php'); ?>

<!-- Hiển thị nội dung thêm thể loại phim -->
<div class="row">
    <div class="col-xl-12 col-lg-12 mx-auto">
        <h2>Thêm thể loại phim</h2>

        <!-- Nút quay lại nằm sát bên phải -->
        <a class="btn btn-secondary mb-4" href="categories-list.php" style="float: right;">Quay lại</a>

        <form action="category-add-process.php" method="POST">
            <div class="row">
                <!-- Cột 1: Tên thể loại và trạng thái -->
                <div class="col-md-6">
                    <!-- Nhập tên thể loại -->
                    <div class="form-group mb-3">
                        <label for="ten_the_loai">Tên thể loại</label>
                        <input type="text" class="form-control" id="ten_the_loai" name="ten_the_loai" placeholder="Nhập tên thể loại" required>
                    </div>

                    <!-- Dropdown trạng thái -->
                    <div class="form-group mb-3">
                        <label for="trang_thai">Trạng thái</label>
                        <select class="form-control" id="trang_thai" name="trang_thai" required>
                            <option value="Active">Kích hoạt</option>
                            <option value="Inactive">Không kích hoạt</option>
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
            <button type="submit" class="btn btn-primary">Thêm thể loại</button>
        </form>
    </div>
</div>

<?php include('includes/footer.php'); ?>

