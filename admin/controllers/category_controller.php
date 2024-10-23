<?php
    require '../config/function.php';
    // xử lý categories
    if(isset($_POST['saveGenres'])){
        $ngay_tao = new DateTime();
        $name = validate($_POST['ten_the_loai']);
        $trangthai = validate($_POST['trang_thai']);
        if($name != '' && $trangthai !=''){
            $query = "INSERT INTO theloai (TenTheLoai,NguoiTao,NgayTao,NguoiCapNhat,NgayCapNhat,TrangThai)
            VALUES ('$name',1,'$ngay_tao',1,'$ngay_tao','$trangthai')";
        }
        $result = mysqli_query($conn, $query);
        // Thực thi câu lệnh
        if($result){
            redirect('categories.php','Thêm tài khoản thành công');
        } else {
            redirect('categories.php','Thêm tài khoản thất bại');
        }
    } else {
        redirect('categories.php','Vui lòng điền đầy đủ thông tin');
    }
    $category_list = 'SELECT * FROM theloai';
    $result = mysqli_query($conn, $category_list);
?>
