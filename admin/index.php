<?php
// Bật hiển thị lỗi PHP (nếu cần)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Đường dẫn tới các tệp
define('BASE_PATH', '/XAMP/htdocs/Website_BanVeXemPhim/admin/');

// Include header
include BASE_PATH . 'header.php';

// Include menu
include BASE_PATH . 'menu.php';

// Xác định trang hiện tại bằng tham số GET
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';  // Mặc định là dashboard

?>
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <?php
    // Điều kiện để load nội dung phù hợp
    if ($page === 'films') {
        include BASE_PATH . 'films.php';  // Hiển thị nội dung trang films.php
    } else {
        include BASE_PATH . 'dashboard.php';  // Hiển thị dashboard mặc định
    }
    ?>
</main>

<?php
// Include footer
include BASE_PATH . 'footer.php';
?>
