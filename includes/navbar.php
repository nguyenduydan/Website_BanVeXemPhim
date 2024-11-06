<?php
$current_url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
require_once $_SERVER['DOCUMENT_ROOT'] . "/Website_BanVeXemPhim/config/function.php";
?>
<style>

</style>
<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light navbar-blur p-3">
    <div class="container-fluid mx-5">
        <div class="container">
            <div class="d-flex row flex-lg-nowrap align-items-center justify-content-center justify-content-lg-center">
                <!-- Logo -->
                <div
                    class="col-4 text-center col-lg-1 d-lg-block text-center justify-content-center col-lg-auto me-lg-auto mb-md-0">
                    <a href="#" class="me-5">
                        <img src="/Website_BanVeXemPhim/assets/imgs/logo-100x100.png" style="width: 60px;"
                            class="bg-dark rounded-circle">
                    </a>
                    <div class="text d-sm-none d-lg-block">
                        <p>
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
                            <?php foreach ($items as $item):
                            ?>
                            <li class="nav-item mx-2">
                                <a href="<?= $baseUrl . $item['LienKet'] ?>"
                                    class="nav-link px-2 fw-bolder text-capitalize text-secondary <?= ($current_url === $baseUrl . $item['LienKet']) ? 'active' : '' ?>">
                                    <?= htmlspecialchars($item['TenMenu']) ?>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

                <!-- Phần tìm kiếm và dropdown người dùng -->
                <div
                    class="col-8 col-md-8 col-lg-4 d-none d-md-flex d-lg-flex mt-lg-0 mt-2 justify-content-start justify-content-sm-start flex-column">
                    <div class="d-flex">
                        <form class="mb-3 mb-lg-0 me-3 input-group w-100 flex-nowrap" role="search">
                            <span class="input-group-text bg-dark text-white border" style="cursor: pointer;"
                                id="addon-wrapping"><i class="bi bi-search"></i></span>
                            <input type="search" class="form-control ps-4" placeholder="Search..." aria-label="Search">
                        </form>
                        <div class="dropdown col-1 col-lg-2 text-end">
                            <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="https://github.com/mdo.png" alt="mdo" width="40" height="40"
                                    class="rounded-circle">
                            </a>
                            <ul class="dropdown-menu text-small">
                                <li>
                                    <a class="dropdown-item">
                                        <span>Xin chào, </span>
                                        <span class="fw-bold user-name" style="
                                        background: linear-gradient(to right, #30CFD0 0%, #330867 100%);
                                        background-clip: text;
                                        color: transparent;
                                        display: block;
                                        max-width: 100px; /* Giới hạn chiều rộng của tên */
                                        overflow: hidden;
                                        text-overflow: ellipsis;
                                        ">
                                            NguenThietDuyDanssssssssss
                                        </span>
                                    </a>
                                </li>

                                </li>
                                <li><a class=" dropdown-item" href="profile-user.php">Cài đặt</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Đăng xuất</a></li>
                            </ul>
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