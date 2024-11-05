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
            <a class="btn btn-secondary" href="../../content.php">Quay lại</a>
        </div>
        <form id="addContentForm" action="../../controllers/content-controller.php" method="post"
            enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="chudebv">Chủ đề bài viết (<span class="text-danger">*</span>)</label>
                        <select class="form-control" id="chudebv" name="chudebv">
                            <option value="">Chọn chủ đề</option>
                            <?php
                            $topics = getAll('ChuDe');
                            foreach ($topics as $topic): ?>
                            <option value="<?php echo htmlspecialchars($topic['Id']); ?>"
                                <?php echo (isset($formData['chudebv']) && $formData['chudebv'] == $topic['Id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($topic['TenChuDe']); ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (isset($messages['chudebv'])): ?>
                        <small class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['chudebv']) ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="tenbv">Tên bài viết (<span class="text-danger">*</span>)</label>
                        <input type="text" class="form-control" id="tenbv" name="tenbv" placeholder="Nhập tên bài viết"
                            value="<?php echo isset($formData['tenbv']) ? htmlspecialchars($formData['tenbv']) : ''; ?>">
                        <?php if (isset($messages['tenbv'])): ?>
                        <small class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['tenbv']) ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-6">
                            <label for="tukhoa">Từ khóa bài viết (<span class="text-danger">*</span>)</label>
                            <input type="text" class="form-control" id="tukhoa" name="tukhoa" placeholder="Nhập từ khóa"
                                value="<?php echo isset($formData['tukhoa']) ? htmlspecialchars($formData['tukhoa']) : ''; ?>">
                            <?php if (isset($messages['tukhoa'])): ?>
                            <small class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['tukhoa']) ?></small>
                            <?php endif; ?>
                        </div>
                        <div class="col-3">
                            <label for="status">Trạng thái</label>
                            <select class="form-select" id="status" name="status">
                                <option value="1">Online</option>
                                <option value="0">Offline</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <label for="kieubv">Kiểu bài viết</label>
                            <select class="form-select" id="kieubv" name="kieubv" required>
                                <option value="tintuc">Tin tức</option>
                                <option value="blog">Blog điện ảnh</option>
                                <option value="danhgia">Đánh giá</option>
                            </select>
                        </div>

                    </div>
                    <div class="form-group mb-3">
                        <label for="chitietbv">Chi tiết bài viết</label>
                        <textarea class="form-control" id="chitietbv" name="chitietbv" rows="10"
                            placeholder="Chi tiết bài viết"
                            value="<?php echo isset($formData['chitietbv']) ? htmlspecialchars($formData['chitietbv']) : ''; ?>"
                            required></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="mota">Mô tả bài viết</label>
                        <textarea class="form-control" id="mota" name="mota" rows="3" placeholder="Mô tả bài viết"
                            value="<?php echo isset($formData['mota']) ? htmlspecialchars($formData['mota']) : ''; ?>"
                            required></textarea>
                    </div>
                    <div class="form-group mb-3">

                        <label for="content-imgs">Chọn ảnh</label>
                        <input type="file" class="form-control" id="content-imgs" name="content-imgs[]" accept="image/*"
                            multiple onchange="previewImagesAdd2(event)">
                        <?php if (isset($messages['images'])): ?>
                        <small class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['images']) ?></small>
                        <?php endif; ?>

                    </div>
                    <div class="form-group mb-3">

                    </div>
                    <div class="form-group d-flex justify-content-center mb-3">
                        <img id="preview" src="#" alt="Ảnh xem trước" class="img-fluid"
                            style="display:none; max-width: 100%; max-height: 15rem;" />
                    </div>
                </div>
            </div>
            <button type="submit" name="saveContent" class="btn bg-gradient-info px-5 mt-3">Lưu</button>
        </form>
    </div>
</div>

<?php include('../../includes/footer.php'); ?>