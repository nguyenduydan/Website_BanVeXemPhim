<?php
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
    foreach ($seatNumbers as $ghe) {
        $queryPrice = "SELECT GiaGhe, LoaiGhe FROM GHE WHERE TenGhe = '$ghe' AND MaPhong = '$maPhong'";
        $result = mysqli_query($conn, $queryPrice);
        $seatData = mysqli_fetch_assoc($result);

        if (!in_array($seatData['LoaiGhe'], $seatTypes)) {
            $seatTypes[] = $seatData['LoaiGhe'];
        }

        $tongTien += $seatData['GiaGhe'];
    }

    $query = "INSERT INTO HoaDon(MaND, NgayLapHD, NguoiTao, NgayTao, NguoiCapNhat, NgayCapNhat, TrangThai, TongTien)
            VALUES ('$NDId', CURRENT_TIMESTAMP, '$NDId', CURRENT_TIMESTAMP, '$NDId', CURRENT_TIMESTAMP, '1', '$tongTien')";
    mysqli_query($conn, $query);

    $maHD = mysqli_insert_id($conn);
    foreach ($seatNumbers as $ghe) {
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
    <style>
        .ticket-container {
            border: 2px dashed #7a6ad8;
            border-radius: 15px;
            padding: 20px;
            max-width: 600px;
            margin: auto;
            position: relative;
            background-color: #fff;
        }
        .ticket-header, .ticket-footer {
            background-color: #7a6ad8;
            color: white;
            padding: 10px 20px;
            border-radius: 10px 10px 0 0;
        }
        .ticket-footer {
            border-radius: 0 0 10px 10px;
            text-align: center;
        }
        .ticket-body {
            padding: 20px;
        }
        .ticket-details {
            display: flex;
            justify-content: space-between;
        }
        .ticket-info {
            margin-bottom: 10px;
        }
        .btn-custom {
            background-color: #7a6ad8;
            border: 2px solid #fff;
            border-radius: 5px;
            color: white;
        }
        .btn-custom:hover {
            background-color: #5a50b2;
            border-color: #5a50b2;
        }
    </style>

    <div class="ticket-container mt-4">
        <div class="ticket-header">
            <h4 style="text-transform:uppercase" class="d-flex justify-content-center align-items-center mt-2">
                <?php echo $movie['TenPhim']; ?> 
            </h4>
        </div>
        <div class="ticket-body">
            <div class="ticket-details">
                <div class="ticket-poster">
                    <img src="../uploads/film-imgs/<?=$movie['Anh']; ?>" class="img-fluid" style="max-width: 150px; border-radius: 10px;">
                </div>
                <div class="ticket-info">
                    <p><strong>Galaxy Nha Trang Center - <?php echo $room['TenPhong']; ?></strong></p>
                    <p>Suất: <strong>
                        <?php
                        $showtimeDate = new DateTime($showtime['GioChieu']);
                        echo $showtimeDate->format('d-m-Y H:i');
                        ?>
                    </strong>
                    </p>
                    <p>Loại ghế: <?php echo implode(", ", $seatTypes); ?> </p>
                    <p>Ghế: <?php echo $data['MaGhe']; ?></p>
                    <p><strong>Tổng cộng:</strong> <?php echo number_format($tongTien, 0, ',', '.') . ' VNĐ'; ?></p>
                </div>
            </div>
        </div>
        <div class="ticket-footer d-flex justify-content-between align-content-center">
            <a href="/"><button class="btn btn-secondary">Quay Lại</button></a>
            <button class="btn btn-custom" id="payButton">Thanh Toán</button>
        </div>
        <div class="alert alert-success mt-3" id="successMessage" style="display: none;">
            Thanh toán thành công!
        </div>
    </div>

<?php
} else {
    redirect('../index.php','error','Đã có lỗi xảy ra');
}
?>
