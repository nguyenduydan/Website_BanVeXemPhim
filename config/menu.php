<?php

function redirectTo($url)
{
    if (!headers_sent()) {
        header("Location: " . $url);
        exit();
    } else {
        echo "<script>window.location.href='" . $url . "';</script>";
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['page'])) {
    $page = $_POST['page'];

    if (filter_var($page, FILTER_VALIDATE_URL) || file_exists($page)) {
        redirectTo($page);
    } else {
        redirectTo('views/404.php');
    }
}