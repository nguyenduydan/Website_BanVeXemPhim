<?php
session_start();
require '../../config/function.php';

$messages = [];
//====== film-add =======//
if (isset($_POST['saveFilm'])) {
    $messages = []; 
    $name = validate($_POST['ten_phim']);
    $phanloai = validate($_POST['phan_loai']);
    $dao_dien = validate($_POST['dao_dien']);
    $dien_vien = validate($_POST['dien_vien']);
    $quoc_gia = $_POST['quoc_gia'] ?? [];
    if (!empty($_POST['other_nation'])) {
        $quoc_gia[] = validate($_POST['other_nation']);
    }
    $quoc_gia = implode(', ', $quoc_gia);
    $mota = validate($_POST['mo_ta']);
    $theloai = $_POST['the_loai'] ?? [];
    $namphathanh = validate($_POST['nam_phat_hanh']);
    $thoiluong = validate($_POST['thoi_luong']);
    $status = validate($_POST['status']) == 1 ? 1 : 0;
    $id = uniqid('film_', false);
    $anh_phim = '';
        if (isset($_FILES['anh_phim'])) {
            // Use filmname as filename for the img
            $imgResult = uploadImage($_FILES['anh_phim'], "../../uploads/film-imgs/", $id); 
            if ($imgResult['success']) {
                $anh_phim = $imgResult['filename'];
            } else {
                $messages[] = $imgResult['message'];
            }
        }
    if (empty($messages)) {
        
        $slug = str_slug($name);
        $query = "INSERT INTO PHIM (TenPhim,TenRutGon,ThoiLuong,Anh,DaoDien,DienVien,QuocGia,NamPhatHanh,PhanLoai,MoTa, NguoiTao, NgayTao, NguoiCapNhat, NgayCapNhat, TrangThai)
                  VALUES ('$name','$slug','$thoiluong','$anh_phim','$dao_dien','$dien_vien','$quoc_gia','$namphathanh','$phanloai','$mota', '1',CURRENT_TIMESTAMP, '1',CURRENT_TIMESTAMP, '$status')";
        if (mysqli_query($conn, $query)) {
            $maPhim = mysqli_insert_id($conn);
            foreach ($theloai as $maTheLoai) {
                $insertQuery = "INSERT INTO TheLoai_Film (MaTheLoai, MaPhim) VALUES ('$maTheLoai', '$maPhim')";
                mysqli_query($conn, $insertQuery);
            }
            redirect('../film.php', 'success', 'Thêm phim thành công'); 
        } else {
            redirect('../views/film/film-add.php', 'error', 'Thêm phim thất bại');
        }
    } 
    else {
        $_SESSION['form_data'] = $_POST;
        redirect('../views/film/film-add.php', 'messages', $messages);
    }
}

if (isset($_POST['editFilm'])) {
    $messages = []; 
    $name = validate($_POST['ten_phim']);
    $id = validate($_POST['ma_phim']);
    $phanloai = validate($_POST['phan_loai']);
    $dao_dien = validate($_POST['dao_dien']);
    $dien_vien = validate($_POST['dien_vien']);
    $quoc_gia = $_POST['quoc_gia'] ?? [];
    if (!empty($_POST['other_nation'])) {
        $quoc_gia[] = validate($_POST['other_nation']);
    }
    $quoc_gia = implode(', ', $quoc_gia);
    $mota = validate($_POST['mo_ta']);
    $theloai = $_POST['the_loai'] ?? [];
    $namphathanh = validate($_POST['nam_phat_hanh']);
    $thoiluong = validate($_POST['thoi_luong']);
    $status = validate($_POST['status']) == 1 ? 1 : 0;
    $id = uniqid('film_', false);
    $film = getByID('Phim','MaPhim',$id);
    $anh_phim = $film['data']['Anh'];
    if (isset($_FILES['anh_phim']) && $_FILES['anh_phim']['error'] == 0) {
        // If a new avatar is uploaded, delete the old one
        $filmPath = "../../uploads/film-imgs/" . $anh_phim;
        if (!empty($anh_phim) && file_exists($filmPath)) {
            $deleteResult = deleteImage($filmPath);
            if (!$deleteResult['success']) {
                $messages[] = $deleteResult['message'];
            }
        }
        $unique = uniqid('film_',false);
        // Upload the avatar with the username as the filename
        $filmResult = uploadImage($_FILES['anh_film'], "../../uploads/film-imgs/", $unique); // Pass username
        if ($avatarResult['success']) {
            $avatar = $avatarResult['filename'];
        } else {
            $messages[] = $avatarResult['message'];
        }
    }
    if (empty($messages)) {
        
        $slug = str_slug($name);
        $query = "UPDATE PHIM SET
                TenPhim = '$name',
                TenRutGon ='$slug',
                ThoiLuong ='$thoiluong',
                Anh = '$anh_phim',
                DaoDien = '$dao_dien',
                DienVien = '$dien_vien',
                QuocGia = '$quoc_gia',
                NamPhatHanh ='$namphathanh',
                PhanLoai = '$phanloai',
                MoTa = '$mota',
                NguoiCapNhat = '1', 
                NgayCapNhat = CURRENT_TIMESTAMP, 
                TrangThai = '$status'";
        if (mysqli_query($conn, $query)) {
            foreach ($theloai as $maTheLoai) {
                $insertQuery = "INSERT INTO TheLoai_Film (MaTheLoai, MaPhim) VALUES ('$maTheLoai', '$id')";
                mysqli_query($conn, $insertQuery);
            }
            redirect('../film.php', 'success', 'Cập nhật phim thành công'); 
        } else {
            redirect('../views/film/film-edit.php?id='.$id, 'error', 'Cập nhật phim thất bại');
        }
    } 
    else {
        $_SESSION['form_data'] = $_POST;
        redirect('../views/film/film-add.php', 'messages', $messages);
    }
}
//====== changeStatus ======//
if (isset($_POST['changeStatus'])) {
    $id = validate($_POST['ma_phim']);
    $status = validate($_POST['status']) == 1 ? 1 : 0;

    $edit_query = "UPDATE Phim SET TrangThai = '$status' WHERE MaPhim = '$id'";

    if (mysqli_query($conn, $edit_query)) {
        redirect('../film.php', 'success', 'Cập nhật trạng thái thành công');
    } else {
        redirect('../film.php', 'error', 'Cập nhật trạng thái thất bại');
    }
}
