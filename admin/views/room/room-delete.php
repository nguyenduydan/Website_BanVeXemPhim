<?php
require '../../../config/function.php';
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    redirect('sign-in.php', 'error', 'Vui lòng đăng nhập');
}
if (isset($_SESSION['EmployedIn']) && $_SESSION['EmployedIn'] === true) {
    redirect('index.php', 'error', 'Bạn không phải admin!', 'admin');
}
$result = check_valid_ID('id');
if (is_numeric($result)) {
    $roomId = validate($result);
    $room = getByID('Phong', 'MaPhong', $roomId);

    if ($room['status'] == 200) {
        $name = validate($room['data']['TenPhong']);
        $roomDelete = deleteQuery('Phong', 'MaPhong', $roomId);
        if ($roomDelete) {
            redirect('room.php', 'success', 'Xóa <span class="text-danger fw-bolder">' . htmlspecialchars($name) . '</span> thành công', 'admin');
        } else {
            redirect('room.php', 'error', 'Xóa ' . htmlspecialchars($name) . ' thất bại', 'admin');
        }
    } else {
        redirect('room.php', 'error', $room['message'], 'admin');
    }
} else {
    redirect('room.php', 'error', $result, 'admin');
}
