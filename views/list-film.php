<div class="container mt-5">
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
        ];

        // Lặp qua từng phim để hiển thị
        foreach ($movies as $movie) {
            echo '<div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">'; // Thay đổi cấu trúc cột
            echo '    <div class="movie-card card">';
            echo '        <img class="img-fluid" src="' . $movie['img'] . '" alt="' . $movie['title'] . '">';
            echo '        <span class="movie-age">' . $movie['age'] . '</span>';
            echo '        <a href="views/detail-film.php" class="buy-ticket"><i class="bi bi-ticket-perforated"></i> Mua Vé</a>';
            echo '    </div>';
            echo '    <div class="movie-info">';
            echo '        <div class="movie-title">' . $movie['title'] . '</div>';
            echo '    </div>';
            echo '</div>';
        }
        ?>
    </div>
</div>