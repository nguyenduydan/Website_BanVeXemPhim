<?php
require '../../../config/function.php';
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    redirect('sign-in.php', 'error', 'Vui lòng đăng nhập');
}
$result = check_valid_ID('id');
if (is_numeric($result)) {
    $showtimeId = validate($result);
    $showtime = getByID('SuatChieu', 'MaSuatChieu', $showtimeId);

    if ($showtime['status'] == 200) {
        $showtimeDelete = deleteQuery('SuatChieu', 'MaSuatChieu', $showtimeId);
        if ($showtimeDelete) {
            redirect('showtime.php', 'success', 'Xóa suất chiếu thành công', 'admin');
        } else {
            redirect('showtime.php', 'error', 'Xóa suất chiếu thất bại', 'admin');
        }
    } else {
        redirect('showtime.php', 'error', $showtime['message'], 'admin');
    }
} else {
    redirect('showtime.php', 'error', $result, 'admin');
}
