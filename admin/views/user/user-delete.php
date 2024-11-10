<?php
session_start();
require '../../../config/function.php';
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    redirect('sign-in.php', 'error', 'Vui lòng đăng nhập');
}
$result = check_valid_ID('id');
if (is_numeric($result)) {
    $userId = validate($result);
    $user = getByID('NguoiDung', 'MaND', $userId);
    if ($user['status'] == 200) {
        $username = validate($user['data']['username']);
        $avatarPath = "../../../uploads/avatars/" . $user['data']['Anh'];
        $userDelete = deleteQuery('NguoiDung', 'MaND', $userId);


        if ($userDelete) {
            if (!empty($user['data']['Anh']) && file_exists($avatarPath)) {
                $deleteResult = deleteImage($avatarPath);
            }
            redirect('user.php', 'success', 'Xóa <span class="text-danger fw-bolder">' . htmlspecialchars($username) . '</span> thành công', 'admin');
        } else {
            redirect('user.php', 'error', 'Xóa ' . htmlspecialchars($username) . ' thất bại', 'admin');
        }
    } else {
        redirect('user.php', 'error', $user['message'], 'admin');
    }
} else {
    redirect('user.php', 'error', $result, 'admin');
}
