<?php
$current_url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
require_once $_SERVER['DOCUMENT_ROOT'] . "/Website_BanVeXemPhim/config/function.php";
getUser();
?>
<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light navbar-blur p-3">
    <div class="container">
        <div class="container-fluid">
            <div class="flex-lg-nowrap d-flex align-items-center justify-content-center ">
                <!-- Logo -->
                <div class="col-6 d-lg-flex row text-center col-lg-2 justify-content-center me-lg-auto mb-md-0">
                    <div class="col-6">
                        <a href="http://localhost/Website_BanVeXemPhim/index.php" class="me-3">
                            <img src="/Website_BanVeXemPhim/assets/imgs/logo-100x100.png" style="width: 60px;"
                                class="bg-dark rounded-circle">
                        </a>
                    </div>
                    <div class="text d-none d-lg-block col-6 position-relative mt-1">
                        <!-- Đặt chiều cao để chứa văn bản -->
                        <p class="mb-0 position-absolute" style="left: -20px;">
                            <!-- Đảm bảo các từ không bị cắt -->
                            <span class="word wisteria">ticket</span>
                            <span class="word belize">cheap</span>
                            <span class="word pomegranate">dino</span>
                            <span class="word green">fate</span>
                            <span class="word midnight">fogvn</span>
                        </p>

                    </div>
                </div>
                <audio id="myAudio" class="audio-player ms-5" autoplay loop>
                    <source src="assets/imgs/Querry.mp3" type="audio/mpeg">
                    Trình duyệt của bạn không hỗ trợ thẻ audio.
                </audio>
                <button class="play-button" onclick="toggleAudio()">
                    <i id="playPauseIcon" class="bi bi-volume-up"></i>
                </button>
                <div class="col-6 d-lg-none align-content-end text-end ms-4 ms-lg-0">
                    <button class="btn btn-dark" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu">
                        <i class="bi bi-list"></i>
                    </button>
                </div>
                <!-- Offcanvas sidebar cho menu trên màn hình nhỏ -->
                <div class="offcanvas offcanvas-top w-100 h-50" tabindex="-1" id="offcanvasMenu"
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
                            class="nav flex-lg-row flex-column col-lg-8 col-sm-12 align-items-center justify-content-start justify-content-lg-center mb-md-0">
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
                            /* Hiện dropdown khi hover trên màn hình lớn */
                            .nav-item.dropdown:hover .dropdown-menu {
                                display: block;
                            }

                            /* Ẩn dropdown mặc định */
                            .dropdown-menu {
                                display: none;
                                transition: all .3s ease-in-out;
                            }

                            /* Ẩn dropdown khi hover trên màn hình nhỏ */
                            @media (max-width: 575.98px) {
                                .nav-item.dropdown:hover .dropdown-menu {
                                    display: none;
                                    /* Giữ cho dropdown ẩn khi hover trên màn hình nhỏ */
                                }

                                /* Ẩn dropdown mặc định */
                                .dropdown-menu {
                                    display: none;
                                    transition: all .3s ease-in-out;
                                }

                                .dropdown-menu li a {
                                    font-size: 13px !important;
                                }
                            }

                            @media (max-width: 775.98px) {
                                .nav-item.dropdown:hover .dropdown-menu {
                                    display: none;
                                    /* Giữ cho dropdown ẩn khi hover trên màn hình nhỏ */
                                }

                                /* Ẩn dropdown mặc định */
                                .dropdown-menu {

                                    display: none;
                                    transition: all .3s ease-in-out;
                                }

                                .dropdown-menu li a {
                                    font-size: 13px !important;
                                }
                            }
                        </style>
                        <!-- Search and Login Section in Offcanvas -->
                        <div class="col-lg-4 d-flex flex-lg-row flex-column align-items-center col-12">
                            <form class="mb-0 input-group" role="search">
                                <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
                                <button class="btn btn-dark" type="submit"><i class="bi bi-search"></i></button>
                            </form>
                            <div class="dropdown mt-auto ms-3">
                                <?php if (isset($_SESSION['NDId']) && $_SESSION['NDloggedIn'] == true): ?>
                                    <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="<?= $baseUrl . 'uploads/avatars/' . (!empty($user['data']['Anh']) ? $user['data']['Anh'] : 'user-icon.png') ?>"
                                            alt="User Avatar" width="40" height="40" class="rounded-circle">
                                    </a>
                                    <ul class="dropdown-menu shadow border-0">
                                        <li class="dropdown-css">
                                            <a class="dropdown-item">
                                                <img src="<?= $baseUrl ?>/assets/imgs/wave.gif" class="bg-transparent"
                                                    width="25px" height="25px" alt="">
                                                <span class="fw-bold ">Xin chào, </span>
                                                <div class="d-flex overflow-visible">
                                                    <span class="fw-bold user-name" style="background: linear-gradient(to right, #30CFD0 0%, #330867 100%);
                                                background-clip: text; color: transparent; white-space: nowrap;
                                                overflow: hidden; text-overflow: ellipsis;">
                                                        <?= $user['data']['TenND'] ?>
                                                    </span>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="dropdown-css">
                                            <a class="dropdown-item fw-bold " href="<?= $baseUrl ?>profile-user.php">
                                                <i class="bi bi-person-video2"></i> Trang người dùng
                                            </a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li class="dropdown-css">
                                            <a class="dropdown-item fw-bold " href="<?= $baseUrl ?>logout.php">
                                                <i class="bi bi-box-arrow-right"></i> Đăng xuất
                                            </a>
                                        </li>
                                    </ul>
                                <?php else: ?>
                                    <a href="<?= $baseUrl ?>login.php" class="nav-link px-2 fw-bolder text-capitalize"
                                        id="login">Đăng nhập</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
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
