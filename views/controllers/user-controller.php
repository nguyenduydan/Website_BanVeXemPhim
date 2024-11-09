<?php
session_start();
require '../../config/function.php';

// xử lý categories
$messages = [];
if (isset($_POST['signup'])) {
    $tennd = validate($_POST['tennd']);
    $password = validate($_POST['password']);
    $email = validate($_POST['email']);
    $re_password = validate($_POST['re_password']);
    $ngay_sinh = validate($_POST['ngay_sinh']);
    $gioi_tinh = validate($_POST['gioi_tinh']) == 1 ? 1 : 0;
    $sdt = validate($_POST['sdt']);
    $role = 0;
    $status = 1;
    if (empty($tennd)) {
        $messages['tennd'] = "Họ và tên không được để trống.";
    }
    if (empty($email)) {
        $messages['email'] = "Email không được để trống.";
    }
    if (isExistValue('NguoiDung', 'Email', $email)) {
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
    if (empty($ngay_sinh)) {
        $messages['ngay_sinh'] = "Ngày sinh không được để trống.";
    }

    $passwordDetails = validateAndHashPassword($password, $re_password);

    if ($passwordDetails['status'] == false) {
        $messages['password'] = $passwordDetails['message'];
    }
    $hashedPassword = $passwordDetails['hashed'];

    $avatar = '';
    $unique = uniqid('user_', false);
    if (isset($_FILES['avatar'])) {
        // Use usertennd as filetennd for the avatar
        $avatarResult = uploadImage($_FILES['avatar'], "../../uploads/avatars/", $unique);
        if ($avatarResult['success']) {
            $avatar = $avatarResult['filename'];
        } else {
            $messages[] = $avatarResult['message'];
        }
    }

    if (empty($messages)) {
        $query = "INSERT INTO nguoidung (TenND, NgaySinh, GioiTinh, SDT, Anh, Email, MatKhau, Role, NguoiTao, NgayTao, NguoiCapNhat, NgayCapNhat, TrangThai)
                  VALUES ('$tennd', '$ngay_sinh', '$gioi_tinh', '$sdt', '$avatar', '$email','$hashedPassword','$role' ,'0',CURRENT_TIMESTAMP, '0', CURRENT_TIMESTAMP, '$status')";

        if (mysqli_query($conn, $query)) {
            redirect('../../login.php', 'success', 'Tạo tài khoản thành công');
        } else {
            redirect('../../register.php', 'error', 'Tạo tài khoản thất bại');
        }
    } else {
        $_SESSION['form_data'] = $_POST;
        redirect('../../register.php', 'messages', $messages);
    }
}
if (isset($_POST['login'])) {
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $messages = [];

    if (empty($email)) {
        $messages['email'] = 'Email không được bỏ trống';
    }
    if (empty($password)) {
        $messages['password'] = 'Mật khẩu không được bỏ trống';
    }

    if (empty($messages)) {
        $user = getByID('NguoiDung', 'Email', $email);
        if ($user['status'] == 200 && $user['data']['Role'] == 0) {
            if (password_verify($password, $user['data']['MatKhau'])) {
                $_SESSION['NDloggedIn'] = true;
                $_SESSION['NDId'] = $user['data']['MaND'];
                redirect('../../index.php', 'success', 'Đăng nhập thành công');
            } else {
                $messages['password'] = 'Sai mật khẩu';
                $_SESSION['form_data'] = $_POST;
                redirect('../../login.php', 'messages', $messages);
            }
        } else {
            redirect('../../login.php', 'error', 'Đăng nhập thất bại');
        }
    } else {
        // Lưu thông tin lỗi và dữ liệu form vào session nếu có lỗi
        $_SESSION['form_data'] = $_POST;
        redirect('../../login.php', 'messages', $messages);
    }
}
$conn->close();
