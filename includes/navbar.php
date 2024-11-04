<?php
$current_url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; // Hoặc $_SERVER['PHP_SELF']
require_once $_SERVER['DOCUMENT_ROOT'] . "/Website_BanVeXemPhim/config/function.php";
?>

<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light navbar-blur p-3">
    <div class="container-fluid mx-5">
        <div class="container">
            <div
                class="d-flex row flex-wrap flex-lg-nowrap align-items-center justify-content-center justify-content-lg-center">
                <div
                    class="col-lg-1 d-none d-lg-block col text-center justify-content-center col-lg-auto me-lg-auto mb-md-0">
                    <a href="http://localhost/Website_BanVeXemPhim/index.php" class="me-5">
                        <img src="/Website_BanVeXemPhim/assets/imgs/logo-100x100.png" style="width: 60px;"
                            class="bg-dark rounded-circle">
                    </a>
                </div>

                <div class="col-lg-7 d-flex flex-column align-items-start align-items-lg-center">
                    <!-- Nút điều hướng cho thiết bị di động -->
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <?php
                    $items = getAll('Menu');
                    ?>

                    <!-- Phần collapse chứa menu -->
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul
                            class="nav flex-lg-row flex-column col-lg-12 col-sm-12 me-lg-auto mb-2 justify-content-start justify-content-lg-center mb-md-0">
                            <?php foreach ($items as $item): ?>
                            <li class="nav-item mx-2">
                                <a href="<?= $item['LienKet'] ?>"
                                    class="nav-link px-2 fw-bolder text-capitalize text-secondary <?= ($current_url === $item['LienKet']) ? 'active' : '' ?>">
                                    <?= htmlspecialchars($item['TenMenu']) ?>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

                <!-- Phần tìm kiếm sẽ nằm ở đây -->
                <div
                    class="col-12 mt-lg-0 mt-2 col-lg-4 d-flex justify-content-start justify-content-sm-start flex-column">
                    <div class="d-flex">
                        <!-- Form tìm kiếm -->
                        <form class="mb-3 mb-lg-0 me-3 input-group w-100 flex-nowrap" role="search">
                            <span class="input-group-text bg-dark text-white border" style="cursor: pointer;"
                                id="addon-wrapping"><i class="bi bi-search"></i></span>
                            <input type="search" class="form-control ps-4" placeholder="Search..." aria-label="Search">
                        </form>

                        <!-- Dropdown người dùng -->
                        <div class="dropdown col-1 col-lg-2 text-end">
                            <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32"
                                    class="rounded-circle">
                            </a>
                            <ul class="dropdown-menu text-small">
                                <li><a class="dropdown-item" href="#">New project...</a></li>
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Sign out</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>