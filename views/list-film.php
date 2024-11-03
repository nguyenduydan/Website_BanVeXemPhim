<?php
require_once 'config/function.php';
?>

<div class="container mt-5 w-75">
    <div class="d-flex align-items-center">
        <h4 class="mb-4 text-uppercase ps-3" style="border-left: 4px solid black;">
            Phim
        </h4>
        <ul class="nav ms-5 mb-4 d-flex justify-content-center " id="filmTabs">
            <li class="nav-item">
                <a class="nav-link active" id="currently-showing-tab" href="javascript:void(0);"
                    onclick="showTab('currently-showing')">Đang Chiếu</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="coming-soon-tab" href="javascript:void(0);" onclick="showTab('coming-soon')">Sắp
                    Chiếu</a>
            </li>
        </ul>

    </div>


    <div class="tab-content">
        <div id="currently-showing" class="tab-pane fade show active">
            <div class="row">
                <?php
                $items = getFilm('1'); //Nhập trạng thái muốn hiển thị
                foreach ($items as $value => $item): ?>
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
        </div>

        <div id="coming-soon" class="tab-pane fade">
            <div class="row">
                <?php
                $items = getFilm('2');
                foreach ($items as $value => $item): ?>
                <div class="col-12 col-sm-12 col-md-6 col-lg-3 mb-4 movie-item <?= $value >= 8 ? 'hidden' : '' ?>">
                    <div class="movie-card card">
                        <img class="img-fluid" src="uploads/film-imgs/<?= $item['Anh'] ?>"
                            alt="<?= $item['TenPhim'] ?>">
                        <span class="movie-age"><?= $item['PhanLoai'] ?></span>
                    </div>
                    <div class="movie-info">
                        <div class="movie-title"><?= $item['TenPhim'] ?></div>
                        <div class="movie-status">
                            <span class="badge bg-warning">Sắp chiếu</span>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="text-center mt-3">
        <button id="showMoreBtn" class="btn btn-outline-primary" onclick="showMoreMovies()">Xem Thêm</button>
    </div>
</div>

<script>
function showTab(tab) {
    const currentlyShowing = document.getElementById('currently-showing');
    const comingSoon = document.getElementById('coming-soon');
    const currentlyShowingTab = document.getElementById('currently-showing-tab');
    const comingSoonTab = document.getElementById('coming-soon-tab');

    if (tab === 'currently-showing') {
        currentlyShowing.classList.add('show', 'active');
        comingSoon.classList.remove('show', 'active');
        currentlyShowingTab.classList.add('active');
        comingSoonTab.classList.remove('active');
    } else {
        comingSoon.classList.add('show', 'active');
        currentlyShowing.classList.remove('show', 'active');
        comingSoonTab.classList.add('active');
        currentlyShowingTab.classList.remove('active');
    }
}

function showMoreMovies() {
    const hiddenMovies = document.querySelectorAll('.movie-item.hidden');
    hiddenMovies.forEach(movie => movie.classList.remove('hidden'));
    document.getElementById('showMoreBtn').style.display = 'none'; // Hide "Show More" button
}
</script>

<style>
.movie-item.hidden {
    display: none;
}
</style>