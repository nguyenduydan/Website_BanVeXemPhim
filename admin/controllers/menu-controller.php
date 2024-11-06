<?php
session_start();
require '../../config/function.php';


if (isset($_POST['addPhim'])) {
    $vitri = validate($_POST['vitri']);
    $list_phim = $_POST['phim'] ?? [];
    $messages = [];
    if (empty($messages)) {
        foreach ($list_phim as $ma_phim) {
            $film_query = "SELECT MaPhim, TenPhim FROM Phim WHERE MaPhim = '$ma_phim'";
            $result = mysqli_query($conn, $film_query);
            $film = mysqli_fetch_assoc($result);
            if ($film) {
                $tenMenu = $film['TenPhim'];
                $tableid = $film['MaPhim'];
                $kieumenu = "Phim";
                $slug = str_slug($film['TenPhim']);
                $status = 0;
            }
            $query = "INSERT INTO Menu(TenMenu, TableId, KieuMenu, ViTri, LienKet, `Order`, NguoiTao, NgayTao, NguoiCapNhat, NgayCapNhat,TrangThai)
                      VALUES ('$tenMenu','$tableid','$kieumenu','$vitri','$slug','1','1',CURRENT_TIMESTAMP, '1',CURRENT_TIMESTAMP, '$status')";
            mysqli_query($conn, $query);
        }
        redirect('../menu.php', 'success', 'Thêm menu thành công');
    } else {
        $_SESSION['form_data'] = $_POST;
        redirect('../menu.php', 'messages', $messages);
    }
}

if (isset($_POST['addChuDe'])) {
    $vitri = validate($_POST['vitri']);
    $list_chude = $_POST['chude'] ?? [];
    $messages = [];
    if (empty($messages)) {
        foreach ($list_chude as $id) {
            $topic_query = "SELECT Id, TenChuDe FROM ChuDe WHERE Id = '$id'";
            $result = mysqli_query($conn, $topic_query);
            $topic = mysqli_fetch_assoc($result);
            if ($topic) {
                $tenMenu = $topic['TenChuDe'];
                $tableid = $topic['Id'];
                $kieumenu = "ChuDe";
                $slug = str_slug($topic['TenChuDe']);
                $status = 0;
            }
            $query = "INSERT INTO Menu(TenMenu, TableId, KieuMenu, ViTri, LienKet, `Order`, NguoiTao, NgayTao, NguoiCapNhat, NgayCapNhat,TrangThai)
                      VALUES ('$tenMenu','$tableid','$kieumenu','$vitri','$slug','1','1',CURRENT_TIMESTAMP, '1',CURRENT_TIMESTAMP, '$status')";
            mysqli_query($conn, $query);
        }
        redirect('../menu.php', 'success', 'Thêm menu thành công');
    } else {
        $_SESSION['form_data'] = $_POST;
        redirect('../menu.php', 'messages', $messages);
    }
}
if (isset($_POST['addCustom'])) {
    $vitri = validate($_POST['vitri']);
    $name = validate($_POST['name']);
    $lienket = validate($_POST['lienket']);
    $messages = [];
    if (empty($name)) {
        $messages['name'] = 'Tên menu không được bỏ trống';
    }

    if (empty($messages)) {
        $tableid = $topic['Id'];
        $kieumenu = "Custom";
        $status = 0;

        $query = "INSERT INTO Menu(TenMenu, TableId, KieuMenu, ViTri, LienKet, `Order`, NguoiTao, NgayTao, NguoiCapNhat, NgayCapNhat,TrangThai)
                    VALUES ('$name',NULL,'$kieumenu','$vitri','$lienket','1','1',CURRENT_TIMESTAMP, '1',CURRENT_TIMESTAMP, '$status')";
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
        redirect('../views/menu/menu-edit.php?id=' . $id, 'messages', $messages);
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