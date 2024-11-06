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
        <form id="addUserForm" action="../../controllers/slider-controller.php" method="post"
            enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="name">Tên slider (<span class="text-danger">*</span>)</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên slider"
                            value="<?php echo isset($formData['name']) ? htmlspecialchars($formData['name']) : ''; ?>">
                        <?php if (isset($messages['name'])): ?>
                        <small class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['name']) ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="nametopic">Tên chủ đề (<span class="text-danger">*</span>)</label>
                        <input type="text" class="form-control" id="nametopic" name="nametopic"
                            placeholder="Nhập tên đăng nhập"
                            value="<?php echo isset($formData['nametopic']) ? htmlspecialchars($formData['nametopic']) : ''; ?>">
                        <?php if (isset($messages['nametopic'])): ?>
                        <small class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['nametopic']) ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="url">Url</label>
                        <input type="text" class="form-control" id="url" name="url" placeholder="Nhập đường dẫn"
                            value="<?php echo isset($formData['url']) ? htmlspecialchars($formData['url']) : ''; ?>">
                        <?php if (isset($messages['url'])): ?>
                        <small class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['url']) ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="tukhoa">Từ khóa (<span class="text-danger">*</span>)</label>
                        <input type="text" class="form-control" id="tukhoa" name="tukhoa" placeholder="Nhập từ khóa"
                            value="<?php echo isset($formData['tukhoa']) ? htmlspecialchars($formData['tukhoa']) : ''; ?>">
                        <?php if (isset($messages['tukhoa'])): ?>
                        <small class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['tukhoa']) ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="mota">Mô tả (<span class="text-danger">*</span>)</label>
                        <textarea class="form-control" id="mota" name="mota" rows="5"><?php echo isset($formData['mota']) ? htmlspecialchars($formData['mota']) : ''; ?>
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
                            <option value="header">Header</option>
                            <option value="footer">Footer</option>
                            <option value="aside">aside</option>
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
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>

                        </div>
                        <div class="col-6">
                            <label for="status">Trạng thái</label>
                            <select class="form-select" id="status" name="status">
                                <option value="1">Online</option>
                                <option value="0">Offline</option>
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
            <button type="submit" name="saveSlider" class="btn bg-gradient-info px-5 mt-3">Lưu</button>
        </form>
    </div>
</div>

<?php include('../../includes/footer.php'); ?>