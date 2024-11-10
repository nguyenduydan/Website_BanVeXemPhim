<?php
$current_url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
require_once $_SERVER['DOCUMENT_ROOT'] . "/Website_BanVeXemPhim/config/function.php";
getUser();
?>
<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light navbar-blur p-3">
    <div class="container-fluid mx-5">
        <div class="container">
            <div class="d-flex row flex-lg-nowrap align-items-center justify-content-center justify-content-lg-center">
                <!-- Logo -->
                <div class="col-3 d-lg-flex row text-center col-lg-2 justify-content-center me-lg-auto mb-md-0">
                    <div class="col-6">
                        <a href="http://localhost/Website_BanVeXemPhim/index.php" class="me-3">
                            <img src="/Website_BanVeXemPhim/assets/imgs/logo-100x100.png" style="width: 60px;"
                                class="bg-dark rounded-circle">
                        </a>
                    </div>
                    <div class="text d-none d-lg-block col-6 position-relative mt-1">
                        <!-- Đặt chiều cao để chứa văn bản -->
                        <p class="mb-0 position-absolute" style="left: 0;">
                            <!-- Đảm bảo các từ không bị cắt -->
                            <span class="word wisteria">ticket</span>
                            <span class="word belize">cheap</span>
                            <span class="word pomegranate">dino</span>
                            <span class="word green">fate</span>
                            <span class="word midnight">fogvn</span>
                        </p>
                    </div>
                </div>

                <!-- Offcanvas sidebar cho menu trên màn hình nhỏ -->
                <div class="offcanvas offcanvas-end w-100" tabindex="-1" id="offcanvasMenu"
                    aria-labelledby="offcanvasMenuLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasMenuLabel">Menu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <?php
                        $items = getMenu('Menu');
                        $baseUrl = "http://" . $_SERVER['HTTP_HOST'] . "/Website_BanVeXemPhim/";
                        ?>
                        <ul
                            class="nav flex-lg-row flex-column col-lg-12 col-sm-12 me-lg-auto mb-2 justify-content-start justify-content-lg-center mb-md-0">
                            <?php foreach ($items as $item): ?>
                            <li class="nav-item dropdown mx-2">
                                <a href="<?= $baseUrl . $item['LienKet'] ?>" aria-expanded="false"
                                    id="<?= ($item['TenMenu'] == 'Phim') ? 'phim' : '' ?>"
                                    class="nav-link px-2 fw-bolder text-capitalize text-secondary <?= ($current_url === $baseUrl . $item['LienKet']) ? 'active' : '' ?>">
                                    <?= htmlspecialchars($item['TenMenu']) ?>
                                </a>

                                <?php if ($item['TenMenu'] == 'Phim'): ?>
                                <ul class="dropdown-menu shadow border-0 w-100 py-3 px-2"
                                    style="width:45rem !important;left: -50px;" aria-labelledby="phim">
                                    <li class="px-3 py-2">
                                        <h6 class="mb-3 text-uppercase ps-3" style="border-left: 4px solid #15036c;">
                                            Phim đang chiếu
                                        </h6>
                                        <div class="row g-3">
                                            <?php
                                                    $items = getFilm('1'); //Nhập trạng thái muốn hiển thị
                                                    $countCurrentlyShowing = count($items);
                                                    foreach ($items as $value => $item): ?>
                                            <div
                                                class="col-12 col-sm-12 col-md-6 col-lg-3 <?= $value >= 4 ? 'd-none' : '' ?>">
                                                <div class="movie-card card">
                                                    <img class="img-fluid" style="height: 200px; width:280px"
                                                        src="/Website_BanVeXemPhim/uploads/film-imgs/<?= $item['Anh'] ?>"
                                                        alt="<?= $item['TenPhim'] ?>">
                                                    <span class="movie-age"><?= $item['PhanLoai'] ?></span>
                                                    <a style="width: 100px; font-size: 13px; padding: 10px 7px"
                                                        href="/Website_BanVeXemPhim/views/detail-film.php?id=<?= $item['MaPhim'] ?>"
                                                        class="buy-ticket text-center align-items-center">
                                                        <i class="bi bi-ticket-perforated"></i> Mua Vé
                                                    </a>
                                                </div>
                                                <div class="movie-info">
                                                    <small
                                                        class="movie-title fs-6 fw-bold"><?= $item['TenPhim'] ?></small>
                                                </div>
                                            </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </li>
                                    <li class="px-3 py-2 mt-2">
                                        <h6 class="mb-3 text-uppercase ps-3" style="border-left: 4px solid #15036c;">
                                            Phim sắp chiếu
                                        </h6>
                                        <div class="row g-3">
                                            <?php
                                                    $items = getFilm('2'); //Nhập trạng thái muốn hiển thị
                                                    $countCurrentlyShowing = count($items);
                                                    foreach ($items as $value => $item): ?>
                                            <div
                                                class="col-12 col-sm-12 col-md-6 col-lg-3<?= $value >= 4 ? 'd-none' : '' ?>">
                                                <div class="movie-card card">
                                                    <img class="img-fluid" style="height: 200px; width:280px"
                                                        src="/Website_BanVeXemPhim/uploads/film-imgs/<?= $item['Anh'] ?>"
                                                        alt="<?= $item['TenPhim'] ?>">
                                                    <span class="movie-age"><?= $item['PhanLoai'] ?></span>
                                                    <a style="width: 100px; font-size: 13px; padding: 10px 7px"
                                                        href="views/detail-film.php?id=<?= $item['MaPhim'] ?>"
                                                        class="buy-ticket text-center align-items-center">
                                                        <i class="bi bi-ticket-perforated"></i> Mua Vé
                                                    </a>
                                                </div>
                                                <div class="movie-info">
                                                    <small
                                                        class="movie-title fs-6 fw-bold"><?= $item['TenPhim'] ?></small>
                                                </div>
                                            </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </li>
                                </ul>
                                <?php endif; ?>
                            </li>
                            <?php endforeach; ?>
                        </ul>

                        <style>
                        /* Hiện dropdown khi hover */
                        .nav-item.dropdown:hover .dropdown-menu {
                            display: block;
                        }

                        /* Ẩn dropdown mặc định */
                        .dropdown-menu {
                            display: none;
                            transition: all .3s ease-in-out;
                        }
                        </style>
                    </div>
                </div>

                <!-- Phần tìm kiếm và dropdown người dùng -->
                <div
                    class="col-8 col-md-8 col-lg-4 d-none d-md-flex d-lg-flex mt-lg-0 mt-2 justify-content-start justify-content-sm-start flex-column">
                    <div class="d-flex align-items-center">
                        <form class="mb-3 mb-lg-0 me-3 input-group w-100 flex-nowrap" role="search">
                            <span class="input-group-text bg-dark text-white border" style="cursor: pointer;"
                                id="addon-wrapping"><i class="bi bi-search"></i></span>
                            <input type="search" class="form-control ps-4" placeholder="Search..." aria-label="Search">
                        </form>
                        <div class="dropdown col-lg-3 text-center ">
                            <?php if (isset($_SESSION['NDId']) && $_SESSION['NDloggedIn'] == true): ?>
                            <!-- Người dùng đã đăng nhập, hiển thị dropdown -->
                            <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="<?= $baseUrl . 'uploads/avatars/' . (!empty($user['data']['Anh']) ? $user['data']['Anh'] : 'user-icon.png') ?>"
                                    alt="User Avatar" width="40" height="40" class="rounded-circle">
                            </a>
                            <ul class="dropdown-menu text-small shadow border-0">
                                <li class="dropdown-css">
                                    <a class="dropdown-item">
                                        <img src="<?= $baseUrl ?>/assets/imgs/wave.gif" class="bg-transparent"
                                            width="25px" height="25px" alt="">
                                        <span>Xin chào, </span>
                                        <span class="fw-bold user-name" style="
                                                background: linear-gradient(to right, #30CFD0 0%, #330867 100%);
                                                background-clip: text;
                                                color: transparent;
                                                display: block;
                                                max-width: 200px; /* Giới hạn chiều rộng của tên */
                                                overflow: hidden;
                                                text-overflow: ellipsis;">
                                            <?= $user['data']['TenND'] ?>
                                        </span>
                                    </a>
                                </li>
                                <li class="dropdown-css">
                                    <a class="dropdown-item" href="<?= $baseUrl ?>profile-user.php">
                                        <i class="bi bi-person-video2"></i> Trang người dùng
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li class="dropdown-css">
                                    <a class="dropdown-item" href="<?= $baseUrl ?>logout.php">
                                        <i class="bi bi-box-arrow-right"></i> Đăng xuất
                                    </a>
                                </li>
                            </ul>
                            <?php else: ?>
                            <!-- Người dùng chưa đăng nhập, hiển thị nút Đăng nhập -->
                            <a href="<?= $baseUrl ?>login.php" class="nav-link px-2 fw-bolder text-capitalize "
                                id="login">Đăng nhập</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- Nút mở sidebar trên màn hình nhỏ -->
                <div class="col-1 d-lg-none ms-4 ms-lg-0">
                    <button class="btn btn-dark" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu">
                        <i class="bi bi-list"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</nav>
<script>
var words = document.getElementsByClassName('word');
var wordArray = [];
var currentWord = 0;

words[currentWord].style.opacity = 1;
for (var i = 0; i < words.length; i++) {
    splitLetters(words[i]);
}

function changeWord() {
    var cw = wordArray[currentWord];
    var nw = currentWord == words.length - 1 ? wordArray[0] : wordArray[currentWord + 1];
    for (var i = 0; i < cw.length; i++) {
        animateLetterOut(cw, i);
    }

    for (var i = 0; i < nw.length; i++) {
        nw[i].className = 'letter behind';
        nw[0].parentElement.style.opacity = 1;
        animateLetterIn(nw, i);
    }

    currentWord = (currentWord == wordArray.length - 1) ? 0 : currentWord + 1;
}

function animateLetterOut(cw, i) {
    setTimeout(function() {
        cw[i].className = 'letter out';
    }, i * 80);
}

function animateLetterIn(nw, i) {
    setTimeout(function() {
        nw[i].className = 'letter in';
    }, 340 + (i * 80));
}

function splitLetters(word) {
    var content = word.innerHTML;
    word.innerHTML = '';
    var letters = [];
    for (var i = 0; i < content.length; i++) {
        var letter = document.createElement('span');
        letter.className = 'letter';
        letter.innerHTML = content.charAt(i);
        word.appendChild(letter);
        letters.push(letter);
    }

    wordArray.push(letters);
}

changeWord();
setInterval(changeWord, 4000);
</script>