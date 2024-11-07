<?php
include('../includes/header.php');

require_once("../config/function.php");

if (isset($_POST['seatsInput'])) {
    $selectedSeats = $_POST['seatsInput'] ?? '';
    $data = json_decode($selectedSeats, true);
    $maGhe = explode(',', $data['MaGhe'] ?? '');
    $seatNumbers = [];

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
    $maPhim = $data['MaPhim'] ?? '';
    $maPhong = $data['MaPhong'] ?? '';
    $maSuatChieu = $data['MaSuatChieu'] ?? '';
    getUser();
    $tongTien = 0;
    $seatTypes = [];
    $seatId = [];
    foreach ($seatNumbers as $ghe) {
        $queryPrice = "SELECT MaGhe,GiaGhe, LoaiGhe FROM GHE WHERE TenGhe = '$ghe' AND MaPhong = '$maPhong'";
        $result = mysqli_query($conn, $queryPrice);
        $seatData = mysqli_fetch_assoc($result);

        if (!in_array($seatData['LoaiGhe'], $seatTypes)) {
            $seatTypes[] = $seatData['LoaiGhe'];
        }
        if (!in_array($seatData['MaGhe'], $seatId)) {
            $seatId[] = $seatData['MaGhe'];
        }
        $tongTien += $seatData['GiaGhe'];
    }

    $query = "INSERT INTO HoaDon(MaND, NgayLapHD, NguoiTao, NgayTao, NguoiCapNhat, NgayCapNhat, TrangThai, TongTien)
            VALUES ('$NDId', CURRENT_TIMESTAMP, '$NDId', CURRENT_TIMESTAMP, '$NDId', CURRENT_TIMESTAMP, '1', '$tongTien')";
    mysqli_query($conn, $query);

    $maHD = mysqli_insert_id($conn);
    foreach ($seatId as $ghe) {
        $queryDetail = "INSERT INTO ChiTietHoaDon(MaHD, MaSuatChieu, MaGhe, BapNuoc, NguoiTao, NgayTao, NguoiCapNhat, NgayCapNhat, TrangThai)
                        VALUES ('$maHD', '$maSuatChieu', '$ghe', '0', '$NDId', CURRENT_TIMESTAMP, '$NDId', CURRENT_TIMESTAMP, '1')";
        mysqli_query($conn, $queryDetail);
    }
    $queryMovie = "SELECT TenPhim, Anh FROM Phim WHERE MaPhim = '$maPhim'";
    $resultMovie = mysqli_query($conn, $queryMovie);
    $movie = mysqli_fetch_assoc($resultMovie);


    $queryShowtime = "SELECT GioChieu FROM SuatChieu WHERE MaSuatChieu = '$maSuatChieu'";
    $resultShowtime = mysqli_query($conn, $queryShowtime);
    $showtime = mysqli_fetch_assoc($resultShowtime);


    $queryRoom = "SELECT TenPhong FROM Phong WHERE MaPhong = '$maPhong'";
    $resultRoom = mysqli_query($conn, $queryRoom);
    $room = mysqli_fetch_assoc($resultRoom);


?>


<div class="container d-flex justify-content-center">
    <div class="ticket-container mt-4 border rounded shadow p-4" style="max-width: 400px; width: 100%;">
        <div class="ticket-header text-center">
            <h4 class="text-uppercase mt-2 mb-4">
                <?php echo $movie['TenPhim']; ?>
            </h4>
        </div>
        <div class="ticket-body d-flex align-items-center mb-3">
            <div class="ticket-poster me-3">
                <img src="../uploads/film-imgs/<?= $movie['Anh']; ?>" class="img-fluid rounded"
                    style="max-width: 100px;">
            </div>
            <div class="ticket-info">
                <p class="mb-2"><strong>D2P - <?php echo $room['TenPhong']; ?></strong></p>
                <p class="mb-2">Suất: <strong>
                        <?php
                            $showtimeDate = new DateTime($showtime['GioChieu']);
                            echo $showtimeDate->format('d-m-Y H:i');
                            ?>
                    </strong>
                </p>
                <p class="mb-2">Loại ghế: <?php echo implode(", ", $seatTypes); ?></p>
                <p class="mb-2">Ghế: <?php echo $data['MaGhe']; ?></p>
                <p class="mb-2"><strong>Tổng cộng:</strong>
                    <?php echo number_format($tongTien, 0, ',', '.') . ' VNĐ'; ?></p>
            </div>
        </div>
        <div class="ticket-footer d-flex justify-content-between align-items-center mt-3">
            <a href="/" class="btn btn-secondary">Quay Lại</a>
            <button class="btn btn-primary" id="payButton">Thanh Toán</button>
        </div>
        <div class="alert alert-success mt-3 text-center" id="successMessage" style="display: none;">
            Thanh toán thành công!
        </div>
    </div>
</div>


<?php
} else {
    redirect('../index.php', 'error', 'Đã có lỗi xảy ra');
}
?>

<?php include('../includes/footer.php'); ?>