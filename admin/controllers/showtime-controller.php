<?php
require '../../config/function.php';
getAdmin();
$messages = [];
//====== suatchieu-add =======//
if (isset($_POST['savesc'])) {
    $messages = []; // Initialize messages array
    $giochieu = validate($_POST['giochieu']);
    $mafilm = validate($_POST['maphim']);
    $status = validate($_POST['status']) == 1 ? 1 : 0;
    $maphong = validate($_POST['maphong']);
    if (empty($giochieu)) {
        $messages['giochieu'] = "Giờ chiếu không được để trống.";
    }
    $checkQuery = "SELECT COUNT(*) FROM SuatChieu WHERE GioChieu = '$giochieu' AND MaPhong = '$maphong'";
    $result = mysqli_query($conn, $checkQuery);
    $row = mysqli_fetch_array($result);

    if ($row[0] > 0) {
        $messages['giochieu'] = "Giờ chiếu và phòng đã tồn tại.";
    }
    if (empty($mafilm)) {
        $messages['maphim'] = 'Tên phim không được để trống';
    }
    if (empty($maphong)) {
        $messages['maphong'] = 'Tên phòng không được để trống';
    }
    if (empty($messages)) {
        $query = "INSERT INTO SuatChieu (MaPhim,MaPhong,GioChieu, NguoiTao, NgayTao, NguoiCapNhat, NgayCapNhat, TrangThai)
                  VALUES ('$mafilm','$maphong','$giochieu', '$created', CURRENT_TIMESTAMP, '$created', CURRENT_TIMESTAMP, '$status')";

        if (mysqli_query($conn, $query)) {
            redirect('showtime.php', 'success', 'Thêm suất chiếu thành công', 'admin');
        } else {
            redirect('views/showtime/showtime-add.php', 'error', 'Thêm suất chiếu thất bại', 'admin');
        }
    } else {
        $_SESSION['form_data'] = $_POST;
        redirect('views/showtime/showtime-add.php', 'messages', $messages, 'admin');
    }
}

//====== suatchieu-edit =======//
if (isset($_POST['editsc'])) {
    $messages = [];
    $id = validate($_POST['masc']);
    $giochieu = validate($_POST['giochieu']);
    $mafilm = validate($_POST['maphim']);
    $status = validate($_POST['status']) == 1 ? 1 : 0;
    $maphong = validate($_POST['maphong']);
    if (empty($giochieu)) {
        $messages['giochieu'] = "Giờ chiếu không được để trống.";
    }
    $checkQuery = "SELECT COUNT(*) FROM SuatChieu WHERE GioChieu = '$giochieu' AND MaPhong = '$maphong'";
    $result = mysqli_query($conn, $checkQuery);
    $row = mysqli_fetch_array($result);

    if ($row[0] > 0) {
        $messages['giochieu'] = "Giờ chiếu và phòng đã tồn tại.";
    }
    if (empty($mafilm)) {
        $messages['maphim'] = 'Tên phim không được để trống';
    }
    if (empty($messages)) {
        $query = "UPDATE SuatChieu SET
                MaPhim = '$mafilm',
                MaPhong = '$maphong',
                GioChieu = '$giochieu',
                NguoiCapNhat = '$created',
                NgayCapNhat = CURRENT_TIMESTAMP,
                TrangThai = '$status'
                WHERE MaSuatChieu = '$id'";

        if (mysqli_query($conn, $query)) {
            redirect('showtime.php', 'success', 'Cập nhật suất chiếu thành công', 'admin');
        } else {
            redirect('views/showtime/showtime-edit.php?id=' . $id, 'error', 'Cập nhật suất chiếu thất bại', 'admin');
        }
    } else {
        redirect('views/showtime/showtime-edit.php?id=' . $id, 'messages', $messages, 'admin');
        $_SESSION['form_data'] = $_POST;
    }
}


//====== changeStatus ======//
if (isset($_POST['changeStatus'])) {
    $id = validate($_POST['masc']);
    $status = validate($_POST['status']) == 1 ? 1 : 0;

    $edit_query = "UPDATE SUATCHIEU SET
                TrangThai = '$status',
                NguoiCapNhat = '$created',
                NgayCapNhat = CURRENT_TIMESTAMP
                WHERE MaSuatChieu = '$id'";

    if (mysqli_query($conn, $edit_query)) {
        redirect('showtime.php', 'success', 'Cập nhật trạng thái thành công', 'admin');
    } else {
        redirect('showtime.php', 'error', 'Cập nhật trạng thái thất bại', 'admin');
    }
}
$conn->close();
