<?php
require '../../config/function.php';
require '../../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Exception;
getAdmin();

$messages = []; // Mảng lỗi

// Thêm thể loại
if (isset($_POST['saveCategory'])) {
    $ngay_tao = new DateTime();
    $name = validate($_POST['ten_the_loai']);
    $status = validate($_POST['status']);

    // Kiểm tra lỗi
    if (empty($name)) {
        $messages['name'] = 'Tên thể loại không được để trống';
    }
    if (isExistValue('theloai', 'TenTheLoai', $name)) {
        $messages['name'] = 'Tên thể loại đã tồn tại';
    }

    //Lưu thể loại
    if (empty($messages)) {
        $query = "INSERT INTO theloai (TenTheLoai,NguoiTao,NgayTao,NguoiCapNhat,NgayCapNhat,TrangThai)
            VALUES ('$name','$created',CURRENT_TIMESTAMP,'$created',CURRENT_TIMESTAMP,'$status')";
        if (mysqli_query($conn, $query)) {
            redirect('categories.php', 'success', 'Thêm thể loại thành công', 'admin');
        } else {
            redirect('views/category/categories-add.php', 'error', 'Thêm thể loại thất bại', 'admin');
        }
    } else {
        // Nếu có lỗi, lưu dữ liệu vào session và chuyển hướng
        $_SESSION['form_data'] = $_POST;
        redirect('views/category/categories-add.php', 'messages', $messages, 'admin');
    }
}

//Sửa thể loại
if (isset($_POST['editCategory'])) {
    $name = validate($_POST['ten_the_loai']);
    $id = validate($_POST['matl']);
    $status = validate($_POST['status']);

    // Kiểm tra lỗi
    if (empty($name)) {
        $messages['ten_the_loai'] = 'Tên thể loại không được để trống';
    }
    if (isExistValue('theloai', 'TenTheLoai', $name, 'MaTheLoai', $id)) {
        $messages['ten_the_loai'] = 'Tên thể loại đã tồn tại';
    }

    //Sửa thể loại
    if (empty($messages)) {
        $query = "UPDATE theloai SET
                TenTheLoai = '$name',
                NguoiCapNhat = '$created',
                NgayCapNhat = CURRENT_TIMESTAMP,
                TrangThai = '$status'
                WHERE MaTheLoai = '$id'";
        if (mysqli_query($conn, $query)) {
            redirect('categories.php', 'success', 'Cập nhật thể loại thành công', 'admin');
        } else {
            redirect('views/category/categories-edit.php?id=' . $id, 'errors', 'Cập nhật thể loại thất bại', 'admin');
        }
    } else {
        // Nếu có lỗi, lưu dữ liệu vào session và chuyển hướng
        $_SESSION['form_data'] = $_POST;
        redirect('views/category/categories-edit.php?id=' . $id, 'messages', $messages, 'admin');
    }
}


if (isset($_POST['changeStatus'])) {
    $id = validate($_POST['matl']);
    $status = validate($_POST['status']) == 1 ? 1 : 0;


    $edit_query = "UPDATE theloai SET
                TrangThai = '$status',
                NguoiCapNhat = '$created',
                NgayCapNhat = CURRENT_TIMESTAMP
                WHERE MaTheLoai = '$id'";

    if (mysqli_query($conn, $edit_query)) {
        redirect('categories.php', 'success', 'Cập nhật trạng thái thành công', 'admin');
    } else {
        redirect('categories.php', 'error', 'Cập nhật trạng thái thất bại', 'admin');
    }
}

if (isset($_FILES['excel_file'])) {
    $filePath = $_FILES['excel_file']['tmp_name'];
    $messages = [];
    $spreadsheet = IOFactory::load($filePath);
    $sheet = $spreadsheet->getActiveSheet();
    $data = $sheet->toArray();
    array_shift($data);

    foreach ($data as $row) {
        $name = validate(trim($row[0])); 
        $status = 1;
        if (empty($name)) {
            $messages[] = 'Tên thể loại không được để trống'; 
        } elseif (isExistValue('theloai', 'TenTheLoai', $name)) {
            $messages[] = 'Tên thể loại đã tồn tại'; 
        }

        // Lưu thể loại nếu không có lỗi
        if (empty($messages)) {
            $query = "INSERT INTO theloai (TenTheLoai, NguoiTao, NgayTao, NguoiCapNhat, NgayCapNhat, TrangThai)
                      VALUES ('$name', '$created', CURRENT_TIMESTAMP, '$created', CURRENT_TIMESTAMP, '$status')";
            if (!mysqli_query($conn, $query)) {
                $messages[] = 'Thêm thể loại thất bại'; 
            }
        }
    }

    // Xử lý thông báo
    if (!empty($messages)) {
        redirect('categories.php', 'error', 'Thêm thể loại thất bại', 'admin');
    } else {
        redirect('categories.php', 'success', 'Thêm thể loại thành công', 'admin');
    }
}
$conn->close();
