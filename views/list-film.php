<div class="container mt-5 w-75">
    <h4 class="mb-4 fw-bolder">
        <span class="vertical-bar">|</span> Phim
    </h4>
    <div class="row">
        <?php
        // Mảng chứa danh sách phim
        $movies = [
            ["title" => "Thiên Đường Quả Báo", "age" => "T18", "img" => "uploads/film-imgs/anhphim.jpg"],
            ["title" => "Venom: Kèo Cuối", "age" => "T13", "img" => "uploads/film-imgs/anhphim.jpg"],
            ["title" => "Cô Dâu Hào Môn", "age" => "T18", "img" => "uploads/film-imgs/anhphim.jpg"],
            ["title" => "Tee Yod: Quỷ Ẩn Tang Phần 2", "age" => "T18", "img" => "uploads/film-imgs/anhphim.jpg"],
            ["title" => "Ngày Xưa Có Một Chuyện Tình", "age" => "T16", "img" => "uploads/film-imgs/anhphim.jpg"],
            ["title" => "Vùng Đất Bị Nguyền Rủa", "age" => "T18", "img" => "uploads/film-imgs/anhphim.jpg"],
            ["title" => "Ác Quỷ Truy Hồn", "age" => "T18", "img" => "uploads/film-imgs/anhphim.jpg"],
            ["title" => "Trò Chơi Nhân Tính", "age" => "T16", "img" => "uploads/film-imgs/anhphim.jpg"],
            ["title" => "Phim Thêm 1", "age" => "T18", "img" => "uploads/film-imgs/anhphim.jpg"],
            ["title" => "Ác Quỷ Truy Hồn", "age" => "T18", "img" => "uploads/film-imgs/anhphim.jpg"],
            ["title" => "Trò Chơi Nhân Tính", "age" => "T16", "img" => "uploads/film-imgs/anhphim.jpg"],
            ["title" => "Phim Thêm 1", "age" => "T18", "img" => "uploads/film-imgs/anhphim.jpg"],
            ["title" => "Phim Thêm 2", "age" => "T13", "img" => "uploads/film-imgs/anhphim.jpg"]
        ];
        ?>

        <div class="container">
            <div class="row">
                <?php foreach ($movies as $index => $movie): ?>
                <div class="col-12 col-sm-12 col-md-6 col-lg-3 mb-4 movie-item <?= $index >= 8 ? 'hidden' : '' ?>">
                    <div class="movie-card card">
                        <img class="img-fluid" src="<?= $movie['img'] ?>" alt="<?= $movie['title'] ?>">
                        <span class="movie-age"><?= $movie['age'] ?></span>
                        <a href="views/detail-film.php" class="buy-ticket">
                            <i class="bi bi-ticket-perforated"></i> Mua Vé
                        </a>
                    </div>
                    <div class="movie-info">
                        <div class="movie-title"><?= $movie['title'] ?></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="text-center mt-3">
                <button class="btn btn-primary" onclick="showMoreMovies()">Xem Thêm</button>
            </div>
        </div>
    </div>
</div>

<script>
function showMoreMovies() {
    const hiddenMovies = document.querySelectorAll('.movie-item.hidden');
    hiddenMovies.forEach(movie => movie.classList.remove('hidden'));
    document.querySelector('button').style.display = 'none';
}
</script>

<style>
.movie-item.hidden {
    display: none;
}
</style>