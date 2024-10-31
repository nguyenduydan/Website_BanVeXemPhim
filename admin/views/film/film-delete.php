<?php
session_start();
require '../../../config/function.php';

$result = check_valid_ID('id');
if (is_numeric($result)) {
    $id = validate($result);
    $film = getByID('Phim', 'MaPhim', $id);

    if ($film['status'] == 200) {
        $name = validate($user['data']['TenPhim']);
        $filmPath = "../../../uploads/film-imgs/" . $film['data']['Anh'];
        $filmDelete = deleteQuery('NguoiDung', 'MaND', $id);


        if ($filmDelete) {
            if (!empty($film['data']['Anh']) && file_exists($avatarPath)) {
                $deleteResult = deleteImage($filmPath);
            }
            redirect('../../user.php', 'success', 'Xóa <span class="text-danger fw-bolder">' . htmlspecialchars($username) . '</span> thành công');
        } else {
            redirect('../../user.php', 'error', 'Xóa ' . htmlspecialchars($username) . ' thất bại');
        }
    } else {
        redirect('../../user.php', 'error', $user['message']);
    }
} else {
    redirect('../../user.php', 'error', $result);
}
