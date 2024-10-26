<?php
session_start();
require '../../config/function.php';

$errors = [];
//====== user-add =======//
if (isset($_POST['saveUser'])) {
    $name = validate($_POST['name']);
    $username = validate($_POST['username']);
    $password = validate($_POST['password']);
    $re_password = validate($_POST['re_password']);
    $ngay_sinh = validate($_POST['ngay_sinh']);
    $gioi_tinh = validate($_POST['gioi_tinh']) == 1 ? 1 : 0;
    $sdt = validate($_POST['sdt']);
    $email = validate($_POST['email']);
    $role = validate($_POST['role']);
    $status = validate($_POST['status']) == 1 ? 1 : 0;

    //Kiểm tra không được để trống
    if (empty($name)) {
        $errors['name'] = "Họ và tên không được để trống.";
    }
    if (empty($username)) {
        $errors['username'] = "Tên người dùng không được để trống.";
    } else if (isUsername($username)) {
        $errors['username'] = "Tên người dùng đã tồn tại";
    }

    if (empty($password)) {
        $errors['password'] = "Mật khẩu không được để trống.";
    } elseif (strlen($password) < 6) {
        $errors['password'] = "Mật khẩu phải từ 6 kí tự trở lên";
    }
    if (empty($re_password)) {
        $errors['re_password'] = "Xác nhận mật khẩu không được để trống.";
    }
    if (empty($ngay_sinh)) {
        $errors['ngay_sinh'] = "Ngày sinh không được để trống.";
    }
    if (empty($email)) {
        $errors['email'] = "Email không được để trống.";
    } elseif (isEmail($email)) {
        $errors['email'] = "Email đã tồn tại";
    }


    // Hash password
    $passwordDetails = validateAndHashPassword($password, $re_password);
    if (!$passwordDetails['status']) {
        $errors['re_password'] = $passwordDetails['message'];
    }
    $hashedPassword = $passwordDetails['hashed'];

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
        $query = "INSERT INTO nguoidung (TenND, username, NgaySinh, GioiTinh, SDT, Anh, Email, MatKhau, Role, NguoiTao, NgayTao,NguoiCapNhat, NgayCapNhat, TrangThai)
                  VALUES ('$name', '$username', '$ngay_sinh', '$gioi_tinh', '$sdt', '$avatar', '$email', '$hashedPassword', '$role', '1', '$ngay_tao','1', '$ngay_tao', '$status')";

        if (mysqli_query($conn, $query)) {
            $_SESSION['success'] = 'Thêm tài khoản thành công';
            header("Location: ../user.php");
            exit();
        } else {
            $_SESSION['error'] = 'Thêm tài khoản thất bại';
            header("Location: ../views/user/user-add.php");
            exit();
        }
    } else {
        $_SESSION['errors'] = $errors; // Lưu lỗi vào session
        header("Location: ../views/user/user-add.php"); // Chuyển hướng về trang thêm người dùng
        exit();
    }
}

//====== user-edit =======//
if (isset($_POST['editUser'])) {
    $errors = [];
    $id = validate($_POST['mand']);
    $name = validate($_POST['name']);
    $username = validate($_POST['username']);
    $ngay_sinh = validate($_POST['ngay_sinh']);
    $gioi_tinh = validate($_POST['gioi_tinh']);
    $sdt = validate($_POST['sdt']);
    $email = validate($_POST['email']);
    $role = validate($_POST['role']);
    $status = validate($_POST['status']);

    // Kiểm tra tên người dùng
    if (empty($name)) {
        $errors['name'] = "Họ và tên không được để trống.";
    }
    if (empty($username)) {
        $errors['username'] = "Tên người dùng không được để trống.";
    } else {
        // Kiểm tra tính duy nhất của username
        if (isUsername($username, $id)) {
            $errors['username'] = "Tên người dùng đã tồn tại";
        }
    }
    if (empty($ngay_sinh)) {
        $errors['ngay_sinh'] = "Ngày sinh không được để trống.";
    }
    if (empty($email)) {
        $errors['email'] = "Email không được để trống.";
    } elseif (isEmail($email, $id)) {
        $errors['email'] = "Email đã tồn tại";
    }

    $user = getByID('NguoiDung', 'MaND', $id);
    if (empty($errors)) {
        if (isset($_POST['deleteAvatar'])) {
            $avatarPath = "../../uploads/avatars/" . $user['data']['Anh'];
            $deleteResult = deleteImage($avatarPath);
        }
        $avatar = $user['data']['Anh'];
        if (isset($_FILES['avatar'])) {
            $avatarResult = uploadImage($_FILES['avatar'], "../../uploads/avatars/");
            if ($avatarResult['success']) {
                $avatar =  $avatarResult['filename'];
            } else {
                $errors[] = $avatarResult['message'];
            }
        }
        $ngay_tao = date('Y-m-d H:i:s');
        $query = "UPDATE NguoiDung SET
                TenND = '$name',
                username = '$username',
                NgaySinh = '$ngay_sinh',
                GioiTinh = '$gioi_tinh',
                SDT = '$sdt',
                Anh = '$avatar',
                Email = '$email',
                Role = '$role',
                NgayCapNhat = '$ngay_tao',
                TrangThai = '$status'
                WHERE MaND = '$id'";

        if (mysqli_query($conn, $query)) {
            $_SESSION['success'] = 'Cập nhật tài khoản thành công';
            header("Location: ../user.php");
            exit();
        } else {
            $_SESSION['error'] = 'Cập nhật tài khoản thất bại';
            header("Location: ../views/user/user-edit.php?id=" . $id);
            exit();
        }
    } else {
        $_SESSION['errors'] = $errors; // Lưu lỗi vào session
        header("Location: ../views/user/user-edit.php?id=" . $id); // Chuyển hướng về trang thêm người dùng
        exit();
    }
}
