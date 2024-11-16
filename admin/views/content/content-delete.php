<?php
require '../../../config/function.php';
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    redirect('sign-in.php', 'error', 'Vui lòng đăng nhập');
}
$result = check_valid_ID('id');
if (is_numeric($result)) {
    $contentId = validate($result);
    $content = getByID('BaiViet', 'Id', $contentId);

    if ($content['status'] == 200) {
        $contentname = validate($content['data']['contentname']);
        $avatarPath = "../../../uploads/avatars/" . $content['data']['Anh'];
        $contentDelete = deleteQuery('BaiViet', 'Id', $contentId);


        if ($contentDelete) {
            if (!empty($content['data']['Anh']) && file_exists($avatarPath)) {
                $deleteResult = deleteImage($avatarPath);
            }
            redirect('content.php', 'success', 'Xóa <span class="text-danger fw-bolder">' . htmlspecialchars($contentname) . '</span> thành công', 'admin');
        } else {
            redirect('content.php', 'error', 'Xóa ' . htmlspecialchars($contentname) . ' thất bại', 'admin');
        }
    } else {
        redirect('content.php', 'error', $content['message'], 'admin');
    }
} else {
    redirect('content.php', 'error', $result, 'admin');
}
