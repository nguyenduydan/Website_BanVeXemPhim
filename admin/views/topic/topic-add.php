<?php
require '../../../config/function.php';
include('../../includes/header.php');

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
                        <label for="nam_chude">Tên chủ đề (<span class="text-danger">*</span>)</label>
                        <input type="text" class="form-control" id="nam_chude" name="nam_chude"
                            placeholder="Nhập chủ đề"
                            value="<?php echo isset($formData['nam_chude']) ? htmlspecialchars($formData['nam_chude']) : ''; ?>">
                        <?php if (isset($messages['nam_chude'])): ?>
                        <small class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['nam_chude']) ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="form-group mb-3">
                        <label for="tenrutgon">Tên rút gọn</label>
                        <input type="text" class="form-control" id="tenrutgon" name="tenrutgon"
                            placeholder="Nhập tên rút gọn"
                            value="<?php echo isset($formData['tenrutgon']) ? htmlspecialchars($formData['tenrutgon']) : ''; ?>">
                    </div>
                    <div class="form-group mb-3">
                        <label for="tukhoa">Từ khóa</label>
                        <input type="text" class="form-control" id="tukhoa" name="tukhoa" placeholder="Nhập từ khóa"
                            value="<?php echo isset($formData['tukhoa']) ? htmlspecialchars($formData['tukhoa']) : ''; ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="maphim">Phim</label>
                        <select class="form-select" id="status" name="status">
                            <option value="1">hello</option>
                            <option value="0">Offline</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="status">Trạng thái</label>
                        <select class="form-select" id="status" name="status">
                            <option value="1">Online</option>
                            <option value="0">Offline</option>
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" name="saveTopic" class="btn bg-gradient-info px-5 mt-3">Lưu</button>
        </form>
    </div>
</div>

<?php include('../../includes/footer.php'); ?>