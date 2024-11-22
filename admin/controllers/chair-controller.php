<?php
require '../../config/function.php';
getAdmin();
$messages = []; // Mảng lỗi
//====== Thêm ghế =======//
if (isset($_POST['saveChair'])) {
    $tenghe = validate($_POST['tenghe']);
    $loaighe = validate($_POST['loaighe']);
    $soluong = validate($_POST['soluong']);
    $maphong = validate($_POST['maphong']);
    $status = validate($_POST['status']) == 1 ? 1 : 0;
    //Kiểm tra lỗi
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
        redirect('chair.php', 'success', 'Thêm mới ghế thành công', 'admin');
    } else {
        $_SESSION['form_data'] = $_POST;
        redirect('views/chair/chair-add.php', 'messages', $messages, 'admin');
    }
}

//====== Sửa ghế =======//
if (isset($_POST['editChair'])) {
    $tenghe = validate($_POST['tenghe']);
    $loaighe = validate($_POST['loaighe']);
    $maphong = validate($_POST['maphong']);
    $status = validate($_POST['status']) == 1 ? 1 : 0;
    $id = validate($_POST['maghe']);
    $phong = getAll($maphong);

    $exist_query = "SELECT COUNT(*) as count FROM GHE WHERE TenGhe = '$tenghe' AND MaPhong = '$maphong' AND MaGhe != '$id'";
    $exist_result = mysqli_query($conn, $exist_query);
    $flag = mysqli_fetch_assoc($exist_result)['count'];

    if ($flag > 0) {
        $messages['tenghe'] = "Tên ghế đã tồn tại trong phòng này.";
    }
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
            redirect('chair.php', 'success', 'Cập nhật ghế thành công', 'admin');
        } else {
            redirect('views/chair/chair-edit.php?id=' . $id, 'error', 'Cập nhật ghế thất bại', 'admin');
        }
    } else {
        redirect('views/chair/chair-edit.php?id=' . $id, 'messages', $messages, 'admin');
        $_SESSION['form_data'] = $_POST;
    }
}


if (isset($_POST['changeStatus'])) {
    $id = validate($_POST['maghe']);
    $status = validate($_POST['status']) == 1 ? 1 : 0;

    $edit_query = "UPDATE Ghe SET
                TrangThai = '$status',
                NguoiCapNhat = '$created',
                NgayCapNhat = CURRENT_TIMESTAMP
                WHERE MaGhe = '$id'";

    if (mysqli_query($conn, $edit_query)) {
        redirect('chair.php', 'success', 'Cập nhật trạng thái thành công', 'admin');
    } else {
        redirect('chair.php', 'error', 'Cập nhật trạng thái thất bại', 'admin');
    }
}
$conn->close();
