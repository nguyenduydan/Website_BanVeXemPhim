<?php
require '../../../config/function.php';
include('../../includes/header.php');
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    redirect('sign-in.php', 'error', 'Vui lòng đăng nhập');
}
$messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : []; // Lấy lỗi từ session
$formData = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];
unset($_SESSION['messages']); // Xóa lỗi khỏi session sau khi hiển thị
unset($_SESSION['form_data']);
?>

<div id="toast"></div>
<?php alertMessage() ?>

<div class="row">
    <div class="col-xl-12 col-lg-12 mx-auto">
        <h2><?php echo $title ?></h2>
        <div class="text-end mb-4">
            <a class="btn btn-secondary" href="../../slider.php">Quay lại</a>
        </div>
        <form id="editSliderForm" action="../../controllers/slider-controller.php" method="post"
            enctype="multipart/form-data">
            <?php
            $id_result = check_valid_ID('id');
            if (!is_numeric($id_result)) {
                echo '<h5>' . $id_result . '</h5>';
                return false;
            }
            $item = getByID('Slider', 'Id', check_valid_ID('id'));
            if ($item['status'] == 200) {
            ?>
            <div class="row">
                <input type="hidden" name="idSlider" value=<?= $item['data']['Id'] ?>>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="name">Tên slider (<span class="text-danger">*</span>)</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên slider"
                            value="<?php echo isset($formData['name']) ? htmlspecialchars($formData['name']) : $item['data']['TenSlider']; ?>">
                        <?php if (isset($messages['name'])): ?>
                        <small class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['name']) ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="nametopic">Tên chủ đề (<span class="text-danger">*</span>)</label>
                        <input type="text" class="form-control" id="nametopic" name="nametopic"
                            placeholder="Nhập tên đăng nhập" value="<?= $item['data']['TenChuDe'] ?? ''; ?>">
                        <?php if (isset($messages['nametopic'])): ?>
                        <small class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['nametopic']) ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="url">Url</label>
                        <input type="text" class="form-control" id="url" name="url" placeholder="Nhập đường dẫn"
                            value="<?= $item['data']['URL'] ?? ''; ?>">
                        <?php if (isset($messages['url'])): ?>
                        <small class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['url']) ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="tukhoa">Từ khóa (<span class="text-danger">*</span>)</label>
                        <input type="text" class="form-control" id="tukhoa" name="tukhoa" placeholder="Nhập từ khóa"
                            value="<?= $item['data']['TuKhoa'] ?? ''; ?>">
                        <?php if (isset($messages['tukhoa'])): ?>
                        <small class=" text-danger m-2 text-xs"><?= htmlspecialchars($messages['tukhoa']) ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="mota">Mô tả (<span class="text-danger">*</span>)</label>
                        <textarea class="form-control" id="mota" name="mota" placeholder="Nhập từ khóa" rows="5"><?= $item['data']['MoTa'] ?? ''; ?>
                        </textarea>
                        <?php if (isset($messages['mota'])): ?>
                        <small class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['mota']) ?></small>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="vitri">Vị trí(<span class="text-danger">*</span>)</label>
                        <select class=" form-select" id="vitri" name="vitri">
                            <option>Vị trí</option>
                            <option value="header" <?= $item['data']['ViTri'] == 'header' ? 'selected' : ''; ?>>Header
                            </option>
                            <option value="footer" <?= $item['data']['ViTri'] == 'footer' ? 'selected' : ''; ?>>Footer
                            </option>
                            <option value="aside" <?= $item['data']['ViTri'] == 'aside' ? 'selected' : ''; ?>>aside
                            </option>
                        </select>
                        <?php if (isset($messages['vitri'])): ?>
                        <small class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['vitri']) ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-6">
                            <label for="sapxep">Sắp xếp</label>
                            <select class=" form-select" id="sapxep" name="sapxep">
                                <option>Thứ tự</option>
                                <option value="1" <?= $item['data']['SapXep'] == '1' ? 'selected' : ''; ?>>1</option>
                                <option value="2" <?= $item['data']['SapXep'] == '2' ? 'selected' : ''; ?>>2</option>
                                <option value="3" <?= $item['data']['SapXep'] == '3' ? 'selected' : ''; ?>>3</option>
                            </select>

                        </div>
                        <div class="col-6">
                            <label for="status">Trạng thái</label>
                            <select class="form-select" id="status" name="status">
                                <option value="1" <?= $item['data']['TrangThai'] == 1 ? 'selected' : ''; ?>>Online</option>
                                <option value="0" <?= $item['data']['TrangThai'] == 0 ? 'selected' : ''; ?>>Offline</option>
                            </select>
                        </div>

                    </div>
                    <div class="form-group mb-3">
                        <label for="anh_slider">Chọn ảnh</label>
                        <input type="file" class="form-control" id="anh_slider" name="anh_slider" accept="image/*"
                            onchange="previewImageAdd(event)">
                    </div>
                    <div class="form-group d-flex justify-content-center mb-3">
                        <img id="preview" src="#" alt="Ảnh xem trước" class="img-fluid"
                            style="display:none; max-width: 100%; max-height: 15rem;" />
                    </div>
                </div>
            </div>
            <?php
            } else {
                echo '<h5>' . $item['message'] . '</h5>';
            }
            ?>
            <button type="submit" name="editSlider" class="btn bg-gradient-info px-5 mt-3">Lưu</button>
        </form>
    </div>
</div>

<?php include('../../includes/footer.php'); ?>