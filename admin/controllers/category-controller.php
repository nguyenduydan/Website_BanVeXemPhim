<?php
session_start();
require '../../config/function.php';
getAdmin(); // Kiểm tra quyền truy cập của admin, chỉ cho phép admin truy cập

$messages = []; // Khởi tạo mảng lưu thông báo lỗi

// Xử lý lưu thể loại mới
if (isset($_POST['saveCategory'])) {
    $ngay_tao = new DateTime(); // Lấy ngày giờ hiện tại
    $name = validate($_POST['ten_the_loai']); // Lấy tên thể loại từ form và validate
    $status = validate($_POST['status']); // Lấy trạng thái từ form và validate

    // Kiểm tra lỗi
    if (empty($name)) {
        $messages['name'] = 'Tên thể loại không được để trống';
    }
    if (isExistValue('theloai', 'TenTheLoai', $name)) { // Kiểm tra xem tên thể loại đã tồn tại chưa
        $messages['name'] = 'Tên thể loại đã tồn tại';
    }

    // Nếu không có lỗi, tiến hành thêm thể loại
    if (empty($messages)) {
        $query = "INSERT INTO theloai (TenTheLoai,NguoiTao,NgayTao,NguoiCapNhat,NgayCapNhat,TrangThai)
            VALUES ('$name','$created',CURRENT_TIMESTAMP,'$created',CURRENT_TIMESTAMP,'$status')"; // Câu truy vấn thêm mới
        if (mysqli_query($conn, $query)) {
            redirect('categories.php', 'success', 'Thêm thể loại thành công', 'admin'); // Thêm thành công
        } else {
            redirect('views/category/categories-add.php', 'error', 'Thêm thể loại thất bại', 'admin'); // Thêm thất bại
        }
    } else {
        // Nếu có lỗi, lưu dữ liệu vào session và chuyển hướng
        $_SESSION['form_data'] = $_POST;
        redirect('views/category/categories-add.php', 'messages', $messages, 'admin');
    }
}

//====== Xử lý cập nhật thể loại (categories-edit) =======//
if (isset($_POST['editCategory'])) {
    $messages = [];
    $name = validate($_POST['ten_the_loai']); // Lấy và validate tên thể loại mới
    $id = validate($_POST['matl']); // Lấy và validate ID thể loại cần cập nhật
    $status = validate($_POST['status']); // Lấy và validate trạng thái mới

    // Kiểm tra lỗi
    if (empty($name)) {
        $messages['ten_the_loai'] = 'Tên thể loại không được để trống';
    }
    if (isExistValue('theloai', 'TenTheLoai', $name, 'MaTheLoai', $id)) { // Kiểm tra trùng tên thể loại (ngoại trừ thể loại hiện tại)
        $messages['ten_the_loai'] = 'Tên thể loại đã tồn tại';
    }

    // Nếu không có lỗi, tiến hành cập nhật
    if (empty($messages)) {
        $query = "UPDATE theloai SET
                TenTheLoai = '$name',
                NguoiCapNhat = '$created',
                NgayCapNhat = CURRENT_TIMESTAMP,
                TrangThai = '$status'
                WHERE MaTheLoai = '$id'"; // Câu truy vấn cập nhật
        if (mysqli_query($conn, $query)) {
            redirect('categories.php', 'success', 'Cập nhật thể loại thành công', 'admin'); // Cập nhật thành công
        } else {
            redirect('views/category/categories-edit.php?id=' . $id, 'errors', 'Cập nhật thể loại thất bại', 'admin'); // Cập nhật thất bại
        }
    } else {
        // Nếu có lỗi, lưu dữ liệu vào session và chuyển hướng
        $_SESSION['form_data'] = $_POST;
        redirect('views/category/categories-edit.php?id=' . $id, 'messages', $messages, 'admin');
    }
}

//====== Xử lý cập nhật trạng thái thể loại (categories-changeStatus) =======//
if (isset($_POST['changeStatus'])) {
    $id = validate($_POST['matl']); // Lấy và validate ID thể loại cần cập nhật trạng thái
    $status = validate($_POST['status']) == 1 ? 1 : 0; // Lấy trạng thái mới và kiểm tra tính hợp lệ (chỉ nhận 1 hoặc 0)

    // Câu truy vấn cập nhật trạng thái
    $edit_query = "UPDATE theloai SET
                TrangThai = '$status',
                NguoiCapNhat = '$created',
                NgayCapNhat = CURRENT_TIMESTAMP
                WHERE MaTheLoai = '$id'";

    if (mysqli_query($conn, $edit_query)) {
        redirect('categories.php', 'success', 'Cập nhật trạng thái thành công', 'admin'); // Cập nhật trạng thái thành công
    } else {
        redirect('categories.php', 'error', 'Cập nhật trạng thái thất bại', 'admin'); // Cập nhật trạng thái thất bại
    }
}

$conn->close(); // Đóng kết nối database