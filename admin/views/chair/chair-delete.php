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
    $chairId = validate($result);
    $chair = getByID('Ghe', 'MaGhe', $chairId);

    if ($chair['status'] == 200) {
        $name = validate($chair['data']['TenGhe']);
        $chairDelete = deleteQuery('Ghe', 'MaGhe', $chairId);


        if ($chairDelete) {
            redirect('chair.php', 'success', 'Xóa <span class="text-danger fw-bolder">' . htmlspecialchars($name) . '</span> thành công', 'admin');
        } else {
            redirect('chair.php', 'error', 'Xóa ' . htmlspecialchars($name) . ' thất bại', 'admin');
        }
    } else {
        redirect('chair.php', 'error', $chair['message'], 'admin');
    }
} else {
    redirect('chair.php', 'error', $result, 'admin');
}