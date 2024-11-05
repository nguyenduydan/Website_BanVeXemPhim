<?php
session_start();
require '../../../config/function.php';
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    redirect('sign-in.php', 'error', 'Vui lòng đăng nhập');
}
$result = check_valid_ID('id');
if (is_numeric($result)) {
    $parameterd = validate($result);
    $parameter = getByID('ThamSo', 'id', $parameterd);

    if ($parameter['status'] == 200) {
        $name = validate($parameter['data']['TenThamSo']);
        $parameterDelete = deleteQuery('ThamSo', 'Id', $parameterd);
        if ($parameterDelete) {
            redirect('../../parameter.php', 'success', 'Xóa <span class="text-danger fw-bolder">' . htmlspecialchars($name) . '</span> thành công');
        } else {
            redirect('../../parameter.php', 'error', 'Xóa ' . htmlspecialchars($name) . ' thất bại');
        }
    } else {
        redirect('../../parameter.php', 'error', $parameter['message']);
    }
} else {
    redirect('../../parameter.php', 'error', $result);
}
