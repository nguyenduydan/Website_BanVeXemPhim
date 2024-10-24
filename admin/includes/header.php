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
        'timeshow' => 'Danh sách suất chiếu',
        'user' => 'Danh sách người dùng',
        'room' => 'Danh sách phòng chiếu',
        'menu' => 'Danh sách menu',
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
        // Nếu không có đuôi -add, trả về tiêu đề gốc với chữ in hoa
        return $titles[$page] ?? 'Dashboard';
    }

    // Lấy tiêu đề trang hiện tại
    $title = getPageTitle($page, $page_titles);
    ?>

    <!-- Required meta tags -->
    <title><?php echo $title; ?></title>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <?php require('links.php'); ?>
</head>

<body class="g-sidenav-show  bg-gray-100">
    <!--Start sidebar-->
    <?php include('sidebar.php'); ?>
    <!--End sidebar-->
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!--Start navbar-->
        <?php include('navbar.php'); ?>
        <!--End sidebar-->
        <div class="container-fluid py-4">
