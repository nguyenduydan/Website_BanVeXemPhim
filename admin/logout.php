<?php
require_once '../config/function.php';
session_start();
$_SESSION['loggedIn'] = false;
$_SESSION['EmployedIn'] = false;
redirect('sign-in.php', 'success', 'Đăng xuất thành công', 'admin');