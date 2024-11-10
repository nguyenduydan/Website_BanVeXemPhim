<?php
session_start();
require '../../config/function.php';
getAdmin();
$messages = [];
//====== user-add =======//
if (isset($_POST['saveUser'])) {
    $messages = []; // Initialize messages array
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
    // Kiểm tra không được để trống
    if (empty($name)) {
        $messages['name'] = "Họ và tên không được để trống.";
    }
    if (empty($username)) {
        $messages['username'] = "Tên người dùng không được để trống.";
    } elseif (isExistValue('NguoiDung', 'username', $username)) {
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
    } elseif (isExistValue('NguoiDung', 'Email', $email)) {
        $messages['email'] = "Email đã tồn tại";
    }

    // Hash password
    $passwordDetails = validateAndHashPassword($password, $re_password);
    if (!$passwordDetails['status']) {
        $messages['re_password'] = $passwordDetails['message'];
    }
    $hashedPassword = $passwordDetails['hashed'];
    // Handle avatar upload
    $avatar = '';
    if (isset($_FILES['avatar'])) {
        // Use username as filename for the avatar
        $avatarResult = uploadImage($_FILES['avatar'], "../../uploads/avatars/", $username);
        if ($avatarResult['success']) {
            $avatar = $avatarResult['filename'];
        } else {
            $messages[] = $avatarResult['message'];
        }
    }
    if (empty($messages)) {
        $query = "INSERT INTO TaiKhoan (TenDangNhap, MatKhau,TenND,Quyen)
                  VALUES ('$username', '$hashedPassword','$name','$role')";

        if (mysqli_query($conn, $query)) {
            $maND = mysqli_insert_id($conn);
            $insert_query = "INSERT INTO nguoidung (MaND,TenND, NgaySinh, GioiTinh, SDT, Anh, Email, NguoiTao, NgayTao, NguoiCapNhat, NgayCapNhat, TrangThai)
                  VALUES ('$maND','$name', '$ngay_sinh', '$gioi_tinh', '$sdt', '$avatar', '$email', '$created', CURRENT_TIMESTAMP, '$created', CURRENT_TIMESTAMP, '$status')";
            mysqli_query($conn, $insert_query);
            redirect('user.php', 'success', 'Thêm tài khoản thành công', 'admin');
        } else {
            redirect('views/user/user-add.php', 'error', 'Thêm tài khoản thất bại', 'admin');
        }
    } else {
        $_SESSION['form_data'] = $_POST;
        redirect('views/user/user-add.php', 'messages', $messages, 'admin');
    }
}

//====== user-edit =======//
if (isset($_POST['editUser'])) {
    $messages = [];
    $id = validate($_POST['mand']);
    $name = validate($_POST['name']);
    $ngay_sinh = validate($_POST['ngay_sinh']);
    $gioi_tinh = validate($_POST['gioi_tinh']);
    $sdt = validate($_POST['sdt']);
    $email = validate($_POST['email']);
    $status = validate($_POST['status']);
    $user = getByID('NguoiDung', 'MaND', $id);
    $avatar = $user['data']['Anh'];
    // Kiểm tra tên người dùng
    if (empty($name)) {
        $messages['name'] = "Họ và tên không được để trống.";
    }
    if (empty($ngay_sinh)) {
        $messages['ngay_sinh'] = "Ngày sinh không được để trống.";
    }
    if (empty($email)) {
        $messages['email'] = "Email không được để trống.";
    } elseif (isExistValue('NguoiDung', 'Email', $email, 'MaND', $id)) {
        $messages['email'] = "Email đã tồn tại";
    }
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
        // If a new avatar is uploaded, delete the old one
        $avatarPath = "../../uploads/avatars/" . $avatar;
        if (!empty($avatar) && file_exists($avatarPath)) {
            $deleteResult = deleteImage($avatarPath);
            if (!$deleteResult['success']) {
                $messages[] = $deleteResult['message'];
            }
        }

        // Upload the avatar with the username as the filename
        $avatarResult = uploadImage($_FILES['avatar'], "../../uploads/avatars/", $username); // Pass username
        if ($avatarResult['success']) {
            $avatar = $avatarResult['filename'];
        } else {
            $messages[] = $avatarResult['message'];
        }
    }
    if (empty($messages)) {

        $query = "UPDATE NguoiDung SET
                TenND = '$name',
                NgaySinh = '$ngay_sinh',
                GioiTinh = '$gioi_tinh',
                SDT = '$sdt',
                Anh = '$avatar',
                Email = '$email',
                NguoiCapNhat = '$created',
                NgayCapNhat = CURRENT_TIMESTAMP,
                TrangThai = '$status'
                WHERE MaND = '$id'";

        if (mysqli_query($conn, $query)) {
            redirect('user.php', 'success', 'Cập nhật tài khoản thành công', 'admin');
        } else {
            redirect('views/user/user-edit.php?id=' . $id, 'error', 'Cập nhật tài khoản thất bại', 'admin');
        }
    } else {
        redirect('views/user/user-edit.php?id=' . $id, 'errors', $messages, 'admin');
        $_SESSION['form_data'] = $_POST;
    }
}


//====== changeStatus ======//
if (isset($_POST['changeStatus'])) {
    $id = validate($_POST['mand']);
    $status = validate($_POST['status']) == 1 ? 1 : 0;

    $edit_query = "UPDATE NguoiDung SET
                TrangThai = '$status',
                NguoiCapNhat = '$created',
                NgayCapNhat = CURRENT_TIMESTAMP
                WHERE MaND = '$id'";

    if (mysqli_query($conn, $edit_query)) {
        redirect('user.php', 'success', 'Cập nhật trạng thái thành công', 'admin');
    } else {
        redirect('user.php', 'error', 'Cập nhật trạng thái thất bại', 'admin');
    }
}
$conn->close();
