<?php global $title; ?>
<!doctype html>
<html lang="en">

<head>

    <title><?= isset($title) ? $title : "Trang chủ" ?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <?php require('links.php'); ?>
</head>

<body>
    <main class="main-content position-relative max-height-vh-100 h-100">
        <?php include('navbar.php'); ?>
        <div class="container-fluid px-0">
