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
$invoice = getByID('hoadon', 'MaHD', $id_result);
$id = $invoice['data']['MaHD'];
$query = "SELECT cthd.*, h.*, sc.*, p.*
          FROM chitiethoadon cthd
          JOIN hoadon h ON h.MaHD = cthd.MaHD
          JOIN suatchieu sc ON cthd.MaSuatChieu = sc.MaSuatChieu
          JOIN phim p ON sc.MaPhim = p.MaPhim
          WHERE h.MaHD = '$id'";
$result = $conn->query($query);

if ($invoice['status'] == 200 && $result) {
    $seatNumbers = []; // Initialize array for seat numbers

    // Lặp qua từng dòng kết quả để lấy ghế
    while ($ghe = $result->fetch_assoc()) {
        $maGhe = $ghe['MaGhe']; // Giả sử 'MaGhe' là một chuỗi chứa ghế

        // Xử lý danh sách ghế
        if (strpos($maGhe, '-') !== false) {
            list($start, $end) = explode('-', $maGhe);
            $startLetter = substr($start, 0, 1);
            $startNumber = (int)substr($start, 1);
            $endNumber = (int)substr($end, 1); // Chỉ lấy phần số từ 'end'

            for ($i = $startNumber; $i <= $endNumber; $i++) {
                $seatNumbers[] = $startLetter . $i;
            }
        } else {
            $seatNumbers[] = $maGhe; // Nếu chỉ có một ghế
        }
    }
    $result->data_seek(0);
    $item = $result->fetch_assoc();
?>
    <div class="row">
        <div class="col-xl-12 col-lg-12 mx-auto">
            <h2><?= $title ?></h2>
            <!-- Nút sửa và quay lại -->
            <div class="text-end mb-4">
                <a class="btn btn-secondary" href="../../invoice.php">Quay lại</a>
            </div>
            <!-- Thông tin chi tiết hóa đơn -->
            <div class="card">
                <div class="card-body">
                    <div class="row fs-6">
                        <!-- Cột 1 chứa thông tin hóa đơn -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="fs-6">Mã Hóa Đơn:</label>
                                <span><?= htmlspecialchars($invoice['data']['MaHD']); ?></span>
                            </div>
                            <div class="mb-3">
                                <label class="fs-6">Tên phim:</label>
                                <span><?= htmlspecialchars($item['TenPhim']); ?></span>
                            </div>
                            <div class="mb-3">
                                <?php
                                // Fetch customer name
                                $query = "SELECT TenND
                                          FROM nguoidung
                                          JOIN hoadon ON nguoidung.MaND = hoadon.MaND
                                          WHERE nguoidung.MaND = {$invoice['data']['MaND']}";
                                $resultCustomer = $conn->query($query);
                                $customerName = "Không tìm thấy người dùng";
                                if ($resultCustomer && $content = $resultCustomer->fetch_assoc()) {
                                    $customerName = htmlspecialchars($content['TenND']);
                                }
                                ?>
                                <label class="fs-6">Tên khách hàng:</label>
                                <span><?= $customerName; ?></span>
                            </div>
                            <div class="mb-3">
                                <label class="fs-6">Ghế:</label>
                                <span><?= implode(', ', $seatNumbers); ?></span> <!-- Display booked seats -->
                            </div>
                            <div class="mb-3">
                                <label class="fs-6">Suất chiếu:</label>
                                <span><?= date('d/m/Y - H:i:s', strtotime($item['GioChieu'])); ?></span>
                            </div>
                        </div>

                        <!-- Cột 2 có thể chứa thông tin bổ sung nếu cần -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="fs-6">Ngày Mua:</label>
                                <span><?= date('d/m/Y', strtotime($invoice['data']['NgayLapHD'])); ?></span>
                            </div>
                            <div class="mb-3">
                                <label class="fs-6">Tổng Tiền:</label>
                                <span
                                    class="text-danger fw-bold"><?= number_format($invoice['data']['TongTien'], 0, ',', ',') . ' VNĐ'; ?></span>
                            </div>
                            <div class="mb-3">
                                <label class="fs-6">Ngày cập nhật:</label>
                                <span><?= date('d/m/Y', strtotime($invoice['data']['NgayCapNhat'])); ?></span>
                            </div>
                            <div class="mb-3">
                                <label class="fs-6">Trạng Thái:</label>
                                <span><?= $invoice['data']['TrangThai'] == 1 ? '<span class="badge bg-success">Đã thanh toán</span>' : '<span class="badge bg-danger">Chưa thanh toán</span>'; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
} else {
    // Hiển thị thông báo nếu không lấy được thông tin hóa đơn
    echo '<h5>' . htmlspecialchars($invoice['message']) . '</h5>';
}
    ?>

    <?php include('../../includes/footer.php'); ?>
