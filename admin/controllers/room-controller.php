<?php
session_start();
require '../../config/function.php';

$messages = [];
//====== room-add =======//
if (isset($_POST['saveRoom'])) {
    $ten_phong = validate($_POST['ten_phong']);
    $status = validate($_POST['status']) == 1 ? 1 : 0;

    if (empty($ten_phong)) {
        $messages['ten_phong'] = "Tên phòng không được để trống.";
    } elseif (isExistValue('Phong', 'TenPhong', $ten_phong)) {
        $messages['ten_phong'] = "Tên phòng đã tồn tại";
    }

    if (empty($messages)) {
        $query = "INSERT INTO phong (TenPhong, NguoiTao, NgayTao, NguoiCapNhat, NgayCapNhat, TrangThai) VALUES (?, ?, CURRENT_TIMESTAMP, NULL, NULL, ?)";
        $stmt = $conn->prepare($query);
        $nguoi_tao = 1;
        $stmt->bind_param("sii", $ten_phong, $nguoi_tao, $status);

        if ($stmt->execute()) {
            redirect('../room.php', 'success', 'Thêm phòng thành công');
        } else {
            redirect('../views/room/room-add.php', 'error', 'Thêm phòng thất bại');
        }
        $stmt->close();
    } else {
        $_SESSION['form_data'] = $_POST;
        redirect('../views/room/room-add.php', 'messages', $messages);
    }
}

//====== room-edit =======//
if (isset($_POST['editRoom'])) {
    $id = validate($_POST['maphong']);
    $ten_phong = validate($_POST['ten_phong']);
    $status = validate($_POST['status']) == 1 ? 1 : 0;

    if (empty($ten_phong)) {
        $messages['ten_phong'] = "Tên phòng không được để trống.";
    } elseif (isExistValue('Phong', 'TenPhong', $ten_phong, 'MaPhong', $id)) {
        $messages['ten_phong'] = "Tên phòng đã tồn tại";
    }

    if (empty($messages)) {
        $query = "UPDATE phong SET TenPhong = ?, NguoiCapNhat = ?, NgayCapNhat = CURRENT_TIMESTAMP, TrangThai = ? WHERE MaPhong = ?";
        $stmt = $conn->prepare($query);
        $nguoi_cap_nhat = 1;
        $stmt->bind_param("siiii", $ten_phong, $nguoi_cap_nhat, $status, $id);

        if ($stmt->execute()) {
            redirect('../room.php', 'success', 'Cập nhật phòng thành công');
        } else {
            redirect('../views/room/room-edit.php?id=' . $id, 'error', 'Cập nhật phòng thất bại');
        }
        $stmt->close();
    } else {
        $_SESSION['form_data'] = $_POST;
        redirect('../views/room/room-edit.php?id=' . $id, 'errors', $messages);
    }
}

//====== changeStatus ======//
if (isset($_POST['changeStatus'])) {
    $id = validate($_POST['maphong']);
    $status = validate($_POST['status']) == 1 ? 1 : 0;

    $query = "UPDATE Phong SET TrangThai = ?, NguoiCapNhat = ?, NgayCapNhat = CURRENT_TIMESTAMP WHERE MaPhong = ?";
    $stmt = $conn->prepare($query);
    $nguoi_cap_nhat = 1;
    $stmt->bind_param("iii", $status, $nguoi_cap_nhat, $id);

    if ($stmt->execute()) {
        redirect('../room.php', 'success', 'Cập nhật trạng thái thành công');
    } else {
        redirect('../room.php', 'error', 'Cập nhật trạng thái thất bại');
    }
    $stmt->close();
}

// Đóng kết nối
$conn->close();
