<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="/Website_BanVeXemPhim/admin/index.php" target="_blank">
            <span class="ms-1 font-weight-bold fs-4 font-monospace">
                <img src="/Website_BanVeXemPhim/admin/assets/icon/logo-100x100.png" class="w-25 bg-dark"
                    alt="Dashboard">
                DashBoard</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <?php
    $current_page = basename($_SERVER['REQUEST_URI']);
    $base_pages = [
        'dashboard' => ['index.php'],
        'film' => ['film.php', 'film-add.php', 'film-edit.php', 'film-detail.php'],
        'categories' => ['categories.php', 'categories-add.php', 'categories-edit.php', 'categories-detail.php'],
        'chair' => ['chair.php', 'chair-add.php', 'chair-edit.php', 'chair-detail.php'],
        'content' => ['content.php', 'content-add.php', 'content-edit.php', 'content-detail.php'],
        'topic' => ['topic.php', 'topic-add.php', 'topic-edit.php', 'topic-detail.php'],
        'slider' => ['slider.php', 'slider-add.php', 'slider-edit.php', 'slider-detail.php'],
        'showtime' => [
            'showtime.php',
            'showtime-add.php',
            'showtime-edit.php',
            'showtime-detail.php',
        ],
        'user' => ['user.php', 'user-add.php', 'user-edit.php', 'user-detail.php'],
        'room' => ['room.php', 'room-add.php', 'room-edit.php', 'room-detail.php'],
        'menu' => ['menu.php', 'menu-add.php', 'menu-edit.php', 'menu-detail.php'],
        'parameter' => ['parameter.php', 'parameter-add.php', 'parameter-edit.php', 'parameter-detail.php'],
    ];

    function isActive($current_page, $base_pages, $key)
    {
        // Kiểm tra nếu trang hiện tại nằm trong danh sách
        if (in_array($current_page, $base_pages[$key])) {
            return true;
        }

        // Kiểm tra nếu trang hiện tại là một trang có ID
        foreach ($base_pages[$key] as $page) {
            if (strpos($_SERVER['REQUEST_URI'], $page) !== false) {
                return true;
            }
        }

        return false;
    }

    ?>
    <style>
        .nav-link .icon svg {
            stroke: #3a416f !important;
            stroke-width: 0.5 !important;
            fill: #3a416f !important;
            /* Màu đen mặc định */
        }

        .nav-link.active .icon svg {
            stroke: #FFFFFF !important;
            fill: #FFFFFF !important;
            /* Màu trắng khi active */
        }
    </style>
    <div class="collapse navbar-collapse w-auto h-100" id="sidenav-collapse-main">
        <ul class="navbar-nav" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a class="nav-link <?php if (isActive($current_page, $base_pages, 'dashboard') || $current_page == 'admin') echo 'active'; ?>"
                    href="/Website_BanVeXemPhim/admin/index.php" data-class="bg - transparent">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>shop </title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                    <g transform="translate(1716.000000, 291.000000)">
                                        <g transform="translate(0.000000, 148.000000)">
                                            <path class="color-background opacity-6"
                                                d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z">
                                            </path>
                                            <path class="color-background"
                                                d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z">
                                            </path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link ps-4 ms-2 text-uppercase text-xs font-weight-bolder dropdown-toggle"
                    data-bs-toggle="collapse" data-bs-target="#listFilm"
                    aria-expanded="<?php echo (isActive($current_page, $base_pages, 'categories') || isActive($current_page, $base_pages, 'film') || isActive($current_page, $base_pages, 'room') || isActive($current_page, $base_pages, 'chair') || isActive($current_page, $base_pages, 'showtime')) ? 'true' : 'false'; ?>">
                    <span class="nav-link-text ms-1">Danh sách phim</span>
                </a>
                <ul class="nav nav-treeview <?php echo (isActive($current_page, $base_pages, 'categories') || isActive($current_page, $base_pages, 'film') || isActive($current_page, $base_pages, 'room') || isActive($current_page, $base_pages, 'chair') || isActive($current_page, $base_pages, 'showtime')) ? 'show' : 'collapse'; ?>"
                    id="listFilm">
                    <li class="nav-item">
                        <a class="nav-link <?php if (isActive($current_page, $base_pages, 'categories')) echo 'active'; ?>"
                            href="/Website_BanVeXemPhim/admin/categories.php" data-class="bg-white">
                            <div
                                class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-list-columns" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M0 .5A.5.5 0 0 1 .5 0h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 0 .5m13 0a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m-13 2A.5.5 0 0 1 .5 2h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5m13 0a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m-13 2A.5.5 0 0 1 .5 4h10a.5.5 0 0 1 0 1H.5a.5.5 0 0 1-.5-.5m13 0a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m-13 2A.5.5 0 0 1 .5 6h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m13 0a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m-13 2A.5.5 0 0 1 .5 8h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m13 0a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m-13 2a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m13 0a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m-13 2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m13 0a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m-13 2a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H.5a.5.5 0 0 1-.5-.5m13 0a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5" />
                                </svg>
                            </div>
                            <span class="nav-link-text ms-1">Danh sách loại phim</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if (isActive($current_page, $base_pages, 'film')) echo 'active'; ?>"
                            href="/Website_BanVeXemPhim/admin/film.php" data-class="bg-white">
                            <div
                                class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                <svg width="12px" height="12px" viewBox="0 0 16 16" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <path class="color-background opacity-6"
                                            d="M0 1a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm4 0v6h8V1zm8 8H4v6h8zM1 1v2h2V1zm2 3H1v2h2zM1 7v2h2V7zm2 3H1v2h2zm-2 3v2h2v-2zM15 1h-2v2h2zm-2 3v2h2V4zm2 3h-2v2h2zm-2 3v2h2v-2zm2 3h-2v2h2z" />
                                    </g>
                                </svg>
                            </div>
                            <span class="nav-link-text ms-1">Danh sách phim</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if (isActive($current_page, $base_pages, 'room')) echo 'active'; ?>"
                            href="/Website_BanVeXemPhim/admin/room.php" data-class="bg-white">
                            <div
                                class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-hospital-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M6 0a1 1 0 0 0-1 1v1a1 1 0 0 0-1 1v4H1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h6v-2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5V16h6a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1h-3V3a1 1 0 0 0-1-1V1a1 1 0 0 0-1-1zm2.5 5.034v1.1l.953-.55.5.867L9 7l.953.55-.5.866-.953-.55v1.1h-1v-1.1l-.953.55-.5-.866L7 7l-.953-.55.5-.866.953.55v-1.1zM2.25 9h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5A.25.25 0 0 1 2 9.75v-.5A.25.25 0 0 1 2.25 9m0 2h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5a.25.25 0 0 1-.25-.25v-.5a.25.25 0 0 1 .25-.25M2 13.25a.25.25 0 0 1 .25-.25h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5a.25.25 0 0 1-.25-.25zM13.25 9h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5a.25.25 0 0 1-.25-.25v-.5a.25.25 0 0 1 .25-.25M13 11.25a.25.25 0 0 1 .25-.25h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5a.25.25 0 0 1-.25-.25zm.25 1.75h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5a.25.25 0 0 1-.25-.25v-.5a.25.25 0 0 1 .25-.25" />
                                </svg>
                            </div>
                            <span class="nav-link-text ms-1">Danh sách phòng</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if (isActive($current_page, $base_pages, 'chair')) echo 'active'; ?>"
                            href="/Website_BanVeXemPhim/admin/chair.php" data-class="bg-white">
                            <div
                                class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                <svg width="12px" height="12px" viewBox="0 0 640 512" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <path
                                            d="M64 160C64 89.3 121.3 32 192 32l256 0c70.7 0 128 57.3 128 128l0 33.6c-36.5 7.4-64 39.7-64 78.4l0 48-384 0 0-48c0-38.7-27.5-71-64-78.4L64 160zM544 272c0-20.9 13.4-38.7 32-45.3c5-1.8 10.4-2.7 16-2.7c26.5 0 48 21.5 48 48l0 176c0 17.7-14.3 32-32 32l-32 0c-17.7 0-32-14.3-32-32L96 448c0 17.7-14.3 32-32 32l-32 0c-17.7 0-32-14.3-32-32L0 272c0-26.5 21.5-48 48-48c5.6 0 11 1 16 2.7c18.6 6.6 32 24.4 32 45.3l0 48 0 32 32 0 384 0 32 0 0-32 0-48z">
                                        </path>
                                    </g>
                                </svg>
                            </div>
                            <span class="nav-link-text ms-1">Danh sách ghế</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if (isActive($current_page, $base_pages, 'showtime')) echo 'active'; ?>"
                            href="/Website_BanVeXemPhim/admin/showtime.php" data-class="bg-white">
                            <div
                                class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                <svg width="12px" height="12px" viewBox="0 0 42 42" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <path
                                            d="M12.25,17.5 L8.75,17.5 L8.75,1.75 C8.75,0.78225 9.53225,0 10.5,0 L31.5,0 C32.46775,0 33.25,0.78225 33.25,1.75 L33.25,12.25 L29.75,12.25 L29.75,3.5 L12.25,3.5 L12.25,17.5 Z">
                                        </path>
                                        <path
                                            d="M40.25,14 L24.5,14 C23.53225,14 22.75,14.78225 22.75,15.75 L22.75,38.5 L19.25,38.5 L19.25,22.75 C19.25,21.78225 18.46775,21 17.5,21 L1.75,21 C0.78225,21 0,21.78225 0,22.75 L0,40.25 C0,41.21775 0.78225,42 1.75,42 L40.25,42 C41.21775,42 42,41.21775 42,40.25 L42,15.75 C42,14.78225 41.21775,14 40.25,14 Z M12.25,36.75 L7,36.75 L7,33.25 L12.25,33.25 Z M12.25,29.75 L7,29.75 L7,26.25 L12.25,26.25 Z M35,36.75 L29.75,36.75 L29.75,33.25 L35,33.25 Z M35,29.75 L29.75,29.75 L29.75,26.25 L35,26.25 Z M35,22.75 L29.75,22.75 L29.75,19.25 L35,19.25 Z">
                                        </path>
                                    </g>
                                </svg>
                            </div>
                            <span class="nav-link-text ms-1">Danh sách suất chiếu</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link ps-4 ms-2 text-uppercase text-xs font-weight-bolder dropdown-toggle"
                    data-bs-toggle="collapse" data-bs-target="#listContent"
                    aria-expanded="<?php echo (isActive($current_page, $base_pages, 'topic') || isActive($current_page, $base_pages, 'content')) ? 'true' : 'false'; ?>">
                    <span class="nav-link-text ms-1">Danh sách nội dung</span>
                </a>

                <ul class="nav nav-treeview <?php echo (isActive($current_page, $base_pages, 'topic') || isActive($current_page, $base_pages, 'content')) ? 'show' : 'collapse'; ?>"
                    id="listContent">
                    <li class="nav-item">
                        <a class="nav-link <?php if (isActive($current_page, $base_pages, 'topic')) echo 'active'; ?>"
                            href="/Website_BanVeXemPhim/admin/topic.php" data-class="bg-white">
                            <div
                                class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                <svg width="12px" height="12px" viewBox="0 0 42 42" xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <path class="color-background opacity-6"
                                            d="M12.25,17.5 L8.75,17.5 L8.75,1.75 C8.75,0.78225 9.53225,0 10.5,0 L31.5,0 C32.46775,0 33.25,0.78225 33.25,1.75 L33.25,12.25 L29.75,12.25 L29.75,3.5 L12.25,3.5 L12.25,17.5 Z">
                                        </path>
                                        <path class="color-background"
                                            d="M40.25,14 L24.5,14 C23.53225,14 22.75,14.78225 22.75,15.75 L22.75,38.5 L19.25,38.5 L19.25,22.75 C19.25,21.78225 18.46775,21 17.5,21 L1.75,21 C0.78225,21 0,21.78225 0,22.75 L0,40.25 C0,41.21775 0.78225,42 1.75,42 L40.25,42 C41.21775,42 42,41.21775 42,40.25 L42,15.75 C42,14.78225 41.21775,14 40.25,14 Z M12.25,36.75 L7,36.75 L7,33.25 L12.25,33.25 Z M12.25,29.75 L7,29.75 L7,26.25 L12.25,26.25 Z M35,36.75 L29.75,36.75 L29.75,33.25 L35,33.25 Z M35,29.75 L29.75,29.75 L29.75,26.25 L35,26.25 Z M35,22.75 L29.75,22.75 L29.75,19.25 L35,19.25 Z">
                                        </path>
                                    </g>
                                </svg>
                            </div>
                            <span class="nav-link-text ms-1">Danh sách chủ đề</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if (isActive($current_page, $base_pages, 'content')) echo 'active'; ?>"
                            href="/Website_BanVeXemPhim/admin/content.php" data-class="bg-white">
                            <div
                                class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                <svg width="12px" height="12px" viewBox="0 0 42 42" xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <path class="color-background opacity-6"
                                            d="M12.25,17.5 L8.75,17.5 L8.75,1.75 C8.75,0.78225 9.53225,0 10.5,0 L31.5,0 C32.46775,0 33.25,0.78225 33.25,1.75 L33.25,12.25 L29.75,12.25 L29.75,3.5 L12.25,3.5 L12.25,17.5 Z">
                                        </path>
                                        <path class="color-background"
                                            d="M40.25,14 L24.5,14 C23.53225,14 22.75,14.78225 22.75,15.75 L22.75,38.5 L19.25,38.5 L19.25,22.75 C19.25,21.78225 18.46775,21 17.5,21 L1.75,21 C0.78225,21 0,21.78225 0,22.75 L0,40.25 C0,41.21775 0.78225,42 1.75,42 L40.25,42 C41.21775,42 42,41.21775 42,40.25 L42,15.75 C42,14.78225 41.21775,14 40.25,14 Z M12.25,36.75 L7,36.75 L7,33.25 L12.25,33.25 Z M12.25,29.75 L7,29.75 L7,26.25 L12.25,26.25 Z M35,36.75 L29.75,36.75 L29.75,33.25 L35,33.25 Z M35,29.75 L29.75,29.75 L29.75,26.25 L35,26.25 Z M35,22.75 L29.75,22.75 L29.75,19.25 L35,19.25 Z">
                                        </path>
                                    </g>
                                </svg>
                            </div>
                            <span class="nav-link-text ms-1">Danh sách bài viết</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link ps-4 ms-2 text-uppercase text-xs font-weight-bolder dropdown-toggle"
                    data-bs-toggle="collapse" data-bs-target="#listmenu"
                    aria-expanded="<?php echo (isActive($current_page, $base_pages, 'slider') || isActive($current_page, $base_pages, 'menu')) ? 'true' : 'false'; ?>">
                    <span class="nav-link-text ms-1">Danh sách menu</span>
                </a>
                <ul class="nav nav-treeview <?php echo (isActive($current_page, $base_pages, 'slider') || isActive($current_page, $base_pages, 'menu')) ? 'show' : 'collapse'; ?>"
                    id="listmenu">
                    <li class="nav-item">
                        <a class="nav-link <?php if (isActive($current_page, $base_pages, 'slider')) echo 'active'; ?>"
                            href="/Website_BanVeXemPhim/admin/slider.php" data-class="bg-white">
                            <div
                                class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                <svg width="12px" height="12px" viewBox="0 0 42 42" xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <path class="color-background opacity-6"
                                            d="M12.25,17.5 L8.75,17.5 L8.75,1.75 C8.75,0.78225 9.53225,0 10.5,0 L31.5,0 C32.46775,0 33.25,0.78225 33.25,1.75 L33.25,12.25 L29.75,12.25 L29.75,3.5 L12.25,3.5 L12.25,17.5 Z">
                                        </path>
                                        <path class="color-background"
                                            d="M40.25,14 L24.5,14 C23.53225,14 22.75,14.78225 22.75,15.75 L22.75,38.5 L19.25,38.5 L19.25,22.75 C19.25,21.78225 18.46775,21 17.5,21 L1.75,21 C0.78225,21 0,21.78225 0,22.75 L0,40.25 C0,41.21775 0.78225,42 1.75,42 L40.25,42 C41.21775,42 42,41.21775 42,40.25 L42,15.75 C42,14.78225 41.21775,14 40.25,14 Z M12.25,36.75 L7,36.75 L7,33.25 L12.25,33.25 Z M12.25,29.75 L7,29.75 L7,26.25 L12.25,26.25 Z M35,36.75 L29.75,36.75 L29.75,33.25 L35,33.25 Z M35,29.75 L29.75,29.75 L29.75,26.25 L35,26.25 Z M35,22.75 L29.75,22.75 L29.75,19.25 L35,19.25 Z">
                                        </path>
                                    </g>
                                </svg>
                            </div>
                            <span class="nav-link-text ms-1">Danh sách slider</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if (isActive($current_page, $base_pages, 'menu')) echo 'active'; ?>"
                            href="/Website_BanVeXemPhim/admin/menu.php" data-class="bg-white">
                            <div
                                class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                <svg width="12px" height="12px" viewBox="0 0 42 42" xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <path class="color-background opacity-6"
                                            d="M12.25,17.5 L8.75,17.5 L8.75,1.75 C8.75,0.78225 9.53225,0 10.5,0 L31.5,0 C32.46775,0 33.25,0.78225 33.25,1.75 L33.25,12.25 L29.75,12.25 L29.75,3.5 L12.25,3.5 L12.25,17.5 Z">
                                        </path>
                                        <path class="color-background"
                                            d="M40.25,14 L24.5,14 C23.53225,14 22.75,14.78225 22.75,15.75 L22.75,38.5 L19.25,38.5 L19.25,22.75 C19.25,21.78225 18.46775,21 17.5,21 L1.75,21 C0.78225,21 0,21.78225 0,22.75 L0,40.25 C0,41.21775 0.78225,42 1.75,42 L40.25,42 C41.21775,42 42,41.21775 42,40.25 L42,15.75 C42,14.78225 41.21775,14 40.25,14 Z M12.25,36.75 L7,36.75 L7,33.25 L12.25,33.25 Z M12.25,29.75 L7,29.75 L7,26.25 L12.25,26.25 Z M35,36.75 L29.75,36.75 L29.75,33.25 L35,33.25 Z M35,29.75 L29.75,29.75 L29.75,26.25 L35,26.25 Z M35,22.75 L29.75,22.75 L29.75,19.25 L35,19.25 Z">
                                        </path>
                                    </g>
                                </svg>
                            </div>
                            <span class="nav-link-text ms-1">Menu</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php if (isActive($current_page, $base_pages, 'parameter')) echo 'active'; ?>"
                    href="/Website_BanVeXemPhim/admin/parameter.php" data-class="bg-white">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="12px" height="12px" viewBox="0 0 46 42" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>customer-support</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-1717.000000, -291.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                    <g transform="translate(1716.000000, 291.000000)">
                                        <g transform="translate(1.000000, 0.000000)">
                                            <path class="color-background opacity-6"
                                                d="M45,0 L26,0 C25.447,0 25,0.447 25,1 L25,20 C25,20.379 25.214,20.725 25.553,20.895 C25.694,20.965 25.848,21 26,21 C26.212,21 26.424,20.933 26.6,20.8 L34.333,15 L45,15 C45.553,15 46,14.553 46,14 L46,1 C46,0.447 45.553,0 45,0 Z">
                                            </path>
                                            <path class="color-background"
                                                d="M22.883,32.86 C20.761,32.012 17.324,31 13,31 C8.676,31 5.239,32.012 3.116,32.86 C1.224,33.619 0,35.438 0,37.494 L0,41 C0,41.553 0.447,42 1,42 L25,42 C25.553,42 26,41.553 26,41 L26,37.494 C26,35.438 24.776,33.619 22.883,32.86 Z">
                                            </path>
                                            <path class="color-background"
                                                d="M13,28 C17.432,28 21,22.529 21,18 C21,13.589 17.411,10 13,10 C8.589,10 5,13.589 5,18 C5,22.529 8.568,28 13,28 Z">
                                            </path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Quản lý tham số</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if (isActive($current_page, $base_pages, 'user')) echo 'active'; ?>"
                    href="/Website_BanVeXemPhim/admin/user.php" data-class="bg-white">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="12px" height="12px" viewBox="0 0 46 42" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>customer-support</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-1717.000000, -291.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                    <g transform="translate(1716.000000, 291.000000)">
                                        <g transform="translate(1.000000, 0.000000)">
                                            <path class="color-background opacity-6"
                                                d="M45,0 L26,0 C25.447,0 25,0.447 25,1 L25,20 C25,20.379 25.214,20.725 25.553,20.895 C25.694,20.965 25.848,21 26,21 C26.212,21 26.424,20.933 26.6,20.8 L34.333,15 L45,15 C45.553,15 46,14.553 46,14 L46,1 C46,0.447 45.553,0 45,0 Z">
                                            </path>
                                            <path class="color-background"
                                                d="M22.883,32.86 C20.761,32.012 17.324,31 13,31 C8.676,31 5.239,32.012 3.116,32.86 C1.224,33.619 0,35.438 0,37.494 L0,41 C0,41.553 0.447,42 1,42 L25,42 C25.553,42 26,41.553 26,41 L26,37.494 C26,35.438 24.776,33.619 22.883,32.86 Z">
                                            </path>
                                            <path class="color-background"
                                                d="M13,28 C17.432,28 21,22.529 21,18 C21,13.589 17.411,10 13,10 C8.589,10 5,13.589 5,18 C5,22.529 8.568,28 13,28 Z">
                                            </path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Quản lý người dùng</span>
                </a>
            </li>
            <li class="sidenav-footer mx-3">
                <a class="btn bg-gradient-primary mt-3 w-100" href="/Website_BanVeXemPhim/admin/sign-in.php">Đăng
                    xuất</a>
            </li>
        </ul>
    </div>
</aside>
