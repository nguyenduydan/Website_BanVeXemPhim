<?php

session_start();
$_SESSION['loggedIn'] = false;
session_unset();
session_destroy();

redirect('sign-in.php','success','Đăng xuất thành công');
?>
