<?php
session_start();
require '../../config/function.php';


if (isset($_POST['addMenuTuyChon'])) {
    $name = validate($_POST['name']);
    $lienket = validate($_POST['lienket']);

    if (empty($name)) {
        $messages['name'] = 'Tên menu không được để trống';
    } else if (isExistValue('Menu', 'TenMenu', $name)) {
        $messages['name'] = 'Tên menu đã tồn tại';
    }
    if (empty($lienket)) {
        $messages['lienket'] = 'Liên kết không được để trống';
    } else if (isExistValue('Menu', 'LienKet', $lienket)) {
        $messages['lienket'] = 'Liên kết đã tồn tại';
    }

    if (empty($messages)) {
        $query = "INSERT INTO Menu (TenMenu, LienKet,TrangThai, NguoiTao, NgayTao)
                  VALUES ('$name','$lienket',0, '1',CURRENT_TIMESTAMP)";
        if (mysqli_query($conn, $query)) {
            redirect('../menu.php', 'success', 'Thêm menu thành công');
        } else {
            redirect('../menu.php', 'error', 'Thêm menu thất bại');
        }
    } else {
        $_SESSION['form_data'] = $_POST;
        redirect('../menu.php', 'messages', $messages);
    }
}

// Xử lý thêm menu
if (isset($_POST['saveMenu'])) {
    $messages = [];
    $name = validate($_POST['tenmenu']);
    $kieumenu = validate($_POST['kieumenu']);
    $vitri = validate($_POST['vitri']);
    $lienket = validate($_POST['lienket']);
    $order = validate($_POST['order']);
    $status = validate($_POST['trangthai']);
    $tableid = validate($_POST['tableid']); // Thêm trường tableid

    if (empty($name)) {
        $messages['name'] = 'Tên menu không được để trống';
    }
    if (isExistValue('Menu', 'TenMenu', $name)) {
        $messages['name'] = 'Tên menu đã tồn tại';
    }
    if (empty($kieumenu)) {
        $messages['kieumenu'] = 'Kiểu menu không được để trống';
    }
    if (empty($vitri)) {
        $messages['vitri'] = 'Vị trí không được để trống';
    }
    if (empty($lienket)) {
        $messages['lienket'] = 'Liên kết không được để trống';
    }
    if (empty($order)) {
        $messages['order'] = 'Order không được để trống';
    }

    if (empty($messages)) {
        $query = "INSERT INTO Menu (TenMenu, KieuMenu, ViTri, LienKet, Order, TrangThai, TableId, NguoiTao, NgayTao)
                  VALUES ('$name', '$kieumenu', '$vitri', '$lienket', '$order', '$status', '$tableid', 1, CURRENT_TIMESTAMP)";
        if (mysqli_query($conn, $query)) {
            redirect('../menu.php', 'success', 'Thêm menu thành công');
        } else {
            redirect('../views/menu/menu-add.php', 'error', 'Thêm menu thất bại');
        }
    } else {
        $_SESSION['form_data'] = $_POST;
        redirect('../views/menu/menu-add.php', 'messages', $messages);
    }
}

//====== Xử lý chỉnh sửa menu =======//
if (isset($_POST['editMenu'])) {
    $messages = [];
    $name = validate($_POST['tenmenu']);
    $id = validate($_POST['idmenu']);
    $kieumenu = validate($_POST['kieumenu']);
    $vitri = validate($_POST['vitri']);
    $lienket = validate($_POST['lienket']);
    $order = validate($_POST['order']);
    $status = validate($_POST['trangthai']);
    $tableid = validate($_POST['tableid']); // Thêm trường tableid

    if (empty($name)) {
        $messages['name'] = 'Tên menu không được để trống';
    }
    if (isExistValue('Menu', 'TenMenu', $name, 'IdMenu', $id)) {
        $messages['name'] = 'Tên menu đã tồn tại';
    }

    if (empty($messages)) {
        $query = "UPDATE Menu SET
                  TenMenu = '$name',
                  KieuMenu = '$kieumenu',
                  ViTri = '$vitri',
                  LienKet = '$lienket',
                  OrderMenu = '$order',
                  TrangThai = '$status',
                  TableId = '$tableid', // Cập nhật tableid
                  NguoiCapNhat = 1,
                  NgayCapNhat = CURRENT_TIMESTAMP
                  WHERE IdMenu = '$id'";

        if (mysqli_query($conn, $query)) {
            redirect('../menu.php', 'success', 'Cập nhật menu thành công');
        } else {
            redirect('../views/menu/menu-edit.php?id=' . $id, 'errors', 'Cập nhật menu thất bại');
        }
    } else {
        $_SESSION['form_data'] = $_POST;
        redirect('../views/menu/menu-edit.php?id=' . $id, 'errors', $messages);
    }
}

//====== Cập nhật trạng thái menu ======//
if (isset($_POST['changeStatus'])) {
    $id = validate($_POST['id']);
    $status = validate($_POST['status']) == 1 ? 1 : 0;

    $edit_query = "UPDATE Menu SET
                   TrangThai = '$status',
                   NguoiCapNhat = 1,
                   NgayCapNhat = CURRENT_TIMESTAMP
                   WHERE Id = '$id'";

    if (mysqli_query($conn, $edit_query)) {
        redirect('../menu.php', 'success', 'Cập nhật trạng thái thành công');
    } else {
        redirect('../menu.php', 'error', 'Cập nhật trạng thái thất bại');
    }
}

$conn->close();