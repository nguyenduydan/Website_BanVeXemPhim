<?php
require '../../config/function.php';
session_start(); // Bắt đầu phiên làm việc với session

$errors = [];

if (isset($_POST['saveUser'])) {
    $name = validate($_POST['name']);
    $username = validate($_POST['username']);
    $password = validate($_POST['password']);
    $re_password = validate($_POST['re_password']);
    $ngay_sinh = validate($_POST['ngay_sinh']);
    $gioi_tinh = validate($_POST['gioi_tinh']);
    $sdt = validate($_POST['sdt']);
    $email = validate($_POST['email']);
    $role = validate($_POST['role']);
    $status = validate($_POST['status']);

    // Kiểm tra tên đăng nhập hoặc email tồn tại
    if (isUsernameAndEmailExists($username, $email)) {
        $_SESSION['error'] = 'Tên đăng nhập hoặc email đã tồn tại, vui lòng sử dụng tên khác';
        header("Location: ../user.php"); // Thay "user.php"
        exit();
    }

    $avatar = '';
    if (isset($_FILES['avatar'])) {
        $avatarResult = uploadAvatar($_FILES['avatar'], "upload/avatars/");
        if ($avatarResult['success']) {
            $avatar = $avatarResult['filename'];
        } else {
            $errors[] = $avatarResult['message'];
        }
    }

    // Kiểm tra và băm mật khẩu
    $passwordDetails = validateAndHashPassword($password, $re_password);
    if (!$passwordDetails['status']) {
        $errors[] = $passwordDetails['message'];
    }
    $hashedPassword = $passwordDetails['hashed'];

    if (empty($errors)) {
        $ngay_tao = date('Y-m-d H:i:s');
        $query = "INSERT INTO NguoiDung (TenND, username, NgaySinh, GioiTinh, SDT, Anh, Email, MatKhau, Role, NguoiTao, NgayTao, TrangThai)
                  VALUES ('$name', '$username', '$ngay_sinh', '$gioi_tinh', '$sdt', '$avatar', '$email', '$hashedPassword', '$role', '1', '$ngay_tao', '$status')";

        $result = mysqli_query($conn, $query);
        if ($result) {
            $_SESSION['success'] = 'Thêm tài khoản thành công';
            header("Location: ../user.php"); // Thay "user.php"
            exit();
        } else {
            $errors[] = 'Thêm tài khoản thất bại';
        }
    }

    // Nếu có lỗi
    if ($errors) {
        $_SESSION['error'] = implode(', ', $errors);
        header("Location: ../user.php"); // Thay "user.php"
        exit();
    }
}
