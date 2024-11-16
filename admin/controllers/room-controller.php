<?php
require '../../config/function.php';
getAdmin();
$messages = [];
//====== room-add =======//
if (isset($_POST['saveRoom'])) {
    $messages = []; // Initialize messages array
    $ten_phong = validate($_POST['ten_phong']);
    $status = validate($_POST['status']) == 1 ? 1 : 0;

    if (empty($ten_phong)) {
        $messages['ten_phong'] = "Tên phòng không được để trống.";
    } elseif (isExistValue('Phong', 'TenPhong', $ten_phong)) {
        $messages['ten_phong'] = "Tên phòng đã tồn tại";
    }

    if (empty($messages)) {
        $query = "INSERT INTO phong (TenPhong, NguoiTao, NgayTao, NguoiCapNhat, NgayCapNhat, TrangThai)
                  VALUES ('$ten_phong', '$created', CURRENT_TIMESTAMP, '$created', CURRENT_TIMESTAMP, '$status')";

        if (mysqli_query($conn, $query)) {
            redirect('room.php', 'success', 'Thêm phòng thành công', 'admin');
        } else {
            redirect('views/room/room-add.php', 'error', 'Thêm phòng thất bại', 'admin');
        }
    } else {
        $_SESSION['form_data'] = $_POST;
        redirect('views/room/room-add.php', 'messages', $messages, 'admin');
    }
}

//====== room-edit =======//
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
                NguoiCapNhat = '$created',
                NgayCapNhat = CURRENT_TIMESTAMP,
                TrangThai = '$status'
                WHERE MaPhong = '$id'";

        if (mysqli_query($conn, $query)) {
            redirect('room.php', 'success', 'Cập nhật phòng thành công', 'admin');
        } else {
            redirect('views/room/room-edit.php?id=' . $id, 'error', 'Cập nhật phòng thất bại', 'admin');
        }
    } else {
        $_SESSION['form_data'] = $_POST;
        redirect('views/room/room-edit.php?id=' . $id, 'messages', $messages, 'admin');
    }
}


//====== changeStatus ======//
if (isset($_POST['changeStatus'])) {
    $id = validate($_POST['maphong']);
    $status = validate($_POST['status']) == 1 ? 1 : 0;

    $edit_query = "UPDATE Phong SET
                TrangThai = '$status',
                NguoiCapNhat = '$created',
                NgayCapNhat = CURRENT_TIMESTAMP
                WHERE MaPhong = '$id'";

    if (mysqli_query($conn, $edit_query)) {
        redirect('room.php', 'success', 'Cập nhật trạng thái thành công', 'admin');
    } else {
        redirect('room.php', 'error', 'Cập nhật trạng thái thất bại', 'admin');
    }
}
$conn->close();