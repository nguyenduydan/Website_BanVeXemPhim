<?php
require '../../../config/function.php';
include('../../includes/header.php');
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    redirect('sign-in.php', 'error', 'Vui lòng đăng nhập');
}
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : []; // Lấy lỗi từ session
$formData = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];
unset($_SESSION['errors']); // Xóa lỗi khỏi session sau khi hiển thị
unset($_SESSION['form_data']);

?>
<div id="toast"></div>
<?php alertMessage() ?>
<div class="row">
    <div class="col-xl-12 col-lg-12 mx-auto">
        <h2><?php echo htmlspecialchars($title); ?></h2>
        <!-- Nút quay lại nằm sát bên phải -->
        <div class="text-end mb-4">
            <a class="btn btn-secondary" href="../../film.php">
                Quay lại
            </a>
        </div>
        <form id="editFilmForm" action="../../controllers/film-controller.php" method="post"
            enctype="multipart/form-data">
            <?php
            $id_result = check_valid_ID('id');
            if (!is_numeric($id_result)) {
                echo '<h5>' . $id_result . '</h5>';
                return false;
            }
            $film = getByID('Phim', 'MaPhim', check_valid_ID('id'));
            if ($film['status'] == 200) {
            ?>
            <input type="hidden" name="ma_phim" value=<?= $film['data']['MaPhim'] ?>>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="ten_phim">Tên phim</label>
                        <input type="text" class="form-control" id="ten_phim" name="ten_phim"
                            value="<?php echo isset($formData['ten_phim']) ? htmlspecialchars($formData['ten_phim']) : $film['data']['TenPhim']; ?>"
                            placeholder="Nhập tên phim">
                        <?php if (isset($messages['ten_phim'])): ?>
                        <small class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['ten_phim']) ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="phan_loai">Phân loại</label>
                        <select class="form-select" id="phan_loai" name="phan_loai">
                            <option value="P" <?= $film['data']['PhanLoai'] == 'P' ? 'selected' : ''; ?>>Phổ thông
                            </option>
                            <option value="T13" <?= $film['data']['PhanLoai'] == 'T13' ? 'selected' : ''; ?>>T13
                            </option>
                            <option value="T16" <?= $film['data']['PhanLoai'] == 'T16' ? 'selected' : ''; ?>>T16
                            </option>
                            <option value="T18" <?= $film['data']['PhanLoai'] == 'T18' ? 'selected' : ''; ?>>T18
                            </option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="dao_dien">Đạo diễn</label>
                        <input type="text" class="form-control" id="dao_dien" name="dao_dien"
                            value="<?= $film['data']['DaoDien'] ?>"
                            value="<?php echo isset($formData['dao_dien']) ? htmlspecialchars($formData['dao_dien']) : ''; ?>"
                            placeholder="Nhập tên đạo diễn">
                    </div>
                    <div class="form-group mb-3">
                        <label for="dien_vien">Diễn viên</label>
                        <input type="text" class="form-control" id="dien_vien" name="dien_vien"
                            value="<?= $film['data']['DienVien'] ?>"
                            value="<?php echo isset($formData['dien_vien']) ? htmlspecialchars($formData['dien_vien']) : ''; ?>"
                            placeholder="Nhập tên diễn viên">
                    </div>
                    <?php
                        // Danh sách quốc gia đã định nghĩa
                        $nation = ['Âu Mỹ', 'Hàn Quốc', 'Trung Quốc', 'Anh', 'Việt Nam'];
                        $quocGia = $film['data']['QuocGia'] ?? '';
                        $selected = array_map('trim', explode(',', $quocGia));

                        // Tìm quốc gia không có trong danh sách đã định nghĩa
                        $otherNations = array_diff($selected, $nation);
                        $otherNationsString = implode(', ', $otherNations); // Chuyển thành chuỗi để hiển thị
                        ?>

                    <div class="form-group mb-3">
                        <label for="quoc_gia">Quốc gia</label>
                        <div class="d-flex flex-wrap">
                            <?php foreach ($nation as $nation): ?>
                            <div class="form-check me-3">
                                <input class="form-check-input" type="checkbox" name="quoc_gia[]" value="<?= $nation ?>"
                                    id="quoc_gia<?= strtolower($nation) ?>"
                                    <?= in_array($nation, $selected) ? 'checked' : ''; ?>>
                                <label class="form-check-label"
                                    for="quoc_gia<?= strtolower($nation) ?>"><?= $nation ?></label>
                            </div>
                            <?php endforeach; ?>
                            <div class="d-flex align-items-center">
                                <label for="quoc_gia" class="me-2">Khác: </label>
                                <input class="form-control w-60" type="text" name="other_nation"
                                    placeholder="Nhập khác..."
                                    value="<?= isset($_POST['other_nation']) ? htmlspecialchars($_POST['other_nation']) : htmlspecialchars($otherNationsString); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="mo_ta">Mô tả phim</label>
                        <textarea class="form-control" id="mo_ta" name="mo_ta" rows="10" placeholder="Nhập mô tả phim"
                            required>
                            <?= isset($formData['mo_ta']) ? htmlspecialchars($formData['mo_ta']) : htmlspecialchars($film['data']['MoTa']); ?>
                        </textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <?php
                        global $conn;
                        $query = "SELECT Theloai.MATHELOAI, Theloai.TenTheLoai
                            FROM THELOAI_FILM
                            JOIN THELOAI ON THELOAI_FILM.MATHELOAI = THELOAI.MATHELOAI
                            WHERE THELOAI_FILM.MAPHIM = {$film['data']['MaPhim']}";
                        $result = $conn->query($query);
                        $selectedGenres = [];
                        while ($row = $result->fetch_assoc()) {
                            $selectedGenres[] = $row['TenTheLoai'];
                        }
                        ?>
                    <div class="form-group mb-3">
                        <label for="the_loai">Thể loại</label>
                        <div class="d-flex flex-wrap">
                            <?php
                                $genres = getAll('TheLoai');
                                foreach ($genres as $genre): ?>
                            <div class="form-check me-3">
                                <input class="form-check-input" type="checkbox" name="the_loai[]"
                                    value="<?= $genre['MaTheLoai'] ?>"
                                    id="the_loai_<?= strtolower($genre['TenTheLoai']) ?>"
                                    <?= in_array($genre['TenTheLoai'], $selectedGenres) ? 'checked' : ''; ?>>
                                <label class="form-check-label"
                                    for="the_loai_<?= strtolower($genre['TenTheLoai']) ?>"><?= $genre['TenTheLoai'] ?></label>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="mt-3">
                            <a href="../category/categories-add.php" class="btn btn-success btn-sm">
                                <i class="fas fa-plus me-1"></i> Thêm thể loại
                            </a>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="nam_phat_hanh">Năm phát hành</label>
                        <input type="number" class="form-control" id="nam_phat_hanh" name="nam_phat_hanh"
                            value="<?= $film['data']['NamPhatHanh'] ?>" placeholder="Nhập năm phát hành" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="thoi_luong">Thời lượng (phút)</label>
                        <input type="number" class="form-control" id="thoi_luong" name="thoi_luong"
                            value="<?= $film['data']['ThoiLuong'] ?>" placeholder="Nhập thời lượng phim" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="status">Trạng thái</label>
                        <select class="form-select" id="status" name="status">
                            <option value="1" <?= $film['data']['TrangThai'] == 1 ? 'selected' : ''; ?>>Online</option>
                            <option value="0" <?= $film['data']['TrangThai'] == 0 ? 'selected' : ''; ?>>Offline</option>
                            <option value="2" <?= $film['data']['TrangThai'] == 2 ? 'selected' : ''; ?>>Coming soon
                            </option>
                        </select>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-6">
                            <label for="anh_phim">Chọn ảnh phim</label>
                            <input type="file" class="form-control" id="anh_phim" name="anh_phim" accept="image/*"
                                onchange="previewImage(event, 'preview')">
                            <div class="form-group d-flex justify-content-center mt-3">
                                <img id="preview" src="#" alt="Ảnh xem trước" class="img-fluid"
                                    style="display:none; max-width: 100%; max-height: 10rem;" />
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="banner">Chọn ảnh banner</label>
                            <input type="file" class="form-control" id="banner" name="banner" accept="image/*"
                                onchange="previewImage(event, 'previewbanner')">
                            <div class="form-group d-flex justify-content-center mt-3">
                                <img id="previewbanner" src="#" alt="Ảnh xem trước" class="img-fluid"
                                    style="display:none; max-width: 100%; max-height: 10rem;" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            } else {
                echo '<h5>' . $film['message'] . '</h5>';
            }
            ?>
            <!-- Nút submit -->
            <button type="submit" name="editFilm" class="btn bg-gradient-info px-5 mt-3">Lưu</button>
        </form>
    </div>
</div>

<?php include('../../includes/footer.php'); ?>
