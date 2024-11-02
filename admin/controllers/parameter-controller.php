<?php
session_start();
require '../../config/function.php';
// xử lý categories
$messages = [];
if (isset($_POST['saveParameter'])) {
    $name = validate($_POST['tenthamso']);
    $donvitinh = validate($_POST['donvitinh']);
    $giatri = validate($_POST['giatri']);
    $status = validate($_POST['status']);
    if (empty($name)) {
        $messages['name'] = 'Tên tham số không được để trống';
    }
    if (isExistValue('ThamSo', 'TenThamSo', $name)) {
        $messages['name'] = 'Tên tham số đã tồn tại';
    }
    if (empty($donvitinh)) {
        $messages['donvitinh'] = 'Đơn vị tính không được để trống';
    }
    if (empty($giatri)) {
        $messages['giatri'] = 'Giá trị không được để trống';
    }

    if (empty($messages)) {
        $query = "INSERT INTO ThamSo (TenThamSo,DonViTinh,GiaTri,TrangThai)
            VALUES ('$name','$donvitinh','$giatri','$status')";
        if (mysqli_query($conn, $query)) {
            redirect('../parameter.php', 'success', 'Thêm tham số thành công');
        } else {
            redirect('../views/parameter/parameter-add.php', 'error', 'Thêm tham số thất bại');
        }
    } else {
        $_SESSION['form_data'] = $_POST;
        redirect('../views/parameter/parameter-add.php', 'messages', $messages);
    }
}


//====== categories-edit =======//

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
                NguoiCapNhat = 1,
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
        redirect('../views/category/categories-edit.php?id=' . $id, 'errors', $messages);
    }
}
if (isset($_POST['changeStatus'])) {
    $id = validate($_POST['matl']);
    $status = validate($_POST['status']) == 1 ? 1 : 0;

    $edit_query = "UPDATE TheLoai SET
                TrangThai = '$status',
                NguoiCapNhat = '1',
                NgayCapNhat = CURRENT_TIMESTAMP
                WHERE MaTheLoai = '$id'";

    if (mysqli_query($conn, $edit_query)) {
        redirect('../categories.php', 'success', 'Cập nhật trạng thái thành công');
    } else {
        redirect('../categories.php', 'error', 'Cập nhật trạng thái thất bại');
    }
}
$conn->close();