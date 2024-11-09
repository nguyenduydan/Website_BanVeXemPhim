<?php
session_start();
require '../../config/function.php';
getAdmin();
$messages = [];
//====== chair-add =======//
if (isset($_POST['saveChair'])) {
    $messages = []; // Initialize messages array
    $tenghe = validate($_POST['tenghe']);
    $loaighe = validate($_POST['loaighe']);
    $soluong = validate($_POST['soluong']);
    $maphong = validate($_POST['maphong']);
    $status = validate($_POST['status']) == 1 ? 1 : 0;

    if (empty($tenghe)) {
        $messages['tenghe'] = "Tên ghế không được để trống.";
    }
    if (empty($soluong)) {
        $messages['soluong'] = "Số lượng không được để trống.";
    }
    if (empty($loaighe)) {
        $messages['loaighe'] = "Loại ghế không được để trống.";
    }
    if (empty($maphong)) {
        $messages['maphong'] = "Tên phòng không được để trống.";
    }
    if (empty($messages)) {
        $thamso = getByID("ThamSo", "TenThamSo", $loaighe);
        $giaghe = $thamso['data']['GiaTri'] ?? 0;
        for ($i = 1; $i <= $soluong; $i++) {
            $name = $tenghe . $i;
            $query = "INSERT INTO Ghe (TenGhe, MaPhong, LoaiGhe, GiaGhe, NguoiTao, NgayTao, NguoiCapNhat, NgayCapNhat, TrangThai)
                          VALUES ('$name', '$maphong', '$loaighe', '$giaghe', '$created', CURRENT_TIMESTAMP, '$created', CURRENT_TIMESTAMP, '$status')";
            mysqli_query($conn, $query);
        }
        redirect('chair.php', 'success', 'Thêm mới ghế thành công');
    } else {
        $_SESSION['form_data'] = $_POST;
        redirect('views/chair/chair-add.php', 'messages', $messages);
    }
}

//====== chair-edit =======//
if (isset($_POST['editChair'])) {
    $messages = []; // Initialize messages array
    $tenghe = validate($_POST['tenghe']);
    $loaighe = validate($_POST['loaighe']);
    $maphong = validate($_POST['maphong']);
    $status = validate($_POST['status']) == 1 ? 1 : 0;
    $id = validate($_POST['maghe']);

    if (empty($tenghe)) {
        $messages['tenghe'] = "Tên ghế không được để trống.";
    }
    if (empty($messages)) {
        $thamso = getByID("ThamSo", "TenThamSo", $loaighe);
        $giaghe = $thamso['data']['GiaTri'] ?? 0;
        $query = "UPDATE GHE SET
                TenGhe = '$tenghe',
                MaPhong = '$maphong',
                LoaiGhe = '$loaighe',
                GiaGhe = '$giaghe',
                NguoiCapNhat = '$created',
                NgayCapNhat = CURRENT_TIMESTAMP,
                TrangThai = '$status'
                WHERE MaGhe = '$id'";

        if (mysqli_query($conn, $query)) {
            redirect('chair.php', 'success', 'Cập nhật ghế thành công');
        } else {
            redirect('views/chair/chair-edit.php?id=' . $id, 'error', 'Cập nhật ghế thất bại');
        }
    } else {
        redirect('views/chair/chair-edit.php?id=' . $id, 'errors', $messages);
        $_SESSION['form_data'] = $_POST;
    }
}


//====== changeStatus ======//
if (isset($_POST['changeStatus'])) {
    $id = validate($_POST['maghe']);
    $status = validate($_POST['status']) == 1 ? 1 : 0;

    $edit_query = "UPDATE Ghe SET
                TrangThai = '$status',
                NguoiCapNhat = '$created',
                NgayCapNhat = CURRENT_TIMESTAMP
                WHERE MaGhe = '$id'";

    if (mysqli_query($conn, $edit_query)) {
        redirect('chair.php', 'success', 'Cập nhật trạng thái thành công');
    } else {
        redirect('chair.php', 'error', 'Cập nhật trạng thái thất bại');
    }
}
$conn->close();