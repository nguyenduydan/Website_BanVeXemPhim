<?php
session_start();
require '../../../config/function.php';

$result = check_valid_ID('id');
if (is_numeric($result)) {
    $userId = validate($result);
    $user = getByID('Slider', 'id', $userId);

    if ($user['status'] == 200) {
        $username = validate($user['data']['username']);
        $avatarPath = "../../../uploads/sliders/" . $user['data']['Anh'];
        $userDelete = deleteQuery('NguoiDung', 'MaND', $userId);

       
        if ($userDelete) {
            if (!empty($user['data']['Anh']) && file_exists($avatarPath)) {
                $deleteResult = deleteImage($avatarPath);
            }
            redirect('../../user.php','success','Xóa <span class="text-danger fw-bolder">' . htmlspecialchars($username) . '</span> thành công');
        } else {
            redirect('../../user.php','error','Xóa ' . htmlspecialchars($username) . ' thất bại');
        }
    } else {
        redirect('../../user.php','error',$user['message']);
    }
} else {
    redirect('../../user.php','error',$result);
}
