<?php
session_start();
require '../../../config/function.php';
$result = check_valid_ID('id');
if (is_numeric($result)) {
    $userId = validate($result);
    $user = getByID('NguoiDung', 'MaND', $userId);
    $username = validate($user['data']['username']);
    if ($user['status'] == 200) {
        $userDelete = deleteQuery('NguoiDung', 'MaND', $userId);
        if ($userDelete) {
            $_SESSION['success'] = 'Xóa <span class="text-danger fw-bolder">' . htmlspecialchars($username) . '</span> thành công';
            header("Location: ../../user.php");
            exit();
        } else {
            $_SESSION['error'] = 'Xóa ' . $username . ' thất bại';
            header("Location: ../../user.php");
            exit();
        }
    } else {
        $_SESSION['error'] = $result['message'];
        header("Location: ../../user.php");
        exit();
    }
} else {
    $_SESSION['error'] = $result;
    header("Location: ../../user.php");
    exit();
}
