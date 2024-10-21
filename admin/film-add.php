<?php include('includes/header.php'); ?>

<!-- Hiển thị nội dung thêm phim -->
<div class="row">
    <div class="col-xl-12 col-lg-12 mx-auto">
        <h1>Thêm phim mới</h1>

        <!-- Nút quay lại căn phải -->
        <div class="text-end mb-4">
            <a class="btn btn-secondary" href="film-list.php">Quay lại</a>
        </div>

        <form action="film-add-process.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <!-- Cột 1: Tên phim, thể loại, mô tả -->
                <div class="col-md-6">
                    <!-- Nhập tên phim -->
                    <div class="form-group mb-3">
                        <label for="ten_phim">Tên phim</label>
                        <input type="text" class="form-control" id="ten_phim" name="ten_phim" placeholder="Nhập tên phim" required>
                    </div>

                    <!-- Chọn thể loại phim bằng checkbox và thêm thể loại mới -->
                    <div class="form-group mb-3">
                        <label for="the_loai">Thể loại</label>
                        <div class="d-flex flex-wrap">
                            <div class="form-check me-3">
                                <input class="form-check-input" type="checkbox" name="the_loai[]" value="Hành động" id="the_loai_hanh_dong">
                                <label class="form-check-label" for="the_loai_hanh_dong">Hành động</label>
                            </div>
                            <div class="form-check me-3">
                                <input class="form-check-input" type="checkbox" name="the_loai[]" value="Tình cảm" id="the_loai_tinh_cam">
                                <label class="form-check-label" for="the_loai_tinh_cam">Tình cảm</label>
                            </div>
                            <div class="form-check me-3">
                                <input class="form-check-input" type="checkbox" name="the_loai[]" value="Kinh dị" id="the_loai_kinh_di">
                                <label class="form-check-label" for="the_loai_kinh_di">Kinh dị</label>
                            </div>
                            <div class="form-check me-3">
                                <input class="form-check-input" type="checkbox" name="the_loai[]" value="Viễn tưởng" id="the_loai_vien_tuong">
                                <label class="form-check-label" for="the_loai_vien_tuong">Viễn tưởng</label>
                            </div>
                            <div class="form-check me-3">
                                <input class="form-check-input" type="checkbox" name="the_loai[]" value="Hài" id="the_loai_hai">
                                <label class="form-check-label" for="the_loai_hai">Hài</label>
                            </div>
                            <!-- Nút thêm thể loại mới chuyển sang trang categories-add.php -->
                            <a href="../admin/categories-add.php" class="btn btn-success btn-sm ms-2">
                                <i class="fas fa-plus"></i> Thêm thể loại
                            </a>
                        </div>
                    </div>

                    <!-- Thêm diễn viên, đạo diễn và quốc gia -->
                    <div class="form-group mb-3">
                        <label for="dien_vien">Diễn viên</label>
                        <input type="text" class="form-control" id="dien_vien" name="dien_vien" placeholder="Nhập tên diễn viên" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="dao_dien">Đạo diễn</label>
                        <input type="text" class="form-control" id="dao_dien" name="dao_dien" placeholder="Nhập tên đạo diễn" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="quoc_gia">Quốc gia</label>
                        <input type="text" class="form-control" id="quoc_gia" name="quoc_gia" placeholder="Nhập quốc gia sản xuất" required>
                    </div>

                    <!-- Nhập mô tả phim -->
                    <div class="form-group mb-3">
                        <label for="mo_ta">Mô tả phim</label>
                        <textarea class="form-control" id="mo_ta" name="mo_ta" rows="10" placeholder="Nhập mô tả phim" required></textarea>
                    </div>


                </div>

                <!-- Cột 2: Ảnh phim -->
                <div class="col-md-6">
                    <!-- Chọn phân loại phim -->
                    <div class="form-group mb-3">
                        <label for="phan_loai">Phân loại</label>
                        <select class="form-control" id="phan_loai" name="phan_loai" required>
                            <option value="P">Phổ thông</option>
                            <option value="C13">C13</option>
                            <option value="C16">C16</option>
                            <option value="C18">C18</option>
                        </select>
                    </div>

                    <!-- Năm phát hành -->
                    <div class="form-group mb-3">
                        <label for="nam_phat_hanh">Năm phát hành</label>
                        <input type="number" class="form-control" id="nam_phat_hanh" name="nam_phat_hanh" placeholder="Nhập năm phát hành" required>
                    </div>

                    <!-- Thời lượng phim -->
                    <div class="form-group mb-3">
                        <label for="thoi_luong">Thời lượng (phút)</label>
                        <input type="number" class="form-control" id="thoi_luong" name="thoi_luong" placeholder="Nhập thời lượng phim" required>
                    </div>

                    <!-- Chọn ảnh phim -->
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
            <input type="hidden" id="id_phim" name="id_phim" value="<?php echo uniqid(); ?>">
            <input type="hidden" id="ngay_tao" name="ngay_tao" value="<?php echo date('Y-m-d H:i:s'); ?>">
            <input type="hidden" id="nguoi_tao" name="nguoi_tao" value="<?php echo $_SESSION['username']; ?>">
            <input type="hidden" id="ngay_chinh_sua" name="ngay_chinh_sua" value="<?php echo date('Y-m-d H:i:s'); ?>">
            <input type="hidden" id="nguoi_chinh_sua" name="nguoi_chinh_sua" value="<?php echo $_SESSION['username']; ?>">

            <!-- Nút submit -->
            <button type="submit" class="btn btn-primary">Thêm phim</button>
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