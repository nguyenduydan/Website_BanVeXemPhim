<?php
session_start();
require '../../../config/function.php';

$result = check_valid_ID('id');
if (is_numeric($result)) {
    $id = validate($result);
    $film = getByID('Phim', 'MaPhim', $id);

    if ($film['status'] == 200) {
        $id_film = $film['data']['MaPhim'];
        global $conn;
        $query = "DELETE FROM THELOAI_FILM WHERE MAPHIM = '$id_film'";
        mysqli_query($conn, $query);
        $name = validate($film['data']['TenPhim']);
        $filmPath = "../../../uploads/film-imgs/" . $film['data']['Anh'];
        $filmDelete = deleteQuery('Phim', 'MaPhim', $id);
        if ($filmDelete) {
            if (!empty($film['data']['Anh']) && file_exists($filmPath)) {
                $deleteResult = deleteImage($filmPath);
            }
            redirect('../../film.php', 'success', 'Xóa <span class="text-danger fw-bolder">' . htmlspecialchars($name) . '</span> thành công');
        } else {
            redirect('../../film.php', 'error', 'Xóa ' . htmlspecialchars($name) . ' thất bại');
        }
    } else {
        redirect('../../film.php', 'error', $film['message']);
    }
} else {
    redirect('../../film.php', 'error', $result);
}
