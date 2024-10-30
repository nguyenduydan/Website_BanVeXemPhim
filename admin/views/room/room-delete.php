<?php
session_start();
require '../../../config/function.php';

$result = check_valid_ID('id');
if (is_numeric($result)) {
    $roomId = validate($result);
    $room = getByID('Phong', 'MaPhong', $roomId);

    if ($room['status'] == 200) {
        $name = validate($room['data']['TenPhong']);
        $roomDelete = deleteQuery('Phong', 'MaPhong', $roomId);
        if ($roomDelete) {
            redirect('../../room.php', 'success', 'Xóa <span class="text-danger fw-bolder">' . htmlspecialchars($name) . '</span> thành công');
        } else {
            redirect('../../room.php', 'error', 'Xóa ' . htmlspecialchars($name) . ' thất bại');
        }
    } else {
        redirect('../../room.php', 'error', $room['message']);
    }
} else {
    redirect('../../room.php', 'error', $result);
}
