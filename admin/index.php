<?php

require_once '../config/function.php';
include('includes/header.php');
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    redirect('sign-in.php', 'error', 'Vui lòng đăng nhập');
}
?>
<div id="toast"></div>

<?php alertMessage() ?>

<?php include('dashboard.php') ?>

<?php include('includes/footer.php'); ?>
