<?php
session_start();
require '../../../config/function.php';

$result = check_valid_ID('id');
if (is_numeric($result)) {
    $categoryId = validate($result);
    $category = getByID('TheLoai', 'MaTheLoai', $categoryId);

    if ($category['status'] == 200) {
        $name = validate($category['data']['TenTheLoai']);
        $categoryDelete = deleteQuery('TheLoai', 'MaTheLoai', $categoryId);
        if ($categoryDelete) {
            redirect('../../categories.php','success','Xóa <span class="text-danger fw-bolder">' . htmlspecialchars($name) . '</span> thành công');
        } else {
            redirect('../../categories.php','error','Xóa ' . htmlspecialchars($name) . ' thất bại');
        }
    } else {
        redirect('../../categories.php','error',$category['message']);
    }
} else {
    redirect('../../categories.php','error',$result);
}
