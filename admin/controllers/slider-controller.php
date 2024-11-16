<?php
require '../../config/function.php';
getAdmin();
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
              VALUES ('$tenslider', '$anh_slider', '$vitri', '$sapxep', '$trangthai', '$created', CURRENT_TIMESTAMP, '$tenTopic', '$url', '$tukhoa', '$mota')";

        if (mysqli_query($conn, $query)) {
            redirect('slider.php', 'success', 'Thêm slider thành công', 'admin');
        } else {
            redirect('views/slider/slider-add.php', 'error', 'Thêm slider thất bại', 'admin');
        }
    } else {
        $_SESSION['form_data'] = $_POST;
        redirect('views/slider/slider-add.php', 'messages', $messages, 'admin');
    }
}

if (isset($_POST['editSlider'])) {
    $messages = [];
    $idSlider = validate($_POST['idSlider']);
    $tenslider = validate($_POST['name']);
    $tenTopic = validate($_POST['nametopic']);
    $url = validate($_POST['url']);
    $tukhoa = validate($_POST['tukhoa']);
    $mota = validate($_POST['mota']);
    $vitri = validate($_POST['vitri']); // Vị trí của slider
    $sapxep = validate($_POST['sapxep']);
    $trangthai = validate($_POST['status']) == 1 ? 1 : 0;
    $anh_slider = '';

    if (empty($tenslider)) {
        $messages['name'] = "Tên slider không được để trống.";
    } elseif (isExistValue("Slider", "TenSlider", $tenslider, 'Id', $idSlider)) {
        $messages["name"] = "Tên slider đã tồn tại";
    }

    if (empty($tenTopic)) {
        $messages['nametopic'] = "Tên chủ đề không được để trống.";
    }

    if (empty($tukhoa)) {
        $messages['tukhoa'] = "Từ khóa không được để trống.";
    } elseif (isExistValue("Slider", "TuKhoa", $tenslider, 'Id', $idSlider)) {
        $messages["tukhoa"] = "Từ khóa đã tồn tại";
    }

    if (empty($mota)) {
        $messages["mota"] = "Mô tả không được để trống.";
    }
    if (empty($vitri)) {
        $messages["vitri"] = "Vị trí không được để trống.";
    }

    $item = getByID('Slider', 'Id', $idSlider);
    $anh_slider = $item['data']['Anh'];

    if (isset($_FILES['anh_slider']) && $_FILES['anh_slider']['error'] == 0) {
        $sliderPath = "../../uploads/slider-imgs/" . $anh_slider;

        if (!empty($anh_slider) && file_exists($sliderPath)) {
            $deleteResult = deleteImage($sliderPath);
            if (!$deleteResult['success']) {
                $messages[] = $deleteResult['message'];
            }
        }

        $unique = uniqid('slider_', false);

        $sliderResult = uploadImage($_FILES['anh_slider'], "../../uploads/slider-imgs/", $unique);
        if ($sliderResult['success']) {
            $anh_slider = $sliderResult['filename'];
        } else {
            $messages[] = $sliderResult['message'];
        }
    }

    if (empty($messages)) {
        $query = "UPDATE Slider
                SET TenSlider = '$tenslider',
                    Anh = '$anh_slider',
                    ViTri = '$vitri',
                    SapXep = '$sapxep',
                    TrangThai = '$trangthai',
                    NguoiCapNhat = '$created',
                    NgayCapNhat= CURRENT_TIMESTAMP,
                    TenChuDe = '$tenTopic',
                    Url = '$url',
                    TuKhoa = '$tukhoa',
                    MoTa = '$mota'
                WHERE Id = '$idSlider'";
        if (mysqli_query($conn, $query)) {
            redirect('slider.php', 'success', 'Cập nhật slider thành công', 'admin');
        } else {
            redirect('views/slider/slider-edit.php?id=' . $idSlider, 'error', 'Cập nhật slider thất bại', 'admin');
        }
    } else {
        $_SESSION['form_data'] = $_POST;
        redirect('views/slider/slider-edit.php?id=' . $idSlider, 'messages', $messages, 'admin');
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
        redirect('slider.php', 'success', 'Cập nhật trạng thái thành công', 'admin');
    } else {

        redirect('slider.php', 'error', 'Cập nhật trạng thái thất bại', 'admin');
    }
}