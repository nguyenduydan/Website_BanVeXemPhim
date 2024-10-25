<?php include('../../includes/header.php'); ?>

<div class="row">
    <div class="col-xl-12 col-lg-12 mx-auto">
        <h2><?php echo htmlspecialchars($title); ?></h2>
        <!-- Nút quay lại nằm sát bên phải -->
        <div class="text-end mb-4">
            <a class="btn btn-secondary" href="../../slider.php">
                Quay lại
            </a>
        </div>
        <form id="addSliderForm" action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <!-- Cột 1 -->
                <div class="col-md-6">
                    <!-- Nhập tên slider -->
                    <div class="form-group mb-3">
                        <label for="ten_slider">Tên slider</label>
                        <input type="text" class="form-control" id="ten_slider" name="ten_slider" placeholder="Nhập tên slider" required>
                    </div>

                    <!-- Chọn vị trí của ảnh -->
                    <div class="form-group mb-3">
                        <label for="vi_tri">Vị trí của ảnh</label>
                        <select class="form-control" id="vi_tri" name="vi_tri" required>
                            <option value="top">Top</option>
                            <option value="middle">Middle</option>
                            <option value="bottom">Bottom</option>
                        </select>
                    </div>
                </div>

                <!-- Cột 2 -->
                <div class="col-md-6">
                    <!-- Chọn ảnh slider -->
                    <div class="form-group mb-3">
                        <label for="anh_slider">Chọn ảnh slider</label>
                        <input type="file" class="form-control" id="anh_slider" name="anh_slider" accept="image/*" required onchange="previewImage(event)">
                    </div>

                    <!-- Hiển thị ảnh đã chọn -->
                    <div class="form-group mb-3">
                        <img id="preview" src="#" alt="Ảnh xem trước" class="img-fluid" style="display:none; max-width: 100%; max-height: 220px;" />
                    </div>
                </div>
            </div>

            <!-- Nút submit -->
            <button type="submit" name="saveSlider" class="btn btn-success w-15 mt-3">Lưu</button>
        </form>
    </div>
</div>

<?php include('../../includes/footer.php'); ?>
