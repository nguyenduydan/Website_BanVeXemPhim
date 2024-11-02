<?php
require_once 'config/function.php';
?>

<div class="container mt-5 w-75">
    <h4 class="mb-4 fw-bolder">
        <span class="vertical-bar">|</span> Phim
    </h4>
    <div class="row">
        <?php
        $items = getAll('Phim');
        ?>

        <div class="container">
            <div class="row">
                <?php foreach ($items as $value => $item): ?>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-3 mb-4 movie-item <?= $value >= 8 ? 'hidden' : '' ?>">
                        <div class="movie-card card">
                            <img class="img-fluid" src="uploads/film-imgs/<?= $item['Anh'] ?>"
                                alt="<?= $item['TenPhim'] ?>">
                            <span class="movie-age"><?= $item['PhanLoai'] ?></span>
                            <a href="views/detail-film.php" class="buy-ticket">
                                <i class="bi bi-ticket-perforated"></i> Mua Vé
                            </a>
                        </div>
                        <div class="movie-info">
                            <div class="movie-title"><?= $item['TenPhim'] ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="text-center mt-3">
                <button id="showMoreBtn" class="btn btn-outline-primary" onclick="showMoreMovies()">Xem Thêm</button>
            </div>
        </div>
    </div>
</div>

<script>
    function showMoreMovies() {
        const hiddenMovies = document.querySelectorAll('.movie-item.hidden');
        hiddenMovies.forEach(movie => movie.classList.remove('hidden'));
        document.getElementById('showMoreBtn').style.display = 'none'; // Ẩn nút "Xem Thêm"
    }
</script>

<style>
    .movie-item.hidden {
        display: none;
    }
</style>
