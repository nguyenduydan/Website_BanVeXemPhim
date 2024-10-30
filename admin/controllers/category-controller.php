<?php
session_start();
require '../../config/function.php';
// xử lý categories
$messages = [];
if (isset($_POST['saveCategory'])) {
    $ngay_tao = new DateTime();
    $name = validate($_POST['ten_the_loai']);
    $trangthai = validate($_POST['trang_thai']);
    if(empty($name)){
        $messages['name'] = 'Tên thể loại không được để trống';
    }
    if (empty($messages)) {
        $ngay_tao = date('Y-m-d H:i:s');
        $query = "INSERT INTO theloai (TenTheLoai,NguoiTao,NgayTao,NguoiCapNhat,NgayCapNhat,TrangThai)
            VALUES ('$name',1,'$ngay_tao',1,'$ngay_tao','$trangthai')";
        if (mysqli_query($conn, $query)) {
            redirect('../categories.php','success','Thêm tài khoản thành công');
        } else {
            redirect('../views/category/categories-add.php','error','Thêm tài khoản thất bại');
        }
    } else {
        $_SESSION['form_data'] = $_POST;
        redirect('../views/category/category-add.php', 'messages', $messages);
    }
}
