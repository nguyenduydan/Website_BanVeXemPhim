<?php
session_start();
require '../../config/function.php';
// xử lý content
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
            redirect('../content.php', 'success', 'Thêm bài viết thành công');
        } else {
            redirect('../views/content/content-add.php', 'error', 'Thêm bài viết thất bại');
        }
    } else {
        $_SESSION['form_data'] = $_POST;
        redirect('../views/content/content-add.php', 'messages', $messages);
    }
}


//====== content-edit =======//

if (isset($_POST['editCategory'])) {
    $messages = [];
    $name = validate($_POST['ten_the_loai']);
    $id = validate($_POST['matl']);
    $status = validate($_POST['status']);
    if (empty($name)) {
        $messages['name'] = 'Tên thể loại không được để trống';
    }
    if (isExistValue('TheLoai', 'TenTheLoai', $name, 'MaTheLoai', $id)) {
        $messages['name'] = 'Tên thể loại đã tồn tại';
    }
    if (empty($messages)) {
        $query = "UPDATE TheLoai SET
                TenTheLoai = '$name',
                NguoiCapNhat = '$created',
                NgayCapNhat = CURRENT_TIMESTAMP,
                TrangThai = '$status'
                WHERE MaTheLoai = '$id'
                ";
        if (mysqli_query($conn, $query)) {
            redirect('../content.php', 'success', 'Cập nhật thể loại thành công');
        } else {
            redirect('../views/category/content-edit.php?id=' . $id, 'errors', 'Cập nhật thể loại thất bại');
        }
    } else {
        $_SESSION['form_data'] = $_POST;
        redirect('../views/category/content-edit.php?id=' . $id, 'errors', $messages);
    }
}
if (isset($_POST['changeStatus'])) {
    $id = validate($_POST['matl']);
    $status = validate($_POST['status']) == 1 ? 1 : 0;

    $edit_query = "UPDATE TheLoai SET
                TrangThai = '$status',
                NguoiCapNhat = '$created',
                NgayCapNhat = CURRENT_TIMESTAMP
                WHERE MaTheLoai = '$id'";

    if (mysqli_query($conn, $edit_query)) {
        redirect('../content.php', 'success', 'Cập nhật trạng thái thành công');
    } else {
        redirect('../content.php', 'error', 'Cập nhật trạng thái thất bại');
    }
}
$conn->close();
