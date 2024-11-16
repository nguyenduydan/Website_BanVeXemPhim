<?php
require '../../../config/function.php';
include('../../includes/header.php');
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    redirect('sign-in.php', 'error', 'Vui lòng đăng nhập');
}
if (isset($_SESSION['EmployedIn']) && $_SESSION['EmployedIn'] === true) {
    redirect('index.php', 'error', 'Bạn không phải admin!','admin'); 
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
        <h2><?php echo htmlspecialchars($title); ?></h2>
        <div class="text-end mb-4">
            <a class="btn btn-secondary" href="../../chair.php">Quay lại</a>
        </div>
        <form id="addChairForm" action="../../controllers/chair-controller.php" method="post"
            enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <label for="tenghe">Tên ghế</label>
                    <input type="text" class="form-control" id="tenghe" name="tenghe" placeholder="Nhập tên ghế">
                    <?php if (isset($messages['tenghe'])): ?>
                        <small class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['tenghe']) ?></small>
                    <?php endif; ?>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-6">
                            <label for="loaighe">Loại ghế</label>
                            <select class="form-select" id="loaighe" name="loaighe">
                                <option value="" disabled selected>Chọn loại ghế</option>
                                <option value="Đơn">Đơn</option>
                                <option value="Đôi">Đôi</option>
                                <option value="VIP">VIP</option>

                            </select>
                            <?php if (isset($messages['loaighe'])): ?>
                                <small class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['loaighe']) ?></small>
                            <?php endif; ?>
                        </div>
                        <div class="col-6">
                            <label for="soluong">Số lượng</label>
                            <input type="number" class="form-control" id="soluong" name="soluong"
                                placeholder="Nhập số lượng" min="0" max="10">
                            <?php if (isset($messages['soluong'])): ?>
                                <small class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['soluong']) ?></small>
                            <?php endif; ?>
                        </div>
                    </div>




                </div>
                <div class="col-md-6">
                    <label for="status">Trạng thái</label>
                    <select class="form-select" id="status" name="status">
                        <option value="1">Online</option>
                        <option value="0">Offline</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="maphong">Tên phòng (<span class="text-danger">*</span>)</label>
                    <select class="form-control" id="maphong" name="maphong">
                        <option value="" disabled selected>Chọn phòng</option>
                        <?php
                        $rooms = getAll('Phong');
                        foreach ($rooms as $room): ?>
                            <option value="<?php echo htmlspecialchars($room['MaPhong']); ?>"
                                <?php echo (isset($formData['maphong']) && $formData['maphong'] == $room['maphong']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($room['TenPhong']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (isset($messages['maphong'])): ?>
                        <small class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['maphong']) ?></small>
                    <?php endif; ?>
                </div>
            </div>
            <button type="submit" name="saveChair" class="btn bg-gradient-info px-5 mt-3">Lưu</button>
        </form>
    </div>
</div>
<?php include('../../includes/footer.php'); ?>