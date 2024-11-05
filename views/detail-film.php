<?php include('../includes/header.php');
$item = getByID('Phim', 'MaPhim', check_valid_ID('id'));
?>
<style>
    .banner {
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        height: 550px;
        overflow: hidden;
        padding: 0 10rem;
    }

    .banner-image {
        width: 100%;
        height: 100%;
        opacity: 0.7;
    }

    .banner-overlay {
        position: relative;
        height: 100%;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
        background: rgba(0, 0, 0, 0.5);
    }

    .card .card-movie.hover .buy-ticket {
        display: block;
    }
</style>
<div class="banner bg-black">
    <div class="banner-overlay">
        <?php
        // Kết nối đến cơ sở dữ liệu (giả sử biến $conn đã được thiết lập trước đó)
        $query = "SELECT * FROM Slider WHERE ViTri = 'aside'";
        $result = $conn->query($query);

        // Kiểm tra xem có dữ liệu từ bảng Slider không
        if ($result && $firstSlide = $result->fetch_assoc()): ?>
            <img src="../uploads/slider-imgs/<?= htmlspecialchars($firstSlide['Anh']) ?>" alt="Venom: Kèo Cuối"
                class="banner-image">
        <?php else: ?>
            <p>Không có hình ảnh để hiển thị.</p>
        <?php endif; ?>
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
                                <?= "T" . $item['data']['PhanLoai'] ?? 'Chưa xác định'; ?></th></span>
                        </div>
                        <div class="movie-meta">
                            <span class="me-3 text-black fs-6"><i class="bi bi-clock text-warning"></i>
                                <?= $item['data']['ThoiLuong'] ? $item['data']['ThoiLuong'] : 'Updating...'; ?> Phút</span>
                            <span class=" text-black"><i class="bi bi-calendar text-warning "></i>
                                <?php
                                $query = "SELECT GioChieu FROM SuatChieu WHERE MaPhim = {$item['data']['MaPhim']}";
                                $result = $conn->query($query);
                                if ($result && $showtime = $result->fetch_assoc()) {
                                    // Giả sử 'GioChieu' là một chuỗi ngày giờ
                                    $dateTime = new DateTime($showtime['GioChieu']);
                                    // Định dạng lại thành 'dd/mm/yyyy'
                                    echo htmlspecialchars($dateTime->format('d/m/Y'));
                                } else {
                                    echo "Updating...";
                                }
                                ?>
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
<?php include('../includes/footer.php'); ?>
