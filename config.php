<!-- File cấu hình chứa thông tin kết nối database, thông số cài đặt chung. -->
<?php

//Thông tin kết nối
$host = 'localhost';
$username = 'root';
$password = '';
$databae = 'project_film';

$conn = new mysqli($host, $username, $password, $databae);


// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}


?>
