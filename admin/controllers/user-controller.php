<?php
session_start();
require '../../config/function.php'; // This includes Validator.php

$validator = new Validator(); // Instantiate the Validator class

if (isset($_POST['saveUser'])) {
    // Validate and sanitize input
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

    // Validate required fields
    $validator->validateRequired('name', $name, 'Tên không được để trống');
    $validator->validateRequired('username', $username, 'Tên đăng nhập không được để trống');
    $validator->validateRequired('password', $password, 'Mật khẩu không được để trống');
    if ($password !== $re_password) {
        $validator->validateRequired('re_password', $re_password, 'Mật khẩu không khớp');
    }

    // Check for existing username/email
    $validator->validateUsernameAndEmail($username, $email);

    


    // Hash password
    $passwordDetails = validateAndHashPassword($password, $re_password);
    if (!$passwordDetails['status']) {
        $validator->validateRequired('password', '', $passwordDetails['message']);
    }
    $hashedPassword = $passwordDetails['hashed'];

    // Collect errors
    $errors = $validator->getErrors();

    if (empty($errors)) {
        // Handle avatar upload
        $avatar = '';
        if (isset($_FILES['avatar'])) {
            $avatarResult = uploadImage($_FILES['avatar'], "../../uploads/avatars/");
            if ($avatarResult['success']) {
                $avatar =  $avatarResult['filename'];
            } else {
                $errors[] = $avatarResult['message'];
            }
        }
        // Insert into database
        $ngay_tao = date('Y-m-d H:i:s');
        $query = "INSERT INTO NguoiDung (TenND, username, NgaySinh, GioiTinh, SDT, Anh, Email, MatKhau, Role, NguoiTao, NgayTao, TrangThai)
                  VALUES ('$name', '$username', '$ngay_sinh', '$gioi_tinh', '$sdt', '$avatar', '$email', '$hashedPassword', '$role', '1', '$ngay_tao', '$status')";

        if (mysqli_query($conn, $query)) {
            $_SESSION['success'] = 'Thêm tài khoản thành công';
            header("Location: ../user.php");
            exit();
        } else {
            $_SESSION['error'] = 'Thêm tài khoản thất bại';
            header("Location: ../user-add.php");
            exit();
        }
    } else {
        $_SESSION['error'] = 'Có lỗi xảy ra, vui lòng kiểm tra lại';
        header("Location: ../user-add.php");
        exit();
    }
}
