<div class="container mt-5">
    <h2 class="text-center mb-4">Danh sách phim</h2>
    <div class="row">
        <?php
        // Mảng chứa danh sách phim
        $movies = [
            ["title" => "Thiên Đường Quả Báo", "rating" => "9.1", "age" => "T18", "img" => "uploads/film-imgs/anh.jpg"],
            ["title" => "Venom: Kèo Cuối", "rating" => "9.1", "age" => "T13", "img" => "uploads/film-imgs/anh.jpg"],
            ["title" => "Cô Dâu Hào Môn", "rating" => "7.5", "age" => "T18", "img" => "uploads/film-imgs/anh.jpg"],
            ["title" => "Tee Yod: Quỷ Ẩn Tang Phần 2", "rating" => "9.3", "age" => "T18", "img" => "uploads/film-imgs/anh.jpg"],
            ["title" => "Ngày Xưa Có Một Chuyện Tình", "rating" => "8.6", "age" => "T16", "img" => "uploads/film-imgs/anh.jpg"],
            ["title" => "Vùng Đất Bị Nguyền Rủa", "rating" => "8.0", "age" => "T18", "img" => "uploads/film-imgs/anh.jpg"],
            ["title" => "Ác Quỷ Truy Hồn", "rating" => "8.2", "age" => "T18", "img" => "uploads/film-imgs/anh.jpg"],
            ["title" => "Trò Chơi Nhân Tính", "rating" => "7.7", "age" => "T16", "img" => "uploads/film-imgs/anh.jpg"],
        ];

        // Lặp qua từng phim để hiển thị
        foreach ($movies as $movie) {
            echo '<div class="col-md-3 mb-4">';
            echo '    <div class="movie-card card">';
            echo '        <img src="' . $movie['img'] . '" alt="' . $movie['title'] . '">';
            echo '        <div class="movie-info">';
            echo '            <div class="movie-title">' . $movie['title'] . '</div>';
            echo '            <div><span class="movie-rating">' . $movie['rating'] . '</span> <span class="movie-age">' . $movie['age'] . '</span></div>';
            echo '        </div>';
            echo '    </div>';
            echo '</div>';
        }
        ?>
    </div>
</div>