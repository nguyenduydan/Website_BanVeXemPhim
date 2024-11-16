<?php
require_once '../config/function.php';
$_SESSION['loggedIn'] = false;
$_SESSION['EmployedIn'] = false;
redirect('sign-in.php', 'success', 'Đăng xuất thành công', 'admin');