<?php

require '../../../config/function.php';
include('../../includes/header.php');

// Kiểm tra xem người dùng đã đăng nhập chưa, nếu chưa thì chuyển hướng đến trang đăng nhập
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    redirect('sign-in.php', 'error', 'Vui lòng đăng nhập');
}
if (isset($_SESSION['EmployedIn']) && $_SESSION['EmployedIn'] === true) {
    redirect('index.php', 'error', 'Bạn không phải admin!', 'admin');
}

?>

<div id="toast"></div>

<?php
// Kiểm tra ID hợp lệ của hóa đơn từ URL
$id_result = check_valid_ID('id');
if (!is_numeric($id_result)) {
    echo '<h5>' . $id_result . '</h5>';
    return false;
}

// Lấy thông tin hóa đơn từ cơ sở dữ liệu dựa trên ID
$invoice = getByID('HoaDon', 'MaHD', check_valid_ID('id'));

if ($invoice['status'] == 200) { // Kiểm tra xem có lấy thành công thông tin hóa đơn không
?>
<div class="row">
    <div class="col-xl-12 col-lg-12 mx-auto">
        <h2><?= $title ?></h2>

        <!-- Thông tin chi tiết hóa đơn -->
        <div class="card">
            <div class="card-body">
                <div class="row fs-6">
                    <!-- Cột 1 chứa thông tin hóa đơn -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="fs-6">Mã Hóa Đơn:</label>
                            <span><?= $invoice['data']['MaHD']; ?></span>
                        </div>
                        <div class="mb-3">
                            <label class="fs-6">Tên Người Dùng:</label>
                            <span><?= $invoice['data']['TenND']; ?></span>
                        </div>
                        <div class="mb-3">
                            <label class="fs-6">Tên Phim:</label>
                            <span><?= $invoice['data']['TenPhim']; ?></span>
                        </div>
                        <div class="mb-3">
                            <label class="fs-6">Suất Chiếu:</label>
                            <span><?= date('d/m/Y H:i', strtotime($invoice['data']['SuatChieu'])); ?></span>
                        </div>
                        <div class="mb-3">
                            <label class="fs-6">Ghế:</label>
                            <span><?= $invoice['data']['Ghe']; ?></span>
                        </div>
                        <div class="mb-3">
                            <label class="fs-6">Tổng Tiền:</label>
                            <span><?= number_format($invoice['data']['TongTien'], 0, ',', '.') . ' VNĐ'; ?></span>
                        </div>
                        <div class="mb-3">
                            <label class="fs-6">Ngày Mua:</label>
                            <span><?= date('d/m/Y', strtotime($invoice['data']['NgayMua'])); ?></span>
                        </div>
                    </div>

                    <!-- Cột 2 có thể chứa thông tin bổ sung nếu cần -->
                    <div class="col-md-6">
                        <!-- Thêm thông tin bổ sung ở đây nếu cần -->
                        <div class="mb-3">
                            <label class="fs-6">Trạng Thái:</label>
                            <span><?= $invoice['data']['TrangThai'] == 1 ? 'Đã thanh toán' : 'Chưa thanh toán'; ?></span>
                        </div>
                        <div class="mb-3">
                            <label class="fs-6">Ghi chú:</label>
                            <span><?= $invoice['data']['GhiChu']; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
} else {
    // Hiển thị thông báo nếu không lấy được thông tin hóa đơn
    echo '<h5>' . $invoice['message'] . '</h5>';
}
    ?>

    <?php include('../../includes/footer.php'); ?>