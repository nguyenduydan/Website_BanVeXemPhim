<?php
session_start();
require '../../config/function.php';

// xử lý categories
$messages = [];
if (isset($_POST['saveCategory'])) {
    $ngay_tao = new DateTime();
    $name = validate($_POST['ten_the_loai']);
    $status = validate($_POST['status']);
    if (empty($name)) {
        $messages['name'] = 'Tên thể loại không được để trống';
    }
    if (isExistValue('TheLoai', 'TenTheLoai', $name)) {
        $messages['name'] = 'Tên thể loại đã tồn tại';
    }
    if (empty($messages)) {
        $query = "INSERT INTO theloai (TenTheLoai,NguoiTao,NgayTao,NguoiCapNhat,NgayCapNhat,TrangThai)
            VALUES ('$name','$created',CURRENT_TIMESTAMP,'$created',CURRENT_TIMESTAMP,'$status')";
        if (mysqli_query($conn, $query)) {
            redirect('../categories.php', 'success', 'Thêm thể loại thành công');
        } else {
            redirect('../views/category/categories-add.php', 'error', 'Thêm thể loại thất bại');
        }
    } else {
        $_SESSION['form_data'] = $_POST;
        redirect('../views/category/categories-add.php', 'messages', $messages);
    }
}


//====== categories-edit =======//

if (isset($_POST['editCategory'])) {
    $messages = [];
    $name = validate($_POST['ten_the_loai']);
    $id = validate($_POST['matl']);
    $status = validate($_POST['status']);
    if (empty($name)) {
        $messages['ten_the_loai'] = 'Tên thể loại không được để trống';
    }
    if (isExistValue('TheLoai', 'TenTheLoai', $name, 'MaTheLoai', $id)) {
        $messages['ten_the_loai'] = 'Tên thể loại đã tồn tại';
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
            redirect('../categories.php', 'success', 'Cập nhật thể loại thành công');
        } else {
            redirect('../views/category/categories-edit.php?id=' . $id, 'errors', 'Cập nhật thể loại thất bại');
        }
    } else {
        $_SESSION['form_data'] = $_POST;
        redirect('../views/category/categories-edit.php?id=' . $id, 'messages', $messages);
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
        redirect('../categories.php', 'success', 'Cập nhật trạng thái thành công');
    } else {
        redirect('../categories.php', 'error', 'Cập nhật trạng thái thất bại');
    }
}
$conn->close();
