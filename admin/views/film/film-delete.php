<?php
require '../../../config/function.php';
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    redirect('sign-in.php', 'error', 'Vui lòng đăng nhập');
}
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
        $bannerPath = "../../../uploads/film-imgs/" . $film['data']['Banner'];
        $filmDelete = deleteQuery('Phim', 'MaPhim', $id);
        if ($filmDelete) {
            if (!empty($film['data']['Anh']) && file_exists($filmPath)) {
                $deleteResult = deleteImage($filmPath);
            }
            if (!empty($film['data']['Banner']) && file_exists($bannerPath)) {
                $deleteResult = deleteImage($bannerPath);
            }
            redirect('film.php', 'success', 'Xóa <span class="text-danger fw-bolder">' . htmlspecialchars($name) . '</span> thành công', 'admin');
        } else {
            redirect('film.php', 'error', 'Xóa ' . htmlspecialchars($name) . ' thất bại', 'admin');
        }
    } else {
        redirect('film.php', 'error', $film['message'], 'admin');
    }
} else {
    redirect('film.php', 'error', $result, 'admin');
}
