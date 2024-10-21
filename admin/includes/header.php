<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    //lấy tên trang hiện tại
    $page = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
    switch ($page) {
        case 'dashboard': {
                $title = 'Dashboard';
                break;
            }
        case 'film-list': {
                $title = 'Danh sách phim';
                break;
            }
        case 'film-add': {
                $title = 'Thêm phim';
                break;
            }
        default: {
                $title = 'Dashboard'; // Trường hợp mặc định nếu không có trang hợp lệ
            }
    }
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
