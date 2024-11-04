<?php
session_start();
require '../../config/function.php';

$messages = [];
//====== chair-add =======//
if (isset($_POST['saveChair'])) {
    $messages = []; // Initialize messages array
    $tenghe = validate($_POST['tenghe']);
    $loaighe = validate($_POST['loaighe']);
    $maphong = validate($_POST['maphong']);
    $status = validate($_POST['status']) == 1 ? 1 : 0;

    if (empty($tenghe)) {
        $messages['tenghe'] = "Tên phòng không được để trống.";
    }
    if (empty($messages)) {
        $thamso = getByID("ThamSo","TenThamSo",$loaighe);
        $giaghe = $thamso['data']['GiaTri'];
        $query = "INSERT INTO Ghe (TenGhe, MaPhong, LoaiGhe, GiaGhe, NguoiTao, NgayTao, NguoiCapNhat, NgayCapNhat, TrangThai)
                      VALUES ('$tenghe', '$maphong', '$loaighe', '$giaghe', '1', CURRENT_TIMESTAMP, '1', CURRENT_TIMESTAMP, '$status')";

        if (mysqli_query($conn, $query)) {
            redirect('../chair.php', 'success', 'Thêm ghế thành công');
        } else {
            redirect('../views/chair/chair-add.php', 'error', 'Thêm ghế thất bại');
        }
    } else {
        $_SESSION['form_data'] = $_POST;
        redirect('../views/chair/chair-add.php', 'messages', $messages);
    }
}

//====== chair-edit =======//
if (isset($_POST['editChair'])) {
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
            redirect('../chair.php', 'success', 'Cập nhật tài khoản thành công');
        } else {
            redirect('../views/chair/chair-edit.php?id=' . $id, 'error', 'Cập nhật tài khoản thất bại');
        }
    } else {
        redirect('../views/chair/chair-edit.php?id=' . $id, 'errors', $messages);
        $_SESSION['form_data'] = $_POST;
    }
}


//====== changeStatus ======//
if (isset($_POST['changeStatus'])) {
    $id = validate($_POST['maghe']);
    $status = validate($_POST['status']) == 1 ? 1 : 0;

    $edit_query = "UPDATE Ghe SET
                TrangThai = '$status',
                NguoiCapNhat = '1',
                NgayCapNhat = CURRENT_TIMESTAMP
                WHERE MaGhe = '$id'";

    if (mysqli_query($conn, $edit_query)) {
        redirect('../chair.php', 'success', 'Cập nhật trạng thái thành công');
    } else {
        redirect('../chair.php', 'error', 'Cập nhật trạng thái thất bại');
    }
}
$conn->close();
