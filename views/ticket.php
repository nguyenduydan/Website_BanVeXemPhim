<?php
if (isset($_POST['seatsInput'])) {
    $selectedSeats = $_POST['seatsInput'] ?? '';
    $data = json_decode($selectedSeats, true);
    $maGhe = explode(',', $data['MaGhe'] ?? '');
    $maPhim = $data['MaPhim']?? '';
    $maPhong = $data['MaPhong']?? '';
    $maSuatChieu = $data['MaSuatChieu']?? '';
}
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
        <h4 style="text-transform:uppercase" class="d-flex justify-content-center align-items-center mt-2">Tên phim</h4>
    </div>
    <div class="ticket-body">
        <div class="ticket-details">
            <div class="ticket-poster">
                <img src="~/Public/img/phim/@ViewBag.AnhPhim" alt="" class="img-fluid" style="max-width: 150px; border-radius: 10px;">
            </div>
            <div class="ticket-info">
                <p><strong>Galaxy Nha Trang Center - Tên phòng</strong></p>
                <p>Suất: <strong>Giờ chiếu</p>
                <p>Loại ghế:</p>
                <p>Ghế:<?= $maGhe?> </p>
                <p><strong>Tổng cộng:</strong></p>
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