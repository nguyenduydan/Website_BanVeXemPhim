<?php
$articles = [
    [
        "link" => "link_to_article_1.html",
        "image" => "uploads/content-imgs/anhlon.jpg",
        "title" => "Chuyện Gì Đã Xảy Ra Trong Linh Miêu: Quỷ Nhập Tràng?"
    ],
    [
        "link" => "link_to_article_2.html",
        "image" => "uploads/content-imgs/anhnho1.jpg",
        "title" => "Mufasa: The Lion King Tiết Lộ Hành Trình Mufasa Trở Thành Vua Sư Tử Vĩ Đại"
    ],
    [
        "link" => "link_to_article_3.html",
        "image" => "uploads/content-imgs/anhnho2.jpg",
        "title" => "Đếm 500 Cameo Từ Deadpool & Wolverine"
    ],
    [
        "link" => "link_to_article_4.html",
        "image" => "uploads/content-imgs/anhnho3.jpg",
        "title" => "Despicable Me 4: Chúng Ta Biết Được Bao Nhiêu Về Minions?"
    ]
];
?>

<div class="container mt-5 w-75">
    <h4 class="mb-4 fw-bolder">
        <span class="vertical-bar">|</span>Góc điện ảnh
    </h4>
    <div class="row">
        <?php foreach ($articles as $article): ?>
        <div class="col-md-6 mb-3">
            <a href="views/detail-content.php" class="card-link">
                <div class="card hover-zoom">
                    <img src="<?= $article['image']; ?>" class="card-img-top" alt="Article image">
                    <div class="card-body">
                        <h5 class="card-title"><?= $article['title']; ?></h5>
                    </div>
                </div>
            </a>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="text-center mt-4">
        <button type="button" class="btn btn-outline-primary">Xem thêm</button>
    </div>
</div>