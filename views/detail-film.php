<?php include('../includes/header.php');
$item = getByID('Phim', 'MaPhim', check_valid_ID('id'));
$today = new DateTime();
$selectedDate = $_POST['selected_date'] ?? $today->format('Y-m-d');
?>

<div class="banner bg-black">
    <div class="banner-overlay">
        <img src="../uploads/film-imgs/<?= htmlspecialchars($item['data']['Banner']) ?>"
            alt="<?= $item['data']['TenPhim'] ?>" class="banner-image">
    </div>
</div>

<?php
$id_result = check_valid_ID('id');
if (!is_numeric($id_result)) {
    echo '<h5>' . $id_result . '</h5>';
    return false;
}

if ($item['status'] == 200) {
    $weekdays = ['Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy', 'Chủ Nhật'];
?>

<div class="container mb-5">
    <div class="row flex-nowrap m-0">
        <div class="col-8">
            <div class="row flex-nowrap">
                <div class="col-lg-4">
                    <img src="<?= isset($item['data']['Anh']) ? '../uploads/film-imgs/' . htmlspecialchars($item['data']['Anh']) : '#' ?>"
                        alt="<?= $item['data']['TenPhim'] ?>" class="img-fluid movie-poster rounded"
                        style="border: 2px solid #fff; transform: translateY(-60px);">
                </div>
                <div class="col-lg-7 ms-1">
                    <div class="d-flex align-items-center mb-2 mt-5">
                        <h5 class="movie-title-detail me-3"><?= htmlspecialchars($item['data']['TenPhim']) ?></h5>
                        <span class="movie-age-detail bg-danger">
                            <?= htmlspecialchars($item['data']['PhanLoai'] ?? 'Chưa xác định') ?>
                        </span>
                    </div>
                    <div class="movie-meta">
                        <span class="me-3 text-black fs-6"><i class="bi bi-clock text-warning"></i>
                            <?= htmlspecialchars($item['data']['ThoiLuong'] ?? 'Updating...') ?> Phút</span>
                        <span class="text-black"><i class="bi bi-calendar text-warning"></i>
                            <?= htmlspecialchars($item['data']['NamPhatHanh'] ?? 'Updating...') ?>
                        </span>
                    </div>
                    <div class="movie-info mt-3">
                        <p><strong>Quốc gia:</strong> <?= htmlspecialchars($item['data']['QuocGia'] ?? 'Updating...') ?>
                        </p>
                        <p><strong>Thể loại:</strong>
                            <?php
                                global $conn;
                                $query = "SELECT GROUP_CONCAT(Theloai.TenTheLoai SEPARATOR ', ') AS TheLoai
                                      FROM PHIM
                                      JOIN THELOAI_FILM ON PHIM.MAPHIM = THELOAI_FILM.MAPHIM
                                      JOIN THELOAI ON THELOAI_FILM.MATHELOAI = THELOAI.MATHELOAI
                                      WHERE PHIM.MAPHIM = {$item['data']['MaPhim']}
                                      GROUP BY PHIM.MAPHIM";
                                $result = $conn->query($query);
                                echo htmlspecialchars($result->fetch_assoc()['TheLoai'] ?? 'Updating...');
                                ?>
                        </p>
                        <p><strong>Đạo diễn:</strong> <?= htmlspecialchars($item['data']['DaoDien'] ?? 'Updating...') ?>
                        </p>
                        <p><strong>Diễn viên:</strong>
                            <?= htmlspecialchars($item['data']['DienVien'] ?? 'Updating...') ?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="movie-content">
                    <h4 class="fw-bold">Nội Dung Phim</h4>
                    <p><?= htmlspecialchars($item['data']['MoTa'] ?? 'Updating...') ?></p>
                </div>
            </div>
            <div class="d-lg-flex flex-column mb-2">
                <h5 class="mb-4 mt-2 ps-3" style="border-left: 4px solid blue;">Lịch chiếu</h5>
                <div class="day h-25 border-bottom">
                    <nav class="navbar navbar-expand-lg">
                        <div class="container-fluid">
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav mr-auto text-black text-center fw-bolder" id="daysNav">
                                    <?php
                                        for ($i = 0; $i < 5; $i++) {
                                            $dateToDisplay = clone $today;
                                            $dateToDisplay->modify("+{$i} days");
                                            $dateStr = $dateToDisplay->format('Y-m-d');
                                            $weekday = $dateToDisplay->format('N');
                                            $activeClass = ($selectedDate === $dateStr) || ($i === 0 && $today->format('Y-m-d') === $dateStr) ? 'active' : '';

                                            echo "<li class='nav-item day-item'>
                                                <button type='button' class='nav-link day-link $activeClass' onclick='selectDate(\"$dateStr\")'>
                                                    {$weekdays[$weekday - 1]}<br>{$dateToDisplay->format('m/d')}
                                                </button>
                                            </li>";
                                            }
                                        ?>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>

                <div class="showtime" id="showtimeContainer">
                    <?php
                        // Fetching showtimes for the selected date or today's date if no selection
                        $formattedDate = date('Y-m-d', strtotime($selectedDate));
                        $queryShowtimes = "SELECT giochieu FROM SuatChieu WHERE MaPhim = ? AND giochieu LIKE ?";
                        $stmt = $conn->prepare($queryShowtimes);
                        $likeDate = "$formattedDate%";
                        $stmt->bind_param("is", $item['data']['MaPhim'], $likeDate);
                        $stmt->execute();
                        $resultShowtimes = $stmt->get_result();

                        // Start output buffering
                        ob_start();
                        if ($resultShowtimes->num_rows > 0) {
                            echo '<ul class="d-flex flex-row justify-content-center">';
                            while ($showtime = $resultShowtimes->fetch_assoc()) {
                                echo "<li class='time-link'>" . date('H:i', strtotime($showtime['giochieu'])) . "</li>";
                            }
                            echo '</ul>';
                        } else {
                            echo '<p>Không có giờ chiếu cho phim này vào ngày ' . htmlspecialchars(date('d/m/Y', strtotime($formattedDate))) . '.</p>';
                        }
                        $response = ob_get_clean(); // Get the buffered content
                        echo $response; // Output the response
                        ?>
                </div>
            </div>
            <div class="chair">
                <?php require_once("list-chair.php") ?>
            </div>
        </div>

        <div class="col-3 mt-5 ms-3">
            <h4 class="mb-4 text-uppercase ps-3" style="border-left: 4px solid black;">Phim đang chiếu</h4>
            <!-- Add currently showing movies list here -->
        </div>
    </div>
</div>

<?php
} else {
    echo "Không tìm thấy Phim này";
}
?>

<?php include('../includes/footer.php'); ?>
