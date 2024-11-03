<?php
session_start();
require '../../../config/function.php';

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
            redirect('../../slider.php', 'success', 'Xóa <span class="text-danger fw-bolder">' . htmlspecialchars($name) . '</span> thành công');
        } else {
            redirect('../../slider.php', 'error', 'Xóa ' . htmlspecialchars($name) . ' thất bại');
        }
    } else {
        redirect('../../slider.php', 'error', $slider['message']);
    }
} else {
    redirect('../../slider.php', 'error', $result);
}