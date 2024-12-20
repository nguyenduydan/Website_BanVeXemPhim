<?php
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    redirect('sign-in.php', 'error', 'Vui lòng đăng nhập');
}
getAdmin();
?>
<nav
    class="navbar navbar-main navbar-expand-lg px-0 mx-4 border-radius-xl position-sticky blur shadow-blur mt-4 left-auto top-1 z-index-sticky">
    <div class="container-fluid py-1 px-3">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
            aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="d-none d-lg-block">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm">
                    <a class="opacity-5 text-dark" id="dashboard" href="../index.php">Dashboard</a>
                </li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">
                    <?php echo htmlspecialchars($title); ?>
                </li>
            </ol>
        </nav>

        <!-- Navbar Collapse -->
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <!-- Clock and Search only on large screens -->
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <div id="clock" class="fs-4 fw-bold me-5 bg-gradient-info text-white p-2 d-none d-lg-block">
                    <!-- Clock content -->
                </div>

            </div>

            <!-- Welcome Message and Avatar -->
            <div class="ms-3 d-flex align-items-center">
                <small for="username" class="d-none d-lg-inline">Welcome,
                    <span class="fs-5 text-info text-gradient fw-bolder"><?= $admin['data']['TenND'] ?></span>
                </small>
                <div id="avatar-container" class="rounded-circle">
                    <img id="avatar" src="/Website_BanVeXemPhim/uploads/avatars/<?= $admin['data']['Anh'] ?>"
                        class="rounded-circle" alt="Avatar">
                </div>
            </div>


            <ul class="navbar-nav justify-content-end">
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    function updateClock() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');

        $('#clock').text(`${hours}:${minutes}:${seconds}`);
    }

    // Cập nhật đồng hồ ngay lập tức
    updateClock();
    // Cập nhật đồng hồ mỗi giây
    setInterval(updateClock, 1000);
});
</script>