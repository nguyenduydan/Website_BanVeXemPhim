<?php
session_start();
require '../../../config/function.php';

$result = check_valid_ID('id');
if (is_numeric($result)) {
    $showtimeId = validate($result);
    $showtime = getByID('SuatChieu', 'MaSuatChieu', $showtimeId);

    if ($showtime['status'] == 200) {
        $showtimeDelete = deleteQuery('SuatChieu', 'MaSuatChieu', $showtimeId);
        if ($showtimeDelete) {
            redirect('../../showtime.php', 'success', 'Xóa <span class="text-danger fw-bolder">' . htmlspecialchars($showtimeId) . '</span> thành công');
        } else {
            redirect('../../showtime.php', 'error', 'Xóa ' . htmlspecialchars($showtimeId) . ' thất bại');
        }
    } else {
        redirect('../../showtime.php', 'error', $showtime['message']);
    }
} else {
    redirect('../../showtime.php', 'error', $result);
}
