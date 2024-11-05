<?php
session_start();
require '../../config/function.php';
if (isset($_POST['SignIn'])) {
    $username = validate($_POST['username']);
    $password = validate($_POST['password']);
    $messages =[];
    if(empty($username)){
        $messages['username'] = 'Tên đăng nhập không được bỏ trống';
    }
    if(empty($password)){
        $messages['password'] = 'Mật khẩu không được bỏ trống';
    }
    if(empty($messages)){
        $user = getByID('NguoiDung','username',$username);
        if ($user['status'] == 200) {
            if(password_verify($password, $user['data']['MatKhau'])){
                $_SESSION['loggedIn'] = true;
                $_SESSION['userId'] = $user['data']['MaND'];
                redirect('../index.php', 'success', 'Đăng nhập thành công');
            } else {
                redirect('../sign-in.php', 'error', 'Sai mật khẩu');
            }
        } else {
            redirect('../sign-in.php', 'error', 'Đăng nhập thất bại');
        }
    }
    else{
        $_SESSION['form_data'] = $_POST;
        redirect('../sign-in.php', 'messages', $messages);
    }
}
?>