<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    // Lấy tên trang hiện tại
    $page = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);

    // Mảng chứa các tiêu đề cho các trang
    $page_titles = [
        'dashboard' => 'Dashboard',
        'film' => 'Danh sách phim',
        'categories' => 'Danh sách thể loại phim',
        'chair' => 'Danh sách ghế',
        'content' => 'Danh sách nội dung',
        'topic' => 'Danh sách chủ đề',
        'slider' => 'Danh sách slider',
        'showtime' => 'Danh sách suất chiếu',
        'user' => 'Danh sách người dùng',
        'room' => 'Danh sách phòng chiếu',
        'menu' => 'Danh sách menu',
        'parameter' => 'Danh sách tham số',
    ];

    // Hàm để lấy tiêu đề dựa trên tên trang
    function getPageTitle($page, $titles)
    {
        // Kiểm tra nếu trang có đuôi -add
        if (strpos($page, '-add') !== false) {
            // Lấy tên trang gốc bằng cách loại bỏ -add
            $basePage = str_replace('-add', '', $page);
            if (isset($titles[$basePage])) {
                // Thêm "THÊM" vào đầu và chuyển đổi toàn bộ tiêu đề thành chữ in hoa
                return "Thêm " . strtolower($titles[$basePage]);
            }
            return 'Dashboard';
        }
        if (strpos($page, '-edit') !== false) {
            $basePage = str_replace('-edit', '', $page);
            if (isset($titles[$basePage])) {
                return "Cập nhật " . strtolower($titles[$basePage]);
            }
            return 'Dashboard';
        }
        if (strpos($page, '-detail') !== false) {
            $basePage = str_replace('-detail', '', $page);
            if (isset($titles[$basePage])) {
                return "Chi tiết " . strtolower($titles[$basePage]);
            }
            return 'Dashboard';
        }
        // Nếu không có đuôi -add, trả về tiêu đề gốc với chữ in hoa
        return $titles[$page] ?? 'Dashboard';
    }

    // Lấy tiêu đề trang hiện tại
    $title = getPageTitle($page, $page_titles);
    ?>
    <title><?php echo $title; ?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <?php include('links.php'); ?>
</head>

<body class="g-sidenav-show  bg-gray-100">
    <?php include('sidebar.php'); ?>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <?php include('navbar.php'); ?>
        <div class="container-fluid py-4">
