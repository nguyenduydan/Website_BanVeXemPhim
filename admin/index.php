<!DOCTYPE html>
<html lang="en">
<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
switch ($page) {
    case 'dashboard': {
            $title = 'Dashboard';
            break;
        }
    case 'films': {
            $title = 'Danh sách phim';
            break;
        }
    default: {
            $title = 'Dashboard'; // Trường hợp mặc định nếu không có trang hợp lệ
        }
}
?>

<head>

    <title><?php echo $title ?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <?php require('includes/header.php') ?>
</head>

<body class="g-sidenav-show  bg-gray-100">
    <?php require('includes/menu.php') ?>;
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <?php
        define('BASE_PATH', '/XAMP/htdocs/Website_BanVeXemPhim/admin/');
        // Xác định trang hiện tại bằng tham số GET
        // Mặc định là dashboard

        // Điều kiện để load nội dung phù hợp
        if ($page === 'films') {
            include BASE_PATH . 'films.php';  // Hiển thị nội dung trang films.php
        } else {
            include BASE_PATH . 'dashboard.php';  // Hiển thị dashboard mặc định
        }

        require('includes/footer.php');

        ?>
    </main>
</body>

</html>
