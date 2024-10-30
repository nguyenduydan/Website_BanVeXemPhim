<?php
require '../../../config/function.php';
include('../../includes/header.php');

$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : []; // Lấy lỗi từ session
unset($_SESSION['errors']); // Xóa lỗi khỏi session sau khi hiển thị

?>

<div class="row">
    <div class="col-xl-12 col-lg-12 mx-auto">
        <h2><?php echo htmlspecialchars($title); ?></h2>
        <!-- Nút quay lại nằm sát bên phải -->
        <div class="text-end mb-4">
            <a class="btn btn-info" href="film-edit.php?id=<?= $id_result; ?>"><i class="bi bi-pencil me-2"></i>Sửa</a>
            <a class="btn btn-secondary" href="../../film.php">
                Quay lại
            </a>
        </div>
        <form id="addFilmForm" action="../../controllers/film-controller.php" method="post"
            enctype="multipart/form-data">
            <div class="row">
                <!-- Cột 1 -->
                <div class="col-md-6">
                    <!-- Nhập tên phim -->
                    <div class="form-group mb-3">
                        <label for="ten_phim">Tên phim</label>
                        <input type="text" class="form-control" id="ten_phim" name="ten_phim"
                            placeholder="Nhập tên phim" required>
                    </div>

                    <!-- Phân loại phim bằng dropdown -->
                    <div class="form-group mb-3">
                        <label for="phan_loai">Phân loại</label>
                        <select class="form-select" id="phan_loai" name="phan_loai" required>
                            <option value="P">Phổ thông</option>
                            <option value="C13">C13</option>
                            <option value="C16">C16</option>
                            <option value="C18">C18</option>
                        </select>
                    </div>

                    <!-- Nhập đạo diễn -->
                    <div class="form-group mb-3">
                        <label for="dao_dien">Đạo diễn</label>
                        <input type="text" class="form-control" id="dao_dien" name="dao_dien"
                            placeholder="Nhập tên đạo diễn" required>
                    </div>
                    <!-- Nhập diễn viên -->
                    <div class="form-group mb-3">
                        <label for="dien_vien">Diễn viên</label>
                        <input type="text" class="form-control" id="dien_vien" name="dien_vien"
                            placeholder="Nhập tên diễn viên" required>
                    </div>
                    <!-- Nhập quốc gia -->
                    <div class="form-group mb-3">
                        <label for="quoc_gia">Quốc gia</label>
                        <div class="d-flex flex-wrap">
                            <?php
                            $nation = ['Âu Mỹ', 'Hàn Quốc', 'Trung Quốc', 'Anh', 'Việt Nam'];
                            foreach ($nation as $nation): ?>
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="checkbox" name="quoc_gia[]" value="<?= $nation ?>"
                                        id="quoc_gia<?= strtolower($nation) ?>">
                                    <label class="form-check-label"
                                        for="quoc_gia<?= strtolower($nation) ?>"><?= $nation ?></label>
                                </div>
                            <?php endforeach; ?>
                            <div class="d-flex align-items-center">
                                <label for="quoc_gia" class="me-2">Khác: </label>
                                <input class="form-control w-60" type="text" name="quoc_gia[]"
                                    placeholder=" Nhập khác...">
                            </div>
                        </div>

                    </div>
                    <!-- Nhập mô tả phim -->
                    <div class="form-group mb-3">
                        <label for="mo_ta">Mô tả phim</label>
                        <textarea class="form-control" id="mo_ta" name="mo_ta" rows="10" placeholder="Nhập mô tả phim"
                            required></textarea>
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
                                    <input class="form-check-input" type="checkbox" name="the_loai[]" value="<?= $genre ?>"
                                        id="the_loai_<?= strtolower($genre) ?>">
                                    <label class="form-check-label"
                                        for="the_loai_<?= strtolower($genre) ?>"><?= $genre ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <!-- Nút thêm thể loại nằm cạnh -->
                        <div class="mt-3">
                            <a href="../category/categories-add.php" class="btn btn-success btn-sm">
                                <i class="fas fa-plus me-1"></i> Thêm thể loại
                            </a>
                        </div>
                    </div>

                    <!-- Năm phát hành -->
                    <div class="form-group mb-3">
                        <label for="nam_phat_hanh">Năm phát hành</label>
                        <input type="number" class="form-control" id="nam_phat_hanh" name="nam_phat_hanh"
                            placeholder="Nhập năm phát hành" required>
                    </div>

                    <!-- Thời lượng phim -->
                    <div class="form-group mb-3">
                        <label for="thoi_luong">Thời lượng (phút)</label>
                        <input type="number" class="form-control" id="thoi_luong" name="thoi_luong"
                            placeholder="Nhập thời lượng phim" required>
                    </div>

                    <!-- Chọn ảnh phim -->
                    <div class="form-group mb-3">
                        <label for="anh_phim">Chọn ảnh phim</label>
                        <input type="file" class="form-control" id="anh_phim" name="anh_phim" accept="image/*" required
                            onchange="previewImage(event)">
                    </div>

                    <!-- Hiển thị ảnh đã chọn -->
                    <div class="form-group d-flex justify-content-center mb-3">
                        <img id="preview" src="#" alt="Ảnh xem trước" class="img-fluid"
                            style="display:none; max-width: 100%; max-height: 17rem;" />
                    </div>
                </div>
            </div>

            <!-- Nút submit -->
            <button type="submit" name="editFilm" class="btn bg-gradient-info px-5 mt-3">Lưu</button>
        </form>
    </div>
</div>

<?php include('../../includes/footer.php'); ?>
