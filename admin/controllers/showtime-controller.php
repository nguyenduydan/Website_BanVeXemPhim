<?php
session_start();
require '../../config/function.php';

$messages = [];
//====== suatchieu-add =======//
if (isset($_POST['savesc'])) {
    $messages = []; // Initialize messages array
    $giochieu = validate($_POST['giochieu']);
    $mafilm = validate($_POST['maphim']);
    $status = validate($_POST['status']) == 1 ? 1 : 0;
    if (empty($giochieu)) {
        $messages['giochieu'] = "Giờ chiếu không được để trống.";
    } elseif (isExistValue('Phong', 'TenPhong', $ten_phong)) {
        $messages['giochieu'] = "Giờ chiếu đã tồn tại";
    }
    if(empty($mafilm)){
        $messages['maphim'] = 'Tên phim không được để trống';
    }
    if (empty($messages)) {
        $query = "INSERT INTO SuatChieu (MaPhim,GioChieu, NguoiTao, NgayTao, NguoiCapNhat, NgayCapNhat, TrangThai)
                  VALUES ('$mafilm','$giochieu', '1', CURRENT_TIMESTAMP, '1', CURRENT_TIMESTAMP, '$status')";

        if (mysqli_query($conn, $query)) {
            redirect('../showtime.php', 'success', 'Thêm suất chiếu thành công');
        } else {
            redirect('../views/showtime/showtime-add.php', 'error', 'Thêm suất chiếu thất bại');
        }
    } else {
        $_SESSION['form_data'] = $_POST;
        redirect('../views/showtime/showtime-add.php', 'messages', $messages);
    }
}

//====== suatchieu-edit =======//
if (isset($_POST['editRoom'])) {
    $messages = [];
    $id = validate($_POST['maphong']);
    $ten_phong = validate($_POST['ten_phong']);
    $status = validate($_POST['status']) == 1 ? 1 : 0;


    if (empty($ten_phong)) {
        $messages['ten_phong'] = "Tên phòng không được để trống.";
    } elseif (isExistValue('Phong', 'TenPhong', $ten_phong, 'MaPhong', $id)) {
        $messages['ten_phong'] = "Tên phòng đã tồn tại";
    }
    if (empty($messages)) {
        $query = "UPDATE phong SET
                TenPhong = '$ten_phong',
                NguoiCapNhat = '1',
                NgayCapNhat = CURRENT_TIMESTAMP,
                TrangThai = '$status'
                WHERE MaPhong = '$id'";

        if (mysqli_query($conn, $query)) {
            redirect('../room.php', 'success', 'Cập nhật tài khoản thành công');
        } else {
            redirect('../views/room/room-edit.php?id=' . $id, 'error', 'Cập nhật tài khoản thất bại');
        }
    } else {
        redirect('../views/room/room-edit.php?id=' . $id, 'errors', $messages);
        $_SESSION['form_data'] = $_POST;
    }
}


//====== changeStatus ======//
if (isset($_POST['changeStatus'])) {
    $id = validate($_POST['masc']);
    $status = validate($_POST['status']) == 1 ? 1 : 0;

    $edit_query = "UPDATE SUATCHIEU SET
                TrangThai = '$status',
                NguoiCapNhat = '1',
                NgayCapNhat = CURRENT_TIMESTAMP
                WHERE MaSuatChieu = '$id'";

    if (mysqli_query($conn, $edit_query)) {
        redirect('../showtime.php', 'success', 'Cập nhật trạng thái thành công');
    } else {
        redirect('../showtime.php', 'error', 'Cập nhật trạng thái thất bại');
    }
}
$conn->close();
