<?php
require '../../config/function.php';


$errors = [];
$response = [];
if (isset($_POST['saveUser'])) {
    $name = validate($_POST['name']);
    $username = validate($_POST['username']);
    $password = validate($_POST['password']);
    $re_password = validate($_POST['re_password']);
    $ngay_sinh = validate($_POST['ngay_sinh']);
    $gioi_tinh = validate($_POST['gioi_tinh']);
    $sdt = validate($_POST['sdt']);
    $email = validate($_POST['email']);
    $role = validate($_POST['role']);
    $status = validate($_POST['status']);

    // Kiểm tra tên đăng nhập hoặc email tồn tại
    if (isUsernameAndEmailExists($username, $email)) {
        echo '<span style="color:red;">Tên đăng nhập hoặc email đã tồn tại, vui lòng sử dụng tên khác</span>';
        exit(); // Exit to stop further processing
    }
    
    $avatar = '';
    if (isset($_FILES['avatar'])) {
        $avatarResult = uploadAvatar($_FILES['avatar'], "upload/avatars/");
        if ($avatarResult['success']) {
            $avatar = $avatarResult['filename'];  
        } else {
            $errors[] = $avatarResult['message']; 
        }
    }
    
    // Kiểm tra và băm mật khẩu
    $passwordDetails = validateAndHashPassword($password, $re_password);
    if (!$passwordDetails['status']) {
        $errors[] = $passwordDetails['message'];
    }
    $hashedPassword = $passwordDetails['hashed'];

    if (empty($errors)) {
        $ngay_tao = date('Y-m-d H:i:s');
        $query = "INSERT INTO NguoiDung (TenND, username, NgaySinh, GioiTinh, SDT, Anh, Email, MatKhau, Role, NguoiTao, NgayTao, TrangThai)
                  VALUES ('$name', '$username', '$ngay_sinh', '$gioi_tinh', '$sdt', '$avatar', '$email', '$hashedPassword', '$role', '1', '$ngay_tao', '$status')";
        
        $result = mysqli_query($conn, $query);
        if ($result) {
            $response['success'] = true;
            $response['message'] = 'Thêm tài khoản thành công';
        } else {
            $response['success'] = false;
            $errors[] = 'Thêm tài khoản thất bại';
        }
    }
    if ($errors) {
        echo json_encode(['success' => false, 'errors' => $errors]);
    } else {
        echo json_encode(['success' => true]);
    }
    
    exit();

 
}
?>
