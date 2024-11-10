<?php
session_start();
require '../../config/function.php';
getAdmin();
$messages = [];
if (isset($_POST['saveContent'])) {
    $name = validate($_POST['tenbv']);
    $chudebv = validate($_POST['chudebv']);
    $chitiet = validate($_POST['chitietbv']);
    $tukhoa = validate($_POST['tukhoa']);
    $status = validate($_POST['status']);
    $mota = validate($_POST['mota']);
    $kieubv = validate($_POST['kieubv']);
    if (empty($name)) {
        $messages['name'] = 'Tên chủ đề không được để trống';
    }
    if (isset($_FILES['content-imgs'])) {

        $uploadResult = uploadMultipleImages($_FILES['content-imgs'], "../../uploads/content-imgs/");

        if ($uploadResult['success']) {
            $anhbv = implode(',', $uploadResult['filenames']);
        } else {
            $messages['images'] = implode(', ', $uploadResult['messages']);
        }
    }
    if (empty($messages)) {
        $link = str_slug($name);
        $query = "INSERT INTO baiviet (ChuDeBV, TenBV, LienKet, ChiTiet, Anh, KieuBV, MoTa, TuKhoa, NguoiTao, NgayTao, NguoiCapNhat, NgayCapNhat, TrangThai)
            VALUES ('$chudebv', '$name', '$link', '$chitiet', '$anhbv', '$kieubv', '$mota', '$tukhoa', '$created', CURRENT_TIMESTAMP,'$created',CURRENT_TIMESTAMP, '$status')";

        if (mysqli_query($conn, $query)) {
            redirect('content.php', 'success', 'Thêm bài viết thành công', 'admin');
        } else {
            redirect('views/content/content-add.php', 'error', 'Thêm bài viết thất bại', 'admin');
        }
    } else {
        $_SESSION['form_data'] = $_POST;
        redirect('views/content/content-add.php', 'messages', $messages, 'admin');
    }
}


//====== content-edit =======//

if (isset($_POST['editContent'])) {
    $messages = [];
    $id = validate($_POST['mabv']);
    $name = validate($_POST['tenbv']);
    $chudebv = validate($_POST['chudebv']);
    $chitiet = validate($_POST['chitietbv']);
    $tukhoa = validate($_POST['tukhoa']);
    $status = validate($_POST['status']);
    $mota = validate($_POST['mota']);
    $kieubv = validate($_POST['kieubv']);
    if (empty($name)) {
        $messages['name'] = 'Tên chủ đề không được để trống';
    }
    if (isset($_FILES['content-imgs'])) {

        $uploadResult = uploadMultipleImages($_FILES['content-imgs'], "../../uploads/content-imgs/");

        if ($uploadResult['success']) {
            $anhbv = implode(',', $uploadResult['filenames']);
        } else {
            $messages['images'] = implode(', ', $uploadResult['messages']);
        }
    }
    if (empty($messages)) {
        $link = str_slug($name);
        $query = "UPDATE baiviet SET
                ChuDeBV = '$chudebv',
                TenBV = '$name',
                LienKet = '$link',
                ChiTiet = '$chitiet',
                Anh = '$anhbv',
                KieuBV = '$kieubv',
                MoTa = '$mota',
                TuKhoa = '$tukhoa',
                NguoiCapNhat = '$created',
                NgayCapNhat = CURRENT_TIMESTAMP,
                TrangThai = '$status'
              WHERE Id = '$id'";  // Chú ý: Cần xác định $id là ID của bài viết cần cập nhật

        if (mysqli_query($conn, $query)) {
            redirect('content.php', 'success', 'Cập nhật bài viết thành công', 'admin');
        } else {
            redirect('views/content/content-edit.php', 'error', 'Cập nhật bài viết thất bại', 'admin');
        }
    } else {
        $_SESSION['form_data'] = $_POST;
        redirect('views/content/content-edit.php', 'messages', $messages, 'admin');
    }
}


if (isset($_POST['changeStatus'])) {
    $id = validate($_POST['Id']);
    $status = validate($_POST['status']) == 1 ? 1 : 0;

    $edit_query = "UPDATE BaiViet SET
                TrangThai = '$status',
                NguoiCapNhat = '$created',
                NgayCapNhat = CURRENT_TIMESTAMP
                WHERE Id = '$id'";

    if (mysqli_query($conn, $edit_query)) {
        redirect('content.php', 'success', 'Cập nhật trạng thái thành công', 'admin');
    } else {
        redirect('content.php', 'error', 'Cập nhật trạng thái thất bại', 'admin');
    }
}
$conn->close();