<?php
require '../../../config/function.php';
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    redirect('sign-in.php', 'error', 'Vui lòng đăng nhập');
}
if (isset($_SESSION['EmployedIn']) && $_SESSION['EmployedIn'] === true) {
    redirect('index.php', 'error', 'Bạn không phải admin!','admin'); 
}
$result = check_valid_ID('id');
if (is_numeric($result)) {
    $maND = validate($result);
    $account = getByID('TaiKhoan', 'MaND', $maND);

    if ($account['status'] == 200) {
        $accountDelete = deleteQuery('TaiKhoan', 'MaND', $maND);
        if ($accountDelete) {
            redirect('accounts.php', 'success', 'Xóa tài khoản thành công', 'admin');   
        } else {    
            redirect('accounts.php', 'error', 'Xóa tài khoản thất bại', 'admin');
        }
    } else {
        redirect('accounts.php', 'error', $account['message'], 'admin');
    }
} else {
    redirect('accounts.php', 'error', $result, 'admin');
}
