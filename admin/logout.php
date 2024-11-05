<?php
require_once '../config/function.php';
session_start();
$_SESSION['loggedIn'] = false;

// Hủy tất cả dữ liệu trong session
session_unset();

// Hủy session
session_destroy();


redirect('sign-in.php', 'success', 'Đăng xuất thành công');
