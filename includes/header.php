<?php global $title; ?>
<!doctype html>
<html lang="en">
<?php
require($_SERVER['DOCUMENT_ROOT'] . '/Website_BanVeXemPhim/config/session.php'); ?>

<head>

    <title><?= isset($title) ? $title : "Trang chủ" ?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <?php require('links.php'); ?>
</head>
<style>
    #scrollToTopBtn {
        position: fixed;
        bottom: 20px;
        right: 20px;
        display: none;
        /* Ẩn nút khi chưa cuộn xuống */
        background: linear-gradient(61deg, rgba(127, 51, 255, 1) 0%, rgba(97, 3, 108, 1) 0%, rgba(127, 51, 255, 1) 100%);
        color: white;
        border: none;
        border-radius: 50%;
        padding: 10px 15px;
        cursor: pointer;
        font-size: 16px;
        transition: background 0.5s ease-in-out;
    }

    #scrollToTopBtn:hover {
        background: linear-gradient(90deg, rgba(97, 3, 108, 1) 0%, rgba(127, 51, 255, 1) 0%, rgba(97, 3, 108, 1) 100%);
    }
</style>

<body>
    <main class="main-content position-relative max-height-vh-100 h-100">
        <?php include('navbar.php'); ?>
        <button id="scrollToTopBtn" class="shadow-1" onclick="scrollToTop()"><i
                class="bi bi-chevron-double-up"></i></button>
        <div class="container-fluid px-0">
