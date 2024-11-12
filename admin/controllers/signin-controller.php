<?php
session_start();
require_once '../../config/function.php';
getAdmin();
if (isset($_POST['SignIn'])) {
    $username = validate($_POST['username']);
    $password = validate($_POST['password']);
    $messages = [];

    if (empty($username)) {
        $messages['username'] = 'Tên đăng nhập không được bỏ trống';
    }
    if (empty($password)) {
        $messages['password'] = 'Mật khẩu không được bỏ trống';
    }

    if (empty($messages)) {
        $user = getByID('TaiKhoan', 'TenDangNhap', $username);

        if ($user['status'] == 200 && $user['data']['Quyen'] == 1) {
            if (password_verify($password, $user['data']['MatKhau'])) {
                $_SESSION['loggedIn'] = true;
                $_SESSION['userId'] = $user['data']['MaND'];
                $_SESSION['lastActivity'] = time();
                $_SESSION['role'] = 'admin';
                // Kiểm tra nếu checkbox 'rememberMe' được chọn
                if (isset($_POST['rememberMe']) && $_POST['rememberMe'] == '1') {
                    $_SESSION['rememberMe'] = true; // Lưu vào session

                    // Lưu cookie cho 'username' trong 30 ngày
                    setcookie('username', $username, time() + (30 * 24 * 60 * 60), "/"); // 30 ngày
                } else {
                    $_SESSION['rememberMe'] = false;

                    // Xóa cookie nếu 'rememberMe' không được chọn
                    if (isset($_COOKIE['username'])) {
                        setcookie('username', '', time() - 3600, "/");
                    }
                }

                // Điều hướng đến trang index với thông báo đăng nhập thành công
                redirect('index.php', 'success', 'Đăng nhập thành công', 'admin');
            } else {
                $_SESSION['form_data'] = $_POST;
                redirect('sign-in.php', 'error', 'Sai mật khẩu', 'admin');
            }
        } else {
            $_SESSION['form_data'] = $_POST;
            redirect('sign-in.php', 'error', 'Đăng nhập thất bại', 'admin');
        }
    } else {
        // Lưu thông tin lỗi và dữ liệu form vào session nếu có lỗi
        $_SESSION['form_data'] = $_POST;
        redirect('sign-in.php', 'messages', $messages, 'admin');
    }
}
