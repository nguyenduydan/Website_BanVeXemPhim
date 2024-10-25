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
        <!-- Form chỉnh sửa slider -->
        <form id="editSliderForm" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="slider_id" value="<?php //echo $slider['id'];
                                                            ?>">
            <div class="row">
                <!-- Cột 1 -->
                <div class="col-md-6">
                    <!-- Nhập tên slider -->
                    <div class="form-group mb-3">
                        <label for="ten_slider">Tên slider</label>
                        <input type="text" class="form-control" id="ten_slider" name="ten_slider" value="<?php //echo htmlspecialchars($slider['ten_slider']);
                                                                                                            ?>" placeholder="Nhập tên slider" required>
                    </div>

                    <!-- Chọn vị trí của slider -->
                    <div class="form-group mb-3">
                        <label for="vi_tri">Vị trí của slider</label>
                        <select class="form-control" id="vi_tri" name="vi_tri" required>
                            <option value="top" <?php //if ($slider['vi_tri'] == 'top') echo 'selected';
                                                ?>>Top</option>
                            <option value="middle" <?php //if ($slider['vi_tri'] == 'middle') echo 'selected';
                                                    ?>>Middle</option>
                            <option value="bottom" <?php //if ($slider['vi_tri'] == 'bottom') echo 'selected';
                                                    ?>>Bottom</option>
                        </select>
                    </div>
                </div>

                <!-- Cột 2 -->
                <div class="col-md-6">
                    <!-- Chọn ảnh slider -->
                    <div class="form-group mb-3">
                        <label for="anh_slider">Chọn ảnh slider</label>
                        <input type="file" class="form-control" id="anh_slider" name="anh_slider" accept="image/*" onchange="previewImage(event)">
                        <input type="hidden" name="current_image" value="<?php echo htmlspecialchars($slider['anh_slider']); ?>">
                    </div>

                    <!-- Hiển thị ảnh đã chọn -->
                    <div class="form-group mb-3">
                        <img id="preview" src="../uploads/slider-images/<?php echo htmlspecialchars($slider['anh_slider']); ?>" alt="Ảnh xem trước" class="img-fluid" style="max-width: 100%; max-height: 220px;" />
                    </div>
                </div>
            </div>

            <!-- Nút submit -->
            <button type="submit" name="updateSlider" class="btn btn-success w-15 mt-3">Cập nhật</button>
        </form>
    </div>
</div>

<?php include('../../includes/footer.php'); ?>
