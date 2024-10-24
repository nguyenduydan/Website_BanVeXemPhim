<?php include('includes/header.php'); ?>

<div class="row">
    <div class="col-xl-12 col-lg-12 mx-auto">
        <h2><?php echo htmlspecialchars($title); ?></h2>
        <!-- Nút quay lại nằm sát bên phải -->
        <div class="text-end mb-4">
            <a class="btn btn-secondary" href="film.php">
                Quay lại
            </a>
        </div>
        <form id="addFilmForm" action="../admin/controllers/code.php" method="post" enctype="multipart/form-data">
            <div class="row">
                <!-- Cột 1 -->
                <div class="col-md-6">
                    <!-- Nhập tên phim -->
                    <div class="form-group mb-3">
                        <label for="ten_phim">Tên phim</label>
                        <input type="text" class="form-control" id="ten_phim" name="ten_phim" placeholder="Nhập tên phim" required>
                    </div>
                    <!-- Nhập đạo diễn -->
                    <div class="form-group mb-3">
                        <label for="dao_dien">Đạo diễn</label>
                        <input type="text" class="form-control" id="dao_dien" name="dao_dien" placeholder="Nhập tên đạo diễn" required>
                    </div>
                    <!-- Nhập diễn viên -->
                    <div class="form-group mb-3">
                        <label for="dien_vien">Diễn viên</label>
                        <input type="text" class="form-control" id="dien_vien" name="dien_vien" placeholder="Nhập tên diễn viên" required>
                    </div>
                    <!-- Nhập quốc gia -->
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

                <!-- Cột 2 -->
                <div class="col-md-6">
                    <!-- Chọn thể loại và thêm thể loại -->
                    <div class="form-group mb-3">
                        <label for="the_loai">Thể loại</label>
                        <div class="d-flex flex-wrap">
                            <?php
                            $genres = ['Hành động', 'Tình cảm', 'Kinh dị', 'Viễn tưởng', 'Hài'];
                            foreach ($genres as $genre): ?>
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="checkbox" name="the_loai[]" value="<?= $genre ?>" id="the_loai_<?= strtolower($genre) ?>">
                                    <label class="form-check-label" for="the_loai_<?= strtolower($genre) ?>"><?= $genre ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <!-- Nút thêm thể loại nằm cạnh -->
                        <div class="mt-3">
                            <a href="../admin/categories.php" class="btn btn-success btn-sm">
                                <i class="fas fa-plus"></i> Thêm thể loại
                            </a>
                        </div>
                    </div>

                    <!-- Phân loại phim bằng dropdown -->
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
                        <img id="preview" src="#" alt="Ảnh xem trước" class="img-fluid" style="display:none; max-width: 100%; max-height: 220px;" />
                    </div>
                </div>
            </div>

            <!-- Nút submit -->
            <button type="submit" name="saveFilm" class="btn btn-success w-15 mt-3">Lưu</button>
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