<?php
require '../../../config/function.php';
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    redirect('sign-in.php', 'error', 'Vui lòng đăng nhập');
}
$result = check_valid_ID('id');
if (is_numeric($result)) {
    $Id = validate($result);
    $slider = getByID('Slider', 'Id', $Id);

    if ($slider['status'] == 200) {
        $name = validate($slider['data']['TenSlider']);
        $avatarPath = "../../../uploads/slider-imgs/" . $slider['data']['Anh'];
        $sliderDelete = deleteQuery('Slider', 'Id', $Id);


        if ($sliderDelete) {
            if (!empty($slider['data']['Anh']) && file_exists($avatarPath)) {
                $deleteResult = deleteImage($avatarPath);
            }
            redirect('slider.php', 'success', 'Xóa <span class="text-danger fw-bolder">' . htmlspecialchars($name) . '</span> thành công', 'admin');
        } else {
            redirect('slider.php', 'error', 'Xóa ' . htmlspecialchars($name) . ' thất bại', 'admin');
        }
    } else {
        redirect('slider.php', 'error', $slider['message'], 'admin');
    }
} else {
    redirect('slider.php', 'error', $result, 'admin');
}
