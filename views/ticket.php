<?php
$title = 'Thông tin vé';
include('../includes/header.php');
require_once("../config/function.php");

if (isset($_POST['seatsInput'])) {
    $selectedSeats = $_POST['seatsInput'] ?? '';
    $data = json_decode($selectedSeats, true);
    $maGhe = explode(',', $data['MaGhe'] ?? '');
    $seatNumbers = [];

    // Xử lý danh sách ghế
    foreach ($maGhe as $seat) {
        if (strpos($seat, '-') !== false) {
            list($start, $end) = explode('-', $seat);
            $startLetter = substr($start, 0, 1);
            $startNumber = (int)substr($start, 1);
            $endNumber = (int)$end;

            for ($i = $startNumber; $i <= $endNumber; $i++) {
                $seatNumbers[] = $startLetter . $i;
            }
        } else {
            $seatNumbers[] = $seat;
        }
    }

    // Lấy thông tin phim và suất chiếu
    $maPhim = $data['MaPhim'] ?? '';
    $maPhong = $data['MaPhong'] ?? '';
    $maSuatChieu = $data['MaSuatChieu'] ?? '';
    getUser();
    $seatTypes = [];
    $seatId = [];
    $totalPrice = 0; // Biến lưu tổng tiền

    // Lấy giá và ID ghế
    foreach ($seatNumbers as $ghe) {
        $queryPrice = "SELECT MaGhe, GiaGhe, LoaiGhe FROM GHE WHERE TenGhe = '$ghe' AND MaPhong = '$maPhong'";
        $result = mysqli_query($conn, $queryPrice);
        $seatData = mysqli_fetch_assoc($result);

        if ($seatData) {
            $totalPrice += $seatData['GiaGhe']; // Cộng dồn giá vé
            if (!in_array($seatData['LoaiGhe'], $seatTypes)) {
                $seatTypes[] = $seatData['LoaiGhe'];
            }
            if (!in_array($seatData['MaGhe'], $seatId)) {
                $seatId[] = $seatData['MaGhe'];
            }
        }
    }
    // Áp dụng giảm giá
    $tongTien = discount($NDId, $totalPrice); // Tính tổng tiền sau khi giảm giá
    // Thêm hóa đơn
    $query = "INSERT INTO HoaDon(MaND, NgayLapHD, NguoiTao, NgayTao, NguoiCapNhat, NgayCapNhat, TrangThai, TongTien)
              VALUES ('$NDId', CURRENT_TIMESTAMP, '$NDId', CURRENT_TIMESTAMP, '$NDId', CURRENT_TIMESTAMP, '1','$tongTien')";
    mysqli_query($conn, $query);

    $maHD = mysqli_insert_id($conn);
    
    // Thêm chi tiết hóa đơn
    foreach ($seatId as $ghe) {
        $queryDetail = "INSERT INTO ChiTietHoaDon(MaHD, MaSuatChieu, MaGhe, BapNuoc, NguoiTao, NgayTao, NguoiCapNhat, NgayCapNhat, TrangThai)
                        VALUES ('$maHD', '$maSuatChieu', '$ghe', '0', '$NDId', CURRENT_TIMESTAMP, '$NDId', CURRENT_TIMESTAMP, '1')";
        mysqli_query($conn, $queryDetail);
    }

    // Lấy thông tin phim
    $queryMovie = "SELECT TenPhim, Anh FROM Phim WHERE MaPhim = '$maPhim'";
    $resultMovie = mysqli_query($conn, $queryMovie);
    $movie = mysqli_fetch_assoc($resultMovie);

    // Lấy thông tin suất chiếu
    $queryShowtime = "SELECT GioChieu FROM SuatChieu WHERE MaSuatChieu = '$maSuatChieu'";
    $resultShowtime = mysqli_query($conn, $queryShowtime);
    $showtime = mysqli_fetch_assoc($resultShowtime);

    // Lấy thông tin phòng
    $queryRoom = "SELECT TenPhong FROM Phong WHERE MaPhong = '$maPhong'";
    $resultRoom = mysqli_query($conn, $queryRoom);
    $room = mysqli_fetch_assoc($resultRoom);


?>

    <div class="container d-flex justify-content-center align-items-center my-5 flex-column">
        <div class="ticket-wrapper d-flex shadow position-relative">
            <div class="ticket-date position-absolute top-0 end-0 p-2 text-muted"
                style="font-size: 0.75rem; background-color: rgba(255, 255, 255, 0.7); border-radius: 4px;">
                <?php
                $purchaseDate = new DateTime();
                echo $purchaseDate->format('d-m-Y H:i');
                ?>
            </div>

            <!-- Phần hình ảnh bên trái -->
            <div class="ticket-image d-flex align-items-center justify-content-center">
                <img src="../uploads/film-imgs/<?= $movie['Anh']; ?>" alt="Poster" class="img-fluid">
            </div>

            <!-- Phần thông tin vé ở giữa -->
            <div class="ticket-info p-4">
                <div class="text-center mb-2">
                    <small class="text-uppercase text-muted">Suất chiếu</small>
                    <p class="display-6 text-danger fw-bold">
                        <?php
                        $showtimeDate = new DateTime($showtime['GioChieu']);
                        echo $showtimeDate->format('d-m-Y');
                        ?>
                    </p>
                </div>

                <h3 class="text-center fw-bold"><?= $movie['TenPhim']; ?></h3>
                <p class="text-center text-primary"><?= $room['TenPhong']; ?></p>

                <div class="d-flex justify-content-center text-muted">
                    <p class="m-0">Giờ chiếu: <?= $showtimeDate->format('H:i'); ?></p>
                </div>

                <p class="text-center mt-3"><strong>Ghế:</strong></p>
                <div class="seat-list d-flex flex-wrap justify-content-center">
                    <?php
                    foreach ($seatNumbers as $seat) {
                        echo "<span class='badge bg-secondary me-1 mb-1'>$seat</span>";
                    }
                    ?>
                </div>

                <p class="text-center mt-3"><strong>Tổng cộng:</strong>
                    <span class="text-danger"><?= number_format($tongTien, 0, ',', '.') . ' VNĐ'; ?></span>
                </p>

            </div>
        </div>

        <!-- Nút Quay lại -->
        <div class="d-flex justify-content-center gap-3 mt-4">
            <a href="http://localhost/Website_BanVeXemPhim/index.php" class="btn btn-outline-secondary custom-button">Quay
                Lại</a>
        </div>
    </div>

<?php
} else {
    redirect('../index.php', 'error', 'Đã có lỗi xảy ra');
}
?>

<?php include('../includes/footer.php'); ?>