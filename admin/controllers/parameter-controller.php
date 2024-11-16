<?php
require '../../config/function.php';
getAdmin();
$messages = [];
//====== room-add =======//
if (isset($_POST['saveParameter'])) {
    $messages = []; // Initialize messages array
    $tenthamso = validate($_POST['tenthamso']);
    $dvt = validate($_POST['dvt']);
    $giatri = validate($_POST['giatri']);
    $status = validate($_POST['status']) == 1 ? 1 : 0;

    if (empty($tenthamso)) {
        $messages['tenthamso'] = "Tên tham số không được để trống.";
    } elseif (isExistValue('Thamso', 'TenThamSo', $tenthamso)) {
        $messages['tenthamso'] = "Tên tham số đã tồn tại";
    }
    if (empty($dvt)) {
        $messages['dvt'] = "Đơn vị tính không được để trống.";
    }
    if (empty($giatri)) {
        $messages['giatri'] = "Giá trị không được để trống.";
    }
    if (empty($messages)) {
        $query = "INSERT INTO Thamso (Tenthamso, DonViTinh, Giatri, TrangThai)
                  VALUES ('$tenthamso','$dvt',$giatri,'$status')";

        if (mysqli_query($conn, $query)) {
            redirect('parameter.php', 'success', 'Thêm tham số thành công', 'admin');
        } else {
            redirect('views/parameter/parameter-add.php', 'error', 'Thêm tham số thất bại', 'admin');
        }
    } else {
        $_SESSION['form_data'] = $_POST;
        redirect('views/parameter/parameter-add.php', 'messages', $messages, 'admin');
    }
}

//====== room-edit =======//
if (isset($_POST['editParameter'])) {
    $messages = []; // Initialize messages array
    $tenthamso = validate($_POST['tenthamso']);
    $dvt = validate($_POST['dvt']);
    $giatri = validate($_POST['giatri']);
    $status = validate($_POST['status']) == 1 ? 1 : 0;
    $id = validate($_POST['mats']);
    if (empty($tenthamso)) {
        $messages['tenthamso'] = "Tên tham số không được để trống.";
    } else {
        // Kiểm tra tính duy nhất của tenthamso
        if (isExistValue('ThamSo', 'tenthamso', $tenthamso, 'Id', $id)) {
            $messages['tenthamso'] = "Tên tham số đã tồn tại";
        }
    }
    if (empty($messages)) {
        $query = "UPDATE Thamso SET
                Tenthamso = '$tenthamso',
                DonViTinh = '$dvt',
                Giatri = '$giatri',
                TrangThai = '$status'
                WHERE Id = '$id'";
        if (mysqli_query($conn, $query)) {
            $updateGheQuery = "UPDATE Ghe SET GiaGhe = '$giatri' WHERE LoaiGhe = '$tenthamso'";
            mysqli_query($conn, $updateGheQuery);
            redirect('parameter.php', 'success', 'Cập nhật tham số thành công', 'admin');
        } else {
            redirect('views/parameter/parameter-edit.php?id=' . $id, 'error', 'Cập nhật tham số thất bại', 'admin');
        }
    } else {
        $_SESSION['form_data'] = $_POST;
        redirect('views/parameter/parameter-edit.php?id=' . $id, 'messages', $messages, 'admin');
    }
}


//====== changeStatus ======//
if (isset($_POST['changeStatus'])) {
    $id = validate($_POST['mats']);
    $status = validate($_POST['status']) == 1 ? 1 : 0;

    $edit_query = "UPDATE thamso SET
                TrangThai = '$status'
                WHERE Id = '$id'";

    if (mysqli_query($conn, $edit_query)) {
        redirect('parameter.php', 'success', 'Cập nhật trạng thái thành công', 'admin');
    } else {
        redirect('parameter.php', 'error', 'Cập nhật trạng thái thất bại', 'admin');
    }
}
$conn->close();