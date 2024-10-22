<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    // Lấy tên trang hiện tại
    $page = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);

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
        'film-add' => 'Thêm phim',
        'categories-add' => 'Thêm thể loại phim',
    ];

    // Sử dụng giá trị mặc định nếu không có ánh xạ
    $title = $page_titles[$page] ?? 'Dashboard';
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
