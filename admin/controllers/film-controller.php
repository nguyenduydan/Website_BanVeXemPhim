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


// //====== film-edit =======//
// if (isset($_POST['editfilm'])) {
//     $messages = [];
//     $id = validate($_POST['maphim']);
//     $name = validate($_POST['name']);
//     $filmname = validate($_POST['filmname']);
//     $ngay_sinh = validate($_POST['ngay_sinh']);
//     $gioi_tinh = validate($_POST['gioi_tinh']);
//     $sdt = validate($_POST['sdt']);
//     $email = validate($_POST['email']);
//     $role = validate($_POST['role']);
//     $status = validate($_POST['status']);
//     if (empty($messages)) {
//         $anh_phim = '';
//         if (isset($_FILES['anh_phim'])) {
//             // Use filmname as filename for the anh_phim
//             $img_result = uploadImage($_FILES['anh_phim'], "../../uploads/phim/", $filmname); 
//             if ($img_result['success']) {
//                 $anh_phim = $img_result['filename'];
//             } else {
//                 $messages[] = $img_result['message'];
//             }
//         }

//         // Insert into database
//         $ngay_tao = date('Y-m-d H:i:s');
//         $query = "INSERT INTO nguoidung (TenND, filmname, NgaySinh, GioiTinh, SDT, Anh, Email, MatKhau, Role, NguoiTao, NgayTao, NguoiCapNhat, NgayCapNhat, TrangThai)
//                   VALUES ('$name', '$filmname', '$ngay_sinh', '$gioi_tinh', '$sdt', '$anh_phim', '$email', '$hashedPassword', '$role', '1', '$ngay_tao', '1', '$ngay_tao', '$status')";

//         if (mysqli_query($conn, $query)) {
//             redirect('../film.php', 'success', 'Thêm tài khoản thành công');
//         } else {
//             redirect('../views/film/film-add.php', 'error', 'Thêm tài khoản thất bại');
//         }
//     } else {
//         $_SESSION['form_data'] = $_POST;
//         redirect('../views/film/film-add.php', 'messages', $messages);
//     }
// }


//====== changeStatus ======//
if (isset($_POST['changeStatus'])) {
    $id = validate($_POST['mand']);
    $status = validate($_POST['status']) == 1 ? 1 : 0;

    $edit_query = "UPDATE NguoiDung SET TrangThai = '$status' WHERE MaND = '$id'";

    if (mysqli_query($conn, $edit_query)) {
        redirect('../film.php', 'success', 'Cập nhật trạng thái thành công');
    } else {
        redirect('../film.php', 'error', 'Cập nhật trạng thái thất bại');
    }
}
