<?php
require '../../config/function.php';
// xử lý topic
getAdmin();
$messages = [];
if (isset($_POST['saveTopic'])) {
    $name_topic = validate($_POST['name_topic']);
    $tukhoa = validate($_POST['tukhoa']);
    $phim = validate($_POST['maphim']);
    $status = validate($_POST['status']);
    $mota = validate($_POST['mo_ta']);
    if (empty($name_topic)) {
        $messages['name_topic'] = 'Tên chủ đề không được để trống';
    }
    if (empty($tukhoa)) {
        $messages['tukhoa'] = 'Từ khóa không được để trống';
    }
    if (empty($phim)) {
        $messages['maphim'] = 'Phim không được để trống';
    }
    $slug = str_slug($name_topic);

    if (empty($messages)) {
        $query = "INSERT INTO chude (MaPhim,TenRutGon,MoTa,TuKhoa,TenChuDe,NguoiTao,NgayTao,NguoiCapNhat,NgayCapNhat,TrangThai)
            VALUES ('$phim','$slug','$mota','$tukhoa','$name_topic','$created',CURRENT_TIMESTAMP,'$created',CURRENT_TIMESTAMP,'$status')";
        if (mysqli_query($conn, $query)) {
            redirect('topic.php', 'success', 'Thêm chủ đề thành công', 'admin');
        } else {
            redirect('views/topic/topic-add.php', 'error', 'Thêm chủ đề thất bại', 'admin');
        }
    } else {
        $_SESSION['form_data'] = $_POST;
        redirect('views/topic/topic-add.php', 'messages', $messages, 'admin');
    }
}


//====== topic-edit =======//

if (isset($_POST['editTopic'])) {
    $messages = [];
    $id = validate($_POST['id']);
    $name_topic = validate($_POST['name_topic']);
    $slug = validate($_POST['tenrutgon']);
    $tukhoa = validate($_POST['tukhoa']);
    $phim = validate($_POST['maphim']);
    $status = validate($_POST['status']);
    $mota = validate($_POST['mo_ta']);
    if (empty($name_topic)) {
        $messages['name_topic'] = 'Tên chủ đề không được để trống';
    }
    if (empty($tukhoa)) {
        $messages['name_topic'] = 'Từ khóa không được để trống';
    }

    if (empty($messages)) {
        $query = "UPDATE ChuDe SET
                MaPhim = '$phim',
                TenRutGon = '$slug',
                MoTa = '$mota',
                TuKhoa = '$tukhoa',
                TenChuDe = '$name_topic',
                NguoiCapNhat = '$created',
                NgayCapNhat = CURRENT_TIMESTAMP,
                TrangThai = '$status'
                WHERE Id = '$id'
                ";
        if (mysqli_query($conn, $query)) {
            redirect('topic.php', 'success', 'Cập nhật chủ đề thành công', 'admin');
        } else {
            redirect('views/topic/topic-edit.php?id=' . $id, 'errors', 'Cập nhật chủ đề thất bại', 'admin');
        }
    } else {
        $_SESSION['form_data'] = $_POST;
        redirect('views/topic/topic-edit.php?id=' . $id, 'errors', $messages, 'admin');
    }
}


if (isset($_POST['changeStatus'])) {
    $id = validate($_POST['id']);
    $status = validate($_POST['status']);

    $edit_query = "UPDATE ChuDe SET
                TrangThai = '$status',
                NguoiCapNhat = '$created',
                NgayCapNhat = CURRENT_TIMESTAMP
                WHERE Id = '$id'";

    if (mysqli_query($conn, $edit_query)) {
        redirect('topic.php', 'success', 'Cập nhật trạng thái thành công', 'admin');
    } else {
        redirect('topic.php', 'error', 'Cập nhật trạng thái thất bại', 'admin');
    }
}
$conn->close();
