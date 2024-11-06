<?php
session_start();
require '../../config/function.php';

// xử lý categories
$messages = [];
if (isset($_POST['signup'])) {
    $name = validate($_POST['name']);
    $password = validate($_POST['password']);
    $email = validate($_POST['email']);
    $re_password = validate($_POST['re_password']);
    $role = 0;
    $status = 1;
    if (empty($name)) {
        $messages['name'] = "Họ và tên không được để trống.";
    }elseif (isExistValue('NguoiDung', 'Email', $email)) {
        $messages['email'] = "Email đã tồn tại";
    }
    if (empty($password)) {
        $messages['password'] = "Mật khẩu không được để trống.";
    } elseif (strlen($password) < 6) {
        $messages['password'] = "Mật khẩu phải từ 6 kí tự trở lên";
    }
    if (empty($re_password)) {
        $messages['re_password'] = "Xác nhận mật khẩu không được để trống.";
    }
    $passwordDetails = validateAndHashPassword($password, $re_password);
    if (!$passwordDetails['status']) {
        $messages['re_password'] = $passwordDetails['message'];
    }
    $hashedPassword = $passwordDetails['hashed'];
    if (empty($messages)) {
        $query = "INSERT INTO nguoidung (TenND, Anh, Email, MatKhau, Role, NguoiTao, NgayTao, NguoiCapNhat, NgayCapNhat, TrangThai)
                  VALUES ('$name', NULL, '$email', '$hashedPassword', '$role', '0', CURRENT_TIMESTAMP, '0', CURRENT_TIMESTAMP, '$status')";

        if (mysqli_query($conn, $query)) {
            redirect('../../login-signup.php', 'success', 'Tạo tài khoản thành công');
        } else {
            redirect('../../login-signup.php', 'error', 'Tạo tài khoản thất bại');
        }
    } else {
        $_SESSION['form_data'] = $_POST;
        redirect('../../login-signup.php', 'messages', $messages);
    }
}

$conn->close();
