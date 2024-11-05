<?php
require_once '../config/function.php';
session_start();
$_SESSION['loggedIn'] = false;

redirect('sign-in.php','success','Đăng xuất thành công');
?>
