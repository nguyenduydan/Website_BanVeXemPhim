<?php
session_start();
require '../../config/function.php';

// xử lý categories
$messages = [];
if (isset($_POST['signup'])) {
    $tennd = validate($_POST['tennd']);
    $password = validate($_POST['password']);
    $tendn = validate($_POST['tendn']);
    $re_password = validate($_POST['re_password']);
    $captchaResponse = $_POST['g-recaptcha-response'];
    $secretKey = "6LddNHoqAAAAAOyi3IX4uU4dxgNnB29kbHUgjQcK";
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$captchaResponse}");
    $responseKeys = json_decode($response, true);

    if (intval($responseKeys["success"]) !== 1) {
        $messages['captcha'] = "Vui lòng xác nhận rằng bạn không phải là robot.";
    }
    $role = 0;
    $status = 1;
    if (empty($tendn)) {
        $messages['tendn'] = "Tên đăng nhập không được để trống.";
    } else if (!preg_match('/^[a-zA-Z]+$/', $tendn)) {
        $messages['tendn'] = "Tên đăng nhập chỉ chấp nhận chữ cái.";
    }
    if (empty($tendn)) {
        $messages['tendn'] = "Tên đăng nhập không được để trống.";
    } else if (!preg_match('/^[a-zA-Z0-9]+$/', $tendn)) {
        $messages['tendn'] = "Tên đăng nhập chỉ chấp nhận chữ cái và số.";
    }
    if (isExistValue('TaiKhoan', 'tendn', $tendn)) {
        $messages['tendn'] = "Tên đăng nhập đã tồn tại";
    }
    if (isExistValue('TaiKhoan', 'tendn', $tendn)) {
        $messages['tendn'] = "Tên đăng nhập đã tồn tại";
    }
    if (empty($password)) {
        $messages['password'] = "Mật khẩu không được để trống.";
    } else if (!preg_match('/^(?=.*[A-Z])(?=.*[0-9])(?=.*[\W_]).{6,}$/', $password)) {
        $messages['password'] = "Mật khẩu phải có ít nhất 6 kí tự, bao gồm một chữ in hoa, một số và một ký tự đặc biệt.";
    }
    if (empty($re_password)) {
        $messages['re_password'] = "Xác nhận mật khẩu không được để trống.";
    }

    $passwordDetails = validateAndHashPassword($password, $re_password);

    if ($passwordDetails['status'] == false) {
        $messages['password'] = $passwordDetails['message'];
    }
    $hashedPassword = $passwordDetails['hashed'];

    $avatar = '';
    $unique = uniqid('user_', false);
    if (isset($_FILES['avatar'])) {
        // Use usertennd as filetennd for the avatar
        $avatarResult = uploadImage($_FILES['avatar'], "../../uploads/avatars/", $unique);
        if ($avatarResult['success']) {
            $avatar = $avatarResult['filename'];
        } else {
            $messages[] = $avatarResult['message'];
        }
    }

    if (empty($messages)) {
        $query = "INSERT INTO TaiKhoan (TenDangNhap, MatKhau,TenND,Quyen)
                  VALUES ('$tendn', '$hashedPassword','$tennd','$role')";

        if (mysqli_query($conn, $query)) {
            $maND = mysqli_insert_id($conn);
            $insert_query = "INSERT INTO NguoiDung(MaND,TenND,NguoiTao,NgayTao,NguoiCapNhat,NgayCapNhat,TrangThai)
                            VALUES('$maND','$tennd','0',CURRENT_TIMESTAMP,'0',CURRENT_TIMESTAMP,'1')";
            mysqli_query($conn, $insert_query);
            redirect('login.php', 'success', 'Tạo tài khoản thành công');
        } else {
            redirect('register.php', 'error', 'Tạo tài khoản thất bại');
        }
    } else {
        $_SESSION['form_data'] = $_POST;
        redirect('register.php', 'messages', $messages);
    }
}
if (isset($_POST['login'])) {
    $tendn = validate($_POST['tendn']);
    $password = validate($_POST['password']);
    $messages = [];

    if (empty($tendn)) {
        $messages['tendn'] = 'Tên đăng nhập không được bỏ trống';
    }
    if (empty($password)) {
        $messages['password'] = 'Mật khẩu không được bỏ trống';
    }

    if (empty($messages)) {
        $user = getByID('TaiKhoan', 'TenDangNhap', $tendn);
        if ($user['status'] == 200 && $user['data']['Role'] == 0) {
            if (password_verify($password, $user['data']['MatKhau'])) {
                $_SESSION['NDloggedIn'] = true;
                $_SESSION['NDId'] = $user['data']['MaND'];
                redirect('index.php', 'success', 'Đăng nhập thành công');
            } else {
                $messages['password'] = 'Sai mật khẩu';
                $_SESSION['form_data'] = $_POST;
                redirect('login.php', 'messages', $messages);
            }
        } else {
            redirect('login.php', 'error', 'Đăng nhập thất bại');
        }
    } else {
        // Lưu thông tin lỗi và dữ liệu form vào session nếu có lỗi
        $_SESSION['form_data'] = $_POST;
        redirect('login.php', 'messages', $messages);
    }
}
$conn->close();
