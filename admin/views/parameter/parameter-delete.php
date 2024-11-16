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
    $parameterd = validate($result);
    $parameter = getByID('ThamSo', 'id', $parameterd);

    if ($parameter['status'] == 200) {
        $name = validate($parameter['data']['TenThamSo']);
        $parameterDelete = deleteQuery('ThamSo', 'Id', $parameterd);
        if ($parameterDelete) {
            redirect('parameter.php', 'success', 'Xóa <span class="text-danger fw-bolder">' . htmlspecialchars($name) . '</span> thành công', 'admin');
        } else {
            redirect('parameter.php', 'error', 'Xóa ' . htmlspecialchars($name) . ' thất bại', 'admin');
        }
    } else {
        redirect('parameter.php', 'error', $parameter['message'], 'admin');
    }
} else {
    redirect('parameter.php', 'error', $result, 'admin');
}
