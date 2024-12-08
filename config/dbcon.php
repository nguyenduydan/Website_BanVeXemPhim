<?php
define('DB_SERVER', "localhost");
define('DB_USERNAME', "root");
define('DB_PASSWORD', "");
define('DB_DATABASE', "project_film");

// Trong PHP, ký tự @ được sử dụng để tắt thông báo lỗi cho biểu thức ngay sau nó.
//Khi bạn sử dụng @ trước một hàm hoặc biểu thức, nếu hàm đó phát sinh lỗi, thông báo lỗi sẽ không được hiển thị ra màn hình.

$conn = @mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

mysqli_set_charset($conn, 'utf8');
if (!$conn) {
    die("Kết nối thất bại." . mysqli_connect_error());
}
