<?php
$current_url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; // Hoặc $_SERVER['PHP_SELF']
require_once $_SERVER['DOCUMENT_ROOT'] . "/Website_BanVeXemPhim/config/function.php";

?>

<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light navbar-blur p-3">
    <div class="container-fluid mx-5">
        <div class="container">
            <div class="d-flex align-items-center justify-content-center justify-content-lg-start">
                <a href="http://localhost/Website_BanVeXemPhim/index.php" class="me-5">
                    <img src="/Website_BanVeXemPhim/assets/imgs/logo-100x100.png" style="width: 50px;"
                        class="bg-dark rounded-3 h-50">
                </a>
                <?php
                $items = getAll('Menu');
                ?>
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <?php foreach ($items as $item): ?>
                    <li>
                        <a href="<?= $item['LienKet'] ?>"
                            class="nav-link px-2 fw-bolder text-uppercase text-secondary <?= ($current_url === $item['LienKet']) ? 'active' : '' ?>">
                            <?= htmlspecialchars($item['TenMenu']) ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                    <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
                </form>

                <div class="dropdown text-end">
                    <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
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
</nav>