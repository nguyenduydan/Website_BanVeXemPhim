<?php
// Lấy đường dẫn URL
$url_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path_parts = explode('/', trim($url_path, '/'));

// Giả sử bạn đang sử dụng tên file để xác định trang
$current_page_name = end($path_parts); // Lấy phần cuối cùng của đường dẫn

$page_names = [
    'index' => 'Dashboard',
    'categories-list' => 'Categories List',
    'film-list' => 'Film List',
];

// Ánh xạ trang cha cho từng trang
$parent_pages = [
    'categories-list' => 'Dashboard', // Trang cha của categories-list
    'film-list' => 'Categories List', // Trang cha của film-list
];

// Gán tên trang cha nếu có
$parent_title = $parent_pages[$current_page_name] ?? null;
?>

<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <?php if ($parent_title): ?>
                    <li class="breadcrumb-item text-sm"><a class="text-dark" href="javascript:;"><?php echo htmlspecialchars($parent_title); ?></a></li>
                <?php endif; ?>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><?php echo htmlspecialchars($title); ?></li>
            </ol>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <div class="input-group">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" placeholder="Type here...">
                </div>
            </div>
            <ul class="navbar-nav justify-content-end">
                <li class="nav-item d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body font-weight-bold px-0">
                        <i class="fa fa-user me-sm-1"></i>
                        <span class="d-sm-inline d-none">Sign In</span>
                    </a>
                </li>
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->
