<?php
    require '../../config/function.php';
    if (isset($_POST['saveUser'])) {
        $name = validate($_POST['name']);
        $password = validate($_POST['password']);
        $re_password = validate($_POST['re_password']);
        $ngay_sinh = validate($_POST['ngay_sinh']);
        $gioi_tinh = validate($_POST['gioi_tinh']);
        $sdt = validate($_POST['sdt']);
        $email = validate($_POST['email']);
        $role = validate($_POST['role']);
        $status = validate($_POST['status']);
        
        // Xử lý tệp avatar
        $avatar = '';
        if (isset($_FILES['avatar'])) {
            $targetDir = "assets/imgs/";
            $targetFile = $targetDir . basename($_FILES["avatar"]["name"]);
            move_uploaded_file($_FILES["avatar"]["tmp_name"], $targetFile);
            $avatar = $targetFile;
        }
    
        if ($name != '' && $email != '' && $password != '' && $re_password != '' && $role != '' && $sdt != '') {
            $ngay_tao = date('Y-m-d H:i:s'); 
            $query = "INSERT INTO NguoiDung (TenND, NgaySinh, GioiTinh, SDT, Anh, Email, MatKhau, XacNhanMatKhau, Role, NguoiTao, NgayTao, TrangThai)
                      VALUES ('$name', '$ngay_sinh', '$gioi_tinh', '$sdt', '$avatar', '$email', '$password', '$re_password', '$role', '1', '$ngay_tao', '$status')";
            
            $result = mysqli_query($conn, $query);
            if($result){
                redirect('../user.php','Thêm tài khoản thành công');
            } else {
                redirect('../user.php','Thêm tài khoản thất bại');
            }
        } else {
            redirect('../user.php','Vui lòng điền đầy đủ thông tin');
        }
    }
?>