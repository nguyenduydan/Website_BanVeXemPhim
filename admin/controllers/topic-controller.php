<?php
session_start();
require '../../config/function.php';
// xử lý topic
$messages = [];
if (isset($_POST['saveTopic'])) {
    $name_topic = validate($_POST['name_topic']);
    $name_short = validate($_POST['tenrutgon']);
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


    if (empty($messages)) {
        $query = "INSERT INTO chude (MaPhim,TenRutGon,MoTa,TuKhoa,TenChuDe,NguoiTao,NgayTao,NguoiCapNhat,NgayCapNhat,TrangThai)
            VALUES ('$phim','$name_short','$mota','$tukhoa','$name_topic',1,CURRENT_TIMESTAMP,NULL,NULL,'$status')";
        if (mysqli_query($conn, $query)) {
            redirect('../topic.php', 'success', 'Thêm chủ đề thành công');
        } else {
            redirect('../views/topic/topic-add.php', 'error', 'Thêm chủ đề thất bại');
        }
    } else {
        $_SESSION['form_data'] = $_POST;
        redirect('../views/topic/topic-add.php', 'messages', $messages);
    }
}


//====== topic-edit =======//

if (isset($_POST['editTopic'])) {
    $messages = [];
    $id = validate($_POST['id']);
    $name_topic = validate($_POST['name_topic']);
    $name_short = validate($_POST['tenrutgon']);
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
                TenRutGon = '$name_short',
                MoTa = '$mota',
                TuKhoa = '$tukhoa',
                TenChuDe = '$name_topic',
                NguoiCapNhat = 1,
                NgayCapNhat = CURRENT_TIMESTAMP,
                TrangThai = '$status'
                WHERE Id = '$id'
                ";
        if (mysqli_query($conn, $query)) {
            redirect('../topic.php', 'success', 'Cập nhật chủ đề thành công');
        } else {
            redirect('../views/topic/topic-edit.php?id=' . $id, 'errors', 'Cập nhật chủ đề thất bại');
        }
    } else {
        $_SESSION['form_data'] = $_POST;
        redirect('../views/topic/topic-edit.php?id=' . $id, 'errors', $messages);
    }
}


if (isset($_POST['changeStatus'])) {
    $id = validate($_POST['id']);
    $status = validate($_POST['status']) == 1 ? 1 : 0;

    $edit_query = "UPDATE CHUDE SET
                TrangThai = '$status',
                NguoiCapNhat = '1',
                NgayCapNhat = CURRENT_TIMESTAMP
                WHERE Id = '$id'";

    if (mysqli_query($conn, $edit_query)) {
        redirect('../topic.php', 'success', 'Cập nhật trạng thái thành công');
    } else {
        redirect('../topic.php', 'error', 'Cập nhật trạng thái thất bại');
    }
}
$conn->close();
