<?php include('../includes/header.php');
$item = getByID('Phim', 'MaPhim', check_valid_ID('id'));
?>
<style>

</style>
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
?>
    <div class="container mb-5">
        <div class="row flex-nowrap m-0">
            <div class="col-8">
                <div class="row flex-nowrap">
                    <!-- Phần ảnh phim -->
                    <div class="col-lg-4">
                        <img src="<?php echo isset($item['data']['Anh']) ? '../uploads/film-imgs/' . htmlspecialchars($item['data']['Anh']) : '#'; ?>"
                            alt="<?= $item['data']['TenPhim'] ?>" class="img-fluid movie-poster rounded"
                            style="border: 2px solid #fff;transform: translateY(-60px);">
                    </div>
                    <!-- Thông tin chi tiết phim -->
                    <div class="col-lg-7 ms-1">
                        <div class="d-flex align-items-center mb-2 mt-5">
                            <h5 class="movie-title-detail me-3"><?= $item['data']['TenPhim'] ?></h5>
                            <span class="movie-age-detail bg-danger">
                                <?= $item['data']['PhanLoai'] ?? 'Chưa xác định'; ?></th></span>
                        </div>
                        <div class="movie-meta">
                            <span class="me-3 text-black fs-6"><i class="bi bi-clock text-warning"></i>
                                <?= $item['data']['ThoiLuong'] ? $item['data']['ThoiLuong'] : 'Updating...'; ?> Phút</span>
                            <span class=" text-black"><i class="bi bi-calendar text-warning "></i>
                                <?= $item['data']['NamPhatHanh'] ? $item['data']['NamPhatHanh'] : 'Updating...'; ?>
                            </span>
                        </div>
                        <div class="movie-info mt-3">
                            <p><strong>Quốc gia:
                                </strong><?= $item['data']['QuocGia'] ? $item['data']['QuocGia'] : 'Updating...'; ?></p>
                            <p><strong>Thể loại: </strong>
                                <?php
                                global $conn;
                                $query = "SELECT GROUP_CONCAT(Theloai.TenTheLoai SEPARATOR ', ') AS TheLoai
                                                    FROM PHIM
                                                    JOIN THELOAI_FILM ON PHIM.MAPHIM = THELOAI_FILM.MAPHIM
                                                    JOIN THELOAI ON THELOAI_FILM.MATHELOAI = THELOAI.MATHELOAI
                                                    WHERE PHIM.MAPHIM = {$item['data']['MaPhim']}
                                                    GROUP BY PHIM.MAPHIM";
                                $result = $conn->query($query);
                                $genres = $result->fetch_assoc()['TheLoai'];
                                echo $genres;
                                ?>
                            </p>
                            <p><strong>Đạo diễn:
                                </strong><?= $item['data']['DaoDien'] ? $item['data']['DaoDien'] : 'Updating...'; ?></p>
                            <p><strong>Diễn viên: </strong>
                                <?= $item['data']['DienVien'] ? $item['data']['DienVien'] : 'Updating...'; ?></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="movie-content">
                        <h4 class="fw-bold">Nội Dung Phim</h4>
                        <p> <?= $item['data']['MoTa'] ? $item['data']['MoTa'] : 'Updating...'; ?>
                        </p>
                    </div>
                </div>
                <div class="d-lg-flex flex-column mb-2">
                    <h5 class="mb-4 mt-2 ps-3" style="border-left: 4px solid blue;">
                        Lịch chiếu
                    </h5>

                    <div class="day h-25 border-bottom">
                        <nav class="navbar navbar-expand-lg">
                            <div class="container-fluid">
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                                    aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarNav">
                                    <ul class="navbar-nav mr-auto text-black text-center fw-bolder" id="daysNav">
                                        <!-- Days of the week will be dynamically added here -->

                                    </ul>
                                    <input type="text" name="selected_date" id="activeDay" readonly>
                                </div>
                            </div>
                        </nav>
                    </div>

                    <div class="showtime">
                        <div class="d-flex justify-content-center">
                            <ul class="d-flex flex-row" id="showtimeContainer">
                                <li class="time-link">12:30</li>
                                <li class="time-link">12:30</li>
                                <li class="time-link">12:30</li>
                                <li class="time-link">12:30</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="chair">
                    <?php require_once("list-chair.php") ?>
                </div>
            </div>
            <div class="col-3 mt-5 ms-3">
                <h4 class="mb-4 text-uppercase ps-3" style="border-left: 4px solid black;">
                    Phim đang chiếu
                </h4>
                <div class="card border-0 mb-2" style="width: 350px; height: 280px;object-fit: contain">
                    <div class="rounded movie-card w-100 h-100 d-flex justify-content-center"
                        style="object-fit: cover;overflow: hidden;">
                        <img src="../uploads/slider-imgs/slide_2.jpg" loading="lazy" alt="Thiên Đường Quả Báo"
                            style="object-fit:cover;" class="rounded d-flex w-100 h-100 justify-content-center">
                        <a href="" class="buy-ticket">
                            <i class="bi bi-ticket-perforated"></i> Mua Vé
                        </a>

                    </div>
                    <div class="card-body mt-0">
                        <h6 class="card-title m-0 p-0">Thiên Đường Quả Báo</h6>
                    </div>
                </div>
                <div class="card border-0" style="width: 350px; height: 280px;object-fit: contain">
                    <div class="rounded movie-card w-100 h-100 d-flex justify-content-center"
                        style="object-fit: cover;overflow: hidden;">
                        <img src="../uploads/slider-imgs/slide_2.jpg" loading="lazy" alt="Thiên Đường Quả Báo"
                            style="object-fit:cover;" class="rounded d-flex w-100 h-100 justify-content-center">
                        <a href="" class="buy-ticket">
                            <i class="bi bi-ticket-perforated"></i> Mua Vé
                        </a>

                    </div>
                    <div class="card-body mt-0">
                        <h6 class="card-title m-0 p-0">Thiên Đường Quả Báo</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
} else {
    echo "Không tìm thấy Phim này";
}
?>
<script>

</script>

<?php include('../includes/footer.php'); ?>
