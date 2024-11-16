<?php
require_once '../../config/function.php';
getAdmin();

if (isset($_POST['SignIn'])) {
    $username = validate($_POST['username']);
    $password = validate($_POST['password']);
    $messages = [];

    // Validate input
    if (empty($username)) {
        $messages['username'] = 'Tên đăng nhập không được bỏ trống';
    }
    if (empty($password)) {
        $messages['password'] = 'Mật khẩu không được bỏ trống';
    }

    if (empty($messages)) {
        $user = getByID('TaiKhoan', 'TenDangNhap', $username);

        if ($user['status'] == 200 && $user['data']['Quyen'] >= 1) {
            $_SESSION['loggedIn'] = true;
            $_SESSION['userId'] = $user['data']['MaND'];
            $_SESSION['role'] = 'admin';
            $_SESSION['lastActivity'] = time();

            if (password_verify($password, $user['data']['MatKhau'])) {
                if ($user['data']['Quyen'] > 1) {
                    $_SESSION['EmployedIn'] = true;   
                }
                if (isset($_POST['rememberMe']) && $_POST['rememberMe'] == '1') {
                    $_SESSION['rememberMe'] = true;
                    setcookie('username', $username, time() + (30 * 24 * 60 * 60), "/");
                } else {
                    $_SESSION['rememberMe'] = false;
                    if (isset($_COOKIE['username'])) {
                        setcookie('username', '', time() - 3600, "/");
                    }
                }
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
        $_SESSION['form_data'] = $_POST;
        redirect('sign-in.php', 'messages', $messages, 'admin');
    }
}