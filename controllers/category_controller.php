<?php

include('../config.php');

$category_id;
$category_name;
$person_created;
$time_created;
$person_updated;
$time_updated;
$status;

$category_list = 'SELECT * FROM theloai';
$result = mysqli_query($conn, $category_list);


// Đóng kết nối
mysqli_close($conn);
