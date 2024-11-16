<?php
require '../../config/function.php';
getAdmin();
$messages = [];

//====== user-add =======//
// Phần xử lý khi thêm tài khoản mới
if (isset($_POST['saveUser'])) {
    $messages = []; // Khởi tạo mảng thông báo lỗi
    $name = validate($_POST['name']); // Lấy và kiểm tra tên
    $username = validate($_POST['username']); // Lấy và kiểm tra tên đăng nhập
    $password = validate($_POST['password']); // Lấy và kiểm tra mật khẩu
    $re_password = validate($_POST['re_password']); // Lấy và kiểm tra xác nhận mật khẩu
    $ngay_sinh = validate($_POST['ngay_sinh']); // Lấy và kiểm tra ngày sinh
    $gioi_tinh = validate($_POST['gioi_tinh']) == 1 ? 1 : 0; // Lấy và kiểm tra giới tính
    $sdt = validate($_POST['sdt']); // Lấy và kiểm tra số điện thoại
    $email = validate($_POST['email']); // Lấy và kiểm tra email
    $role = validate($_POST['role']);
    $status = validate($_POST['status']) == 1 ? 1 : 0; // Lấy và kiểm tra trạng thái

    // Kiểm tra lỗi cho tên đăng nhập
    if (empty($username)) {
        $messages['tendn'] = "Tên đăng nhập không được để trống.";
    } else if (!preg_match('/^[a-zA-Z0-9]+$/', $username)) {
        $messages['tendn'] = "Tên đăng nhập chỉ chấp nhận chữ cái và số.";
    }
    if (isExistValue('taikhoan', 'TenDangNhap', $username)) {
        $messages['tendn'] = "Tên đăng nhập đã tồn tại";
    }

    // Kiểm tra lỗi cho mật khẩu
    if (empty($password)) {
        $messages['password'] = "Mật khẩu không được để trống.";
    } else if (!preg_match('/^(?=.*[A-Z])(?=.*[0-9])(?=.*[\W_]).{6,}$/', $password)) {
        $messages['password'] = "Mật khẩu phải có ít nhất 6 kí tự, bao gồm một chữ in hoa, một số và một ký tự đặc biệt.";
    }

    // Kiểm tra xác nhận mật khẩu
    if (empty($re_password)) {
        $messages['re_password'] = "Xác nhận mật khẩu không được để trống.";
    }

    // Kiểm tra lỗi cho email
    if (empty($email)) {
        $messages['email'] = "Email không được để trống.";
    } else if (isExistValue('NguoiDung', 'Email', $name)) {
        $messages['tendn'] = "Email đã tồn tại";
    }

    // Xử lý mã hóa mật khẩu
    $passwordDetails = validateAndHashPassword($password, $re_password);
    if (!$passwordDetails['status']) {
        $messages['re_password'] = $passwordDetails['message'];
    }
    $hashedPassword = $passwordDetails['hashed'];

    // Xử lý tải lên ảnh đại diện
    $avatar = '';
    if (isset($_FILES['avatar'])) {
        $avatarResult = uploadImage($_FILES['avatar'], "../../uploads/avatars/", $username);
        if ($avatarResult['success']) {
            $avatar = $avatarResult['filename'];
        } else {
            $messages[] = $avatarResult['message'];
        }
    }

    // Nếu không có lỗi, thực hiện lưu tài khoản vào cơ sở dữ liệu
    if (empty($messages)) {
        $query = "INSERT INTO taikhoan (TenDangNhap, MatKhau,TenND,Quyen)
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
// Phần xử lý khi sửa tài khoản
if (isset($_POST['editUser'])) {
    $messages = [];
    $id = validate($_POST['mand']); // Lấy và kiểm tra mã người dùng
    $name = validate($_POST['name']); // Lấy và kiểm tra tên
    $ngay_sinh = validate($_POST['ngay_sinh']); // Lấy và kiểm tra ngày sinh
    $gioi_tinh = validate($_POST['gioi_tinh']); // Lấy và kiểm tra giới tính
    $sdt = validate($_POST['sdt']); // Lấy và kiểm tra số điện thoại
    $email = validate($_POST['email']); // Lấy và kiểm tra email
    $status = validate($_POST['status']); // Lấy và kiểm tra trạng thái
    $user = getByID('NguoiDung', 'MaND', $id); // Lấy thông tin người dùng theo mã
    $avatar = $user['data']['Anh'];

    // Kiểm tra tên
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

    // Xử lý thay đổi ảnh đại diện
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
        $avatarPath = "../../uploads/avatars/" . $avatar;
        if (!empty($avatar) && file_exists($avatarPath)) {
            $deleteResult = deleteImage($avatarPath);
            if (!$deleteResult['success']) {
                $messages[] = $deleteResult['message'];
            }
        }
        $avatarResult = uploadImage($_FILES['avatar'], "../../uploads/avatars/", $id);
        if ($avatarResult['success']) {
            $avatar = $avatarResult['filename'];
        } else {
            $messages[] = $avatarResult['message'];
        }
    }

    // Nếu không có lỗi, thực hiện cập nhật thông tin người dùng vào cơ sở dữ liệu
    if (empty($messages)) {
        $query = "UPDATE nguoidung SET
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
        redirect('views/user/user-edit.php?id=' . $id, 'messages', $messages, 'admin');
        $_SESSION['form_data'] = $_POST;
    }
}

//====== changeStatus ======//
// Phần xử lý thay đổi trạng thái người dùng
if (isset($_POST['changeStatus'])) {
    $id = validate($_POST['mand']); // Lấy và kiểm tra mã người dùng
    $status = validate($_POST['status']) == 1 ? 1 : 0; // Xác định trạng thái mới

    $edit_query = "UPDATE nguoidung SET
                TrangThai = '$status',
                NguoiCapNhat = '$created',
                NgayCapNhat = CURRENT_TIMESTAMP
                WHERE MaND = '$id'";

    // Cập nhật trạng thái trong cơ sở dữ liệu
    if (mysqli_query($conn, $edit_query)) {
        redirect('user.php', 'success', 'Cập nhật trạng thái thành công', 'admin');
    } else {
        redirect('user.php', 'error', 'Cập nhật trạng thái thất bại', 'admin');
    }
}

$conn->close();
