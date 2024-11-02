<?php
session_start();
require '../../config/function.php';

$messages = [];
//====== slider-add =======//
if (isset($_POST['saveSlider'])) {
    // Xử lý thêm slider
    $messages = [];
    $tenslider = validate($_POST['name']);
    $tenTopic = validate($_POST['nametopic']);
    $url = validate($_POST['url']);
    $tukhoa = validate($_POST['tukhoa']);
    $mota = validate($_POST['mota']);
    $vitri = validate($_POST['vitri']); // Vị trí của slider
    $sapxep = validate($_POST['sapxep']);
    $trangthai = validate($_POST['status']) == 1 ? 1 : 0;
    $anh_slider = '';
    $id = uniqid('slider_', false);

    if (empty($tenslider)) {
        $messages['name'] = "Tên slider không được để trống.";
    } elseif (isExistValue("Slider", "TenSlider", $tenslider)) {
        $messages["name"] = "Tên slider đã tồn tại";
    }

    if (empty($tenTopic)) {
        $messages['nametopic'] = "Tên chủ đề không được để trống.";
    }

    if (empty($url)) {
        $messages['url'] = "URL không được để trống.";
    } elseif (isExistValue("Slider", "Url", $url)) {
        $messages["url"] = "Đường dẫn đã tồn tại";
    }


    if (empty($tukhoa)) {
        $messages['tukhoa'] = "Từ khóa không được để trống.";
    } elseif (isExistValue("Slider", "TuKhoa", $tenslider)) {
        $messages["tukhoa"] = "Từ khóa đã tồn tại";
    }

    if (empty($mota)) {
        $messages["mota"] = "Mô tả không được để trống.";
    }
    if (empty($vitri)) {
        $messages["vitri"] = "Vị trí không được để trống.";
    }


    if (isset($_FILES['anh_slider'])) {
        // Sử dụng tên slider làm tên file cho ảnh
        $imgResult = uploadImage($_FILES['anh_slider'], "../../uploads/slider-imgs/", $id);
        if ($imgResult['success']) {
            $anh_slider = $imgResult['filename'];
        } else {
            $messages[] = $imgResult['message'];
        }
    }



    if (empty($messages)) {
        $query = "INSERT INTO SLIDER (TenSlider, Anh, ViTri, SapXep, TrangThai, NguoiTao, NgayTao, TenChuDe, Url, TuKhoa, MoTa)
              VALUES ('$tenslider', '$anh_slider', '$vitri', '$sapxep', '$trangthai', '1', CURRENT_TIMESTAMP, '$tenTopic', '$url', '$tukhoa', '$mota')";

        if (mysqli_query($conn, $query)) {
            redirect('../slider.php', 'success', 'Thêm slider thành công');
        } else {
            redirect('../views/slider/slider-add.php', 'error', 'Thêm slider thất bại');
        }
    } else {
        $_SESSION['form_data'] = $_POST;
        redirect('../views/slider/slider-add.php', 'messages', $messages);
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

    $film = getByID('Phim', 'MaPhim', $id);
    $anh_phim = $film['data']['Anh'];

    if (isset($_FILES['anh_phim']) && $_FILES['anh_phim']['error'] == 0) {
        $filmPath = "../../uploads/film-imgs/" . $anh_phim;

        if (!empty($anh_phim) && file_exists($filmPath)) {
            $deleteResult = deleteImage($filmPath);
            if (!$deleteResult['success']) {
                $messages[] = $deleteResult['message'];
            }
        }

        $unique = uniqid('film_', false);

        $filmResult = uploadImage($_FILES['anh_phim'], "../../uploads/film-imgs/", $unique);
        if ($filmResult['success']) {
            $anh_phim = $filmResult['filename'];
        } else {
            $messages[] = $filmResult['message'];
        }
    }

    if (empty($messages)) {
        $deleteQuery = "DELETE FROM THELOAI_FILM WHERE MAPHIM = '$id'";
        mysqli_query($conn, $deleteQuery);

        $slug = str_slug($name);

        $query = "UPDATE PHIM SET
                TenPhim = '$name',
                TenRutGon = '$slug',
                ThoiLuong = '$thoiluong',
                Anh = '$anh_phim',
                DaoDien = '$dao_dien',
                DienVien = '$dien_vien',
                QuocGia = '$quoc_gia',
                NamPhatHanh = '$namphathanh',
                PhanLoai = '$phanloai',
                MoTa = '$mota',
                NguoiCapNhat = '1',
                NgayCapNhat = CURRENT_TIMESTAMP,
                TrangThai = '$status'
                WHERE MaPhim = '$id'";

        if (mysqli_query($conn, $query)) {
            foreach ($theloai as $maTheLoai) {
                $insertQuery = "INSERT INTO TheLoai_Film (MaTheLoai, MaPhim) VALUES ('$maTheLoai', '$id')";
                mysqli_query($conn, $insertQuery);
            }
            redirect('../film.php', 'success', 'Cập nhật phim thành công');
        } else {
            redirect('../views/film/film-edit.php?id=' . $id, 'error', 'Cập nhật phim thất bại');
        }
    } else {
        $_SESSION['form_data'] = $_POST;
        redirect('../views/film/film-add.php', 'messages', $messages);
    }
}

//====== changeStatus ======//
if (isset($_POST['changeStatus'])) {
    $id = validate($_POST['maslider']);
    $status = validate($_POST['status']) == 1 ? 1 : 0;

    $edit_query = "UPDATE Slider SET
            NguoiCapNhat = '1',
            NgayCapNhat = CURRENT_TIMESTAMP,
            TrangThai = '$status'
            WHERE Id = '$id'";

    if (mysqli_query($conn, $edit_query)) {
        redirect('../slider.php', 'success', 'Cập nhật trạng thái thành công');
    } else {

        redirect('../slider.php', 'error', 'Cập nhật trạng thái thất bại');
    }
}
