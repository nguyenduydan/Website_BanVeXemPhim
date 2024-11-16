<?php
require '../../../config/function.php';
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    redirect('sign-in.php', 'error', 'Vui lòng đăng nhập');
}
$result = check_valid_ID('id');
if (is_numeric($result)) {
    $topicId = validate($result);
    $topic = getByID('ChuDe', 'Id', $topicId);

    if ($topic['status'] == 200) {
        $name = validate($topic['data']['TenChuDe']);
        $topicDelete = deleteQuery('ChuDe', 'Id', $topicId);

        if ($topicDelete) {
            redirect('topic.php', 'success', 'Xóa <span class="text-danger fw-bolder">' . htmlspecialchars($name) . '</span> thành công', 'admin');
        } else {
            redirect('topic.php', 'error', 'Xóa ' . htmlspecialchars($name) . ' thất bại', 'admin');
        }
    } else {
        redirect('topic.php', 'error', $topic['message'], 'admin');
    }
} else {
    redirect('topic.php', 'error', $result, 'admin');
}
