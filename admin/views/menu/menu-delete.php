<?php
session_start();
require '../../../config/function.php';

$result = check_valid_ID('id');
if (is_numeric($result)) {
    $id = validate($result);
    $menu = getByID('Menu', 'Id', $id);

    if ($menu['status'] == 200) {
        $name = validate($menu['data']['TenMenu']);
        $menuDelete = deleteQuery('Menu', 'Id', $id);
        if ($menuDelete) {

            redirect('../../menu.php', 'success', 'Xóa <span class="text-danger fw-bolder">' . htmlspecialchars($name) . '</span> thành công');
        } else {
            redirect('../../menu.php', 'error', 'Xóa ' . htmlspecialchars($name) . ' thất bại');
        }
    } else {
        redirect('../../menu.php', 'error', $menu['message']);
    }
} else {
    redirect('../../menu.php', 'error', $result);
}