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
            <a class="btn btn-secondary" href="../../topic.php">Quay lại</a>
        </div>
        <form id="addTopicForm" action="../../controllers/topic-controller.php" method="post"
            enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="name_topic">Tên chủ đề (<span class="text-danger">*</span>)</label>
                        <input type="text" class="form-control" id="name_topic" name="name_topic"
                            placeholder="Nhập chủ đề"
                            value="<?php echo isset($formData['name_topic']) ? htmlspecialchars($formData['name_topic']) : ''; ?>">
                        <?php if (isset($messages['name_topic'])): ?>
                            <small class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['name_topic']) ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="tukhoa">Từ khóa</label>
                        <input type="text" class="form-control" id="tukhoa" name="tukhoa" placeholder="Nhập từ khóa"
                            value="<?php echo isset($formData['tukhoa']) ? htmlspecialchars($formData['tukhoa']) : ''; ?>">
                        <?php if (isset($messages['tukhoa'])): ?>
                            <small class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['tukhoa']) ?></small>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row mb-3">
                        <div class="col">
                            <label for="maphim">Chọn phim</label>
                            <select class="form-control" id="maphim" name="maphim">
                                <option value="">Chọn tên phim</option>
                                <?php
                                $films = getAll('Phim');
                                foreach ($films as $film): ?>
                                    <option value="<?php echo htmlspecialchars($film['MaPhim']); ?>"
                                        <?php echo (isset($formData['maphim']) && $formData['maphim'] == $film['MaPhim']) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($film['TenPhim']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?php if (isset($messages['maphim'])): ?>
                                <small class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['maphim']) ?></small>
                            <?php endif; ?>
                        </div>

                        <div class="col">
                            <label for="status">Trạng thái</label>
                            <select class="form-select" id="status" name="status">
                                <option value="1">Online</option>
                                <option value="0">Offline</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="mo_ta">Mô tả chủ đề</label>
                        <textarea class="form-control" id="mo_ta" name="mo_ta" rows="5" placeholder="Nhập mô tả chủ đề"
                            value="<?php echo isset($formData['mo_ta']) ? htmlspecialchars($formData['mo_ta']) : ''; ?>"></textarea>
                    </div>
                </div>
            </div>
            <button type="submit" name="saveTopic" class="btn bg-gradient-info px-5 mt-3">Lưu</button>
        </form>
    </div>
</div>

<?php include('../../includes/footer.php'); ?>