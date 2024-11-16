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
    $id = validate($result);
    $menu = getByID('Menu', 'Id', $id);

    if ($menu['status'] == 200) {
        $name = validate($menu['data']['TenMenu']);
        $menuDelete = deleteQuery('Menu', 'Id', $id);
        if ($menuDelete) {

            redirect('menu.php', 'success', 'Xóa <span class="text-danger fw-bolder">' . htmlspecialchars($name) . '</span> thành công', 'admin');
        } else {
            redirect('menu.php', 'error', 'Xóa ' . htmlspecialchars($name) . ' thất bại', 'admin');
        }
    } else {
        redirect('menu.php', 'error', $menu['message'], 'admin');
    }
} else {
    redirect('menu.php', 'error', $result, 'admin');
}
