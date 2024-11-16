<?php
require '../../config/function.php';
getAdmin();
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
        redirect('menu.php', 'success', 'Thêm menu thành công', 'admin');
    } else {
        $_SESSION['form_data'] = $_POST;
        redirect('menu.php', 'messages', $messages, 'admin');
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
        redirect('menu.php', 'success', 'Thêm menu thành công', 'admin');
    } else {
        $_SESSION['form_data'] = $_POST;
        redirect('menu.php', 'messages', $messages, 'admin');
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
            redirect('menu.php', 'success', 'Thêm menu thành công', 'admin');
        } else {
            redirect('menu.php', 'error', 'Thêm menu thất bại', 'admin');
        }
    } else {
        $_SESSION['form_data'] = $_POST;
        redirect('menu.php', 'messages', $messages, 'admin');
    }
}
if (isset($_POST['editMenu'])) {
    $messages = []; // Initialize messages array
    $order = validate($_POST['ordermenu']);
    $vitri = validate($_POST['vitri']);
    $id = validate($_POST['mamenu']);
    if (empty($order)) {
        $messages['ordermenu'] = "Thứ tự không được để trống.";
    }
    if (empty($messages)) {
        $menu = getByID('Menu', 'Id', $id);
        $query = "UPDATE Menu SET
                ViTri = '$vitri',
                `Order` = '$order'
                WHERE Id = '$id'";

        if (mysqli_query($conn, $query)) {
            redirect('menu.php', 'success', 'Cập nhật menu thành công', 'admin');
        } else {
            redirect('views/menu/menu-edit.php?id=' . $id, 'error', 'Cập nhật menu thất bại', 'admin');
        }
    } else {
        $_SESSION['form_data'] = $_POST;
        redirect('views/menu/menu-edit.php?id=' . $id, 'messages', $messages, 'admin');
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
        redirect('menu.php', 'success', 'Cập nhật trạng thái thành công', 'admin');
    } else {
        redirect('menu.php', 'error', 'Cập nhật trạng thái thất bại', 'admin');
    }
}

$conn->close();