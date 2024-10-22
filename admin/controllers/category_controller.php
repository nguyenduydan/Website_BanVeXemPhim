<?php

$category_id;
$category_name;
$person_created;
$time_created;
$person_updated;
$time_updated;
$status;

$category_list = 'SELECT * FROM theloai_film';
$result = mysqli_query($conn, $category_list);
while ($row = mysqli_fetch_assoc($result)) {
    // Lưu trữ từng phần của dữ liệu trong biến
    $categoryId = $row['MaTheLoai'];
    $categoryName = $row['TenTheLoai'];
    $personCreated = $row['NguoiTao'];
    $status = $row['TrangThai'];
    $timeCreated = $row['NgayTao'];
}


// Đóng kết nối
mysqli_close($conn);
