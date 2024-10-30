<?php
session_start();
require '../../../config/function.php';

$result = check_valid_ID('id');
if (is_numeric($result)) {
    $contentId = validate($result);
    $content = getByID('NguoiDung', 'MaND', $contentId);

    if ($content['status'] == 200) {
        $contentname = validate($content['data']['contentname']);
        $avatarPath = "../../../uploads/avatars/" . $content['data']['Anh'];
        $contentDelete = deleteQuery('NguoiDung', 'MaND', $contentId);

       
        if ($contentDelete) {
            if (!empty($content['data']['Anh']) && file_exists($avatarPath)) {
                $deleteResult = deleteImage($avatarPath);
            }
            redirect('../../content.php','success','Xóa <span class="text-danger fw-bolder">' . htmlspecialchars($contentname) . '</span> thành công');
        } else {
            redirect('../../content.php','error','Xóa ' . htmlspecialchars($contentname) . ' thất bại');
        }
    } else {
        redirect('../../content.php','error',$content['message']);
    }
} else {
    redirect('../../content.php','error',$result);
}
