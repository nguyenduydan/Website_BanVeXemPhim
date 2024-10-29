<?php
session_start();
require '../../config/function.php';

$messages = [];
//====== user-add =======//
if (isset($_POST['saveUser'])) {
    $name = validate($_POST['name']);
    $username = validate($_POST['username']);
    $password = validate($_POST['password']);
    $re_password = validate($_POST['re_password']);
    $ngay_sinh = validate($_POST['ngay_sinh']);
    $gioi_tinh = validate($_POST['gioi_tinh']) == 1 ? 1 : 0;
    $sdt = validate($_POST['sdt']);
    $email = validate($_POST['email']);
    $role = validate($_POST['role']);
    $status = validate($_POST['status']) == 1 ? 1 : 0;

    //Kiểm tra không được để trống
    if (empty($name)) {
        $messages['name'] = "Họ và tên không được để trống.";
    }
    if (empty($username)) {
        $messages['username'] = "Tên người dùng không được để trống.";
    } else if (isUsername($username)) {
        $messages['username'] = "Tên người dùng đã tồn tại";
    }

    if (empty($password)) {
        $messages['password'] = "Mật khẩu không được để trống.";
    } elseif (strlen($password) < 6) {
        $messages['password'] = "Mật khẩu phải từ 6 kí tự trở lên";
    }
    if (empty($re_password)) {
        $messages['re_password'] = "Xác nhận mật khẩu không được để trống.";
    }
    if (empty($ngay_sinh)) {
        $messages['ngay_sinh'] = "Ngày sinh không được để trống.";
    }
    if (empty($email)) {
        $messages['email'] = "Email không được để trống.";
    } elseif (isEmail($email)) {
        $messages['email'] = "Email đã tồn tại";
    }


    // Hash password
    $passwordDetails = validateAndHashPassword($password, $re_password);
    if (!$passwordDetails['status']) {
        $messages['re_password'] = $passwordDetails['message'];
    }
    $hashedPassword = $passwordDetails['hashed'];

    if (empty($messages)) {
        // Handle avatar upload
        $avatar = '';
        if (isset($_FILES['avatar'])) {
            $avatarResult = uploadImage($_FILES['avatar'], "../../uploads/avatars/");
            if ($avatarResult['success']) {
                $avatar =  $avatarResult['filename'];
            } else {
                $messages[] = $avatarResult['message'];
            }
        }
        // Insert into database
        $ngay_tao = date('Y-m-d H:i:s');
        $query = "INSERT INTO nguoidung (TenND, username, NgaySinh, GioiTinh, SDT, Anh, Email, MatKhau, Role, NguoiTao, NgayTao,NguoiCapNhat, NgayCapNhat, TrangThai)
                  VALUES ('$name', '$username', '$ngay_sinh', '$gioi_tinh', '$sdt', '$avatar', '$email', '$hashedPassword', '$role', '1', '$ngay_tao','1', '$ngay_tao', '$status')";

        if (mysqli_query($conn, $query)) {
            redirect('../user.php','success','Thêm tài khoản thành công');
        } else {
            redirect('../views/user/user-add.php','error','Thêm tài khoản thất bại');
        }
    } else {
        $_SESSION['form_data'] = $_POST;
        redirect('../views/user/user-add.php','messages',$messages);
    }
}

//====== user-edit =======//
if (isset($_POST['editUser'])) {
    $messages = [];
    $id = validate($_POST['mand']);
    $name = validate($_POST['name']);
    $username = validate($_POST['username']);
    $ngay_sinh = validate($_POST['ngay_sinh']);
    $gioi_tinh = validate($_POST['gioi_tinh']);
    $sdt = validate($_POST['sdt']);
    $email = validate($_POST['email']);
    $role = validate($_POST['role']);
    $status = validate($_POST['status']);

    // Kiểm tra tên người dùng
    if (empty($name)) {
        $messages['name'] = "Họ và tên không được để trống.";
    }
    if (empty($username)) {
        $messages['username'] = "Tên người dùng không được để trống.";
    } else {
        // Kiểm tra tính duy nhất của username
        if (isUsername($username, $id)) {
            $messages['username'] = "Tên người dùng đã tồn tại";
        }
    }
    if (empty($ngay_sinh)) {
        $messages['ngay_sinh'] = "Ngày sinh không được để trống.";
    }
    if (empty($email)) {
        $messages['email'] = "Email không được để trống.";
    } elseif (isEmail($email, $id)) {
        $messages['email'] = "Email đã tồn tại";
    }

    $user = getByID('NguoiDung', 'MaND', $id);
    if (empty($messages)) {
        if (isset($_POST['deleteAvatar'])) {
            $avatarPath = "../../uploads/avatars/" . $user['data']['Anh'];
            $deleteResult = deleteImage($avatarPath);
        }
        $avatar = $user['data']['Anh'];
        if (isset($_FILES['avatar'])) {
            $avatarResult = uploadImage($_FILES['avatar'], "../../uploads/avatars/");
            if ($avatarResult['success']) {
                $avatar =  $avatarResult['filename'];
            } else {
                $messages[] = $avatarResult['message'];
            }
        }
        $ngay_tao = date('Y-m-d H:i:s');
        $query = "UPDATE NguoiDung SET
                TenND = '$name',
                username = '$username',
                NgaySinh = '$ngay_sinh',
                GioiTinh = '$gioi_tinh',
                SDT = '$sdt',
                Anh = '$avatar',
                Email = '$email',
                Role = '$role',
                NgayCapNhat = '$ngay_tao',
                TrangThai = '$status'
                WHERE MaND = '$id'";

        if (mysqli_query($conn, $query)) {
            redirect('../user.php','success','Cập nhật tài khoản thành công');
        } else {
            redirect('../views/user/user-edit.php?id=" '. $id,'error','Cập nhật tài khoản thất bại');
        }
    } else {
        redirect('../views/user/user-edit.php?id=" '. $id,'errors',$messages);
        $_SESSION['form_data'] = $_POST;
    }
}

//====== changeStatus ======//
if (isset($_POST['changeStatus'])) {
    $id = validate($_POST['mand']);
    $status = validate($_POST['status']) == 1 ? 1 : 0;

    $edit_query = "UPDATE NguoiDung SET TrangThai = '$status' WHERE MaND = '$id'";

    if (mysqli_query($conn, $edit_query)) {
        redirect('../user.php','success','Cập nhật trạng thái thành công');
    } else {
        redirect('../user.php','error','Cập nhật trạng thái thất bại');
    }
}
