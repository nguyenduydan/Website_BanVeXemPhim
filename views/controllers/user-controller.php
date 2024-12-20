<?php
session_start();
require_once '../../config/function.php';
require_once '../../config/sendmail.php';


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

    if (empty($tennd)) {
        $messages['tennd'] = "Tên người dùng không được để trống.";
    } else if (!preg_match('/^[\p{L}\s.,]+$/u', $tennd)) {
        $messages['tennd'] = "Tên người dùng không được dùng kí tự đặc biệt";
    }

    if (empty($tendn)) {
        $messages['tendn'] = "Tên đăng nhập không được để trống.";
    } else if (!preg_match('/^[a-zA-Z0-9]+$/', $tendn)) {
        $messages['tendn'] = "Tên đăng nhập chỉ chấp nhận chữ cái và số.";
    }
    if (isExistValue('TaiKhoan', 'TenDangNhap', $tendn)) {
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
        if ($user['status'] == 200 && $user['data']['Quyen'] == 0) {
            if (password_verify($password, $user['data']['MatKhau'])) {
                $_SESSION['NDloggedIn'] = true;
                $_SESSION['NDId'] = $user['data']['MaND'];
                $_SESSION['lastActivity'] = time();
                $_SESSION['role'] = 'user';
                // Kiểm tra nếu checkbox 'rememberMe' được chọn
                if (isset($_POST['remember_me']) && $_POST['remember_me'] == '1') {
                    $_SESSION['rememberMe'] = true; // Lưu vào session

                    // Lưu cookie cho 'username' trong 30 ngày
                    setcookie('username', $username, time() + (30 * 24 * 60 * 60), "/"); // 30 ngày
                } else {
                    $_SESSION['rememberMe'] = false;

                    // Xóa cookie nếu 'rememberMe' không được chọn
                    if (isset($_COOKIE['username'])) {
                        setcookie('username', '', time() - 3600, "/");
                    }
                }

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
//====== user-edit =======//
if (isset($_POST['updateInf'])) {
    $messages = [];
    $id = validate($_POST['mand']);
    $name = validate($_POST['tennd']);
    $ngay_sinh = validate($_POST['ngay_sinh']) ?? null;
    $gioi_tinh = validate($_POST['gioi_tinh']) ?? null;
    $sdt = validate($_POST['sdt']) ?? null;
    $email = validate($_POST['email']) ?? null;
    // Kiểm tra tên người dùng
    if (empty($name)) {
        $messages['tennd'] = "Họ và tên không được để trống.";
    }
    if (isExistValue('nguoidung', 'Email', $email, 'MaND', $id)) {
        $messages['email'] = "Email đã tồn tại";
    }
    if (!preg_match('/^0[0-9]+$/', $sdt)) {
        $messages['sdt'] = "Số điện thoại phải là số nguyên và bắt đầu bằng số 0.";
    }
    if (empty($messages)) {

        $query = "UPDATE nguoidung SET
                TenND = '$name',
                NgaySinh = '$ngay_sinh',
                GioiTinh = '$gioi_tinh',
                SDT = '$sdt',
                Email = '$email',
                NguoiCapNhat = '$id',
                NgayCapNhat = CURRENT_TIMESTAMP
                WHERE MaND = '$id'";

        if (mysqli_query($conn, $query)) {
            redirect('profile-user.php', 'success', 'Cập nhật tài khoản thành công');
        } else {
            redirect('profile-user.php', 'error', 'Cập nhật tài khoản thất bại');
        }
    } else {
        redirect('profile-user.php', 'messages', $messages);
        $_SESSION['form_data'] = $_POST;
    }
}

if (isset($_POST['change-password-form'])) {
    $messages = [];
    $id = validate($_POST['mand']);
    $pwd = validate($_POST['old-password']);
    $newPassword = validate($_POST['new-password']);
    $rePassword = validate($_POST['new-repassword']);

    $user = getByID('taikhoan', 'MaND', $id);

    // Kiểm tra tên người dùng
    if (empty($pwd)) {
        $messages['old-password'] = 'Không được để trống';
    } elseif (!password_verify($pwd, $user['data']['MatKhau'])) { // So sánh mật khẩu cũ
        $messages['old-password'] = 'Sai mật khẩu';
    }

    if (empty($newPassword)) {
        $messages['new-password'] = 'Không được để trống';
    } else if (!preg_match('/^(?=.*[A-Z])(?=.*[0-9])(?=.*[\W_]).{6,}$/', $newPassword)) {
        $messages['new-password'] = "Mật khẩu phải có ít nhất 6 kí tự, bao gồm một chữ in hoa, một số và một ký tự đặc biệt.";
    }
    if (empty($rePassword)) {
        $messages['new-repassword'] = 'Không được để trống';
    }

    $passwordDetails = validateAndHashPassword($newPassword, $rePassword);

    if ($passwordDetails['status'] == false) {
        $messages['password'] = $passwordDetails['message'];
    }
    $hashedPassword = $passwordDetails['hashed'];

    if (empty($messages)) {

        $query = "UPDATE taikhoan SET
                    MatKhau = '$hashedPassword'
                WHERE MaND = '$id'";

        if (mysqli_query($conn, $query)) {
            redirect('profile-user.php', 'success', 'Cập nhật mật khẩu thành công');
        } else {
            redirect('profile-user.php', 'error', 'Cập nhật mật khẩu thất bại');
        }
    } else {
        redirect('profile-user.php', 'messages', $messages);
        $_SESSION['form_data'] = $_POST;
    }
}

//====== user-edit =======//
if (isset($_POST['updateAvt'])) {
    $messages = [];
    $id = validate($_POST['mand']);
    $user = getByID('NguoiDung', 'MaND', $id);
    $currentAvatar = $user['data']['Anh'];
    $unique = uniqid('user_', false);

    if (isset($_FILES['avatar'])) {
        if (!empty($currentAvatar)) {
            $avatarPath = $_SERVER['DOCUMENT_ROOT'] . "/Website_BanVeXemPhim/uploads/avatars/" . $currentAvatar;
            if (file_exists($avatarPath)) {
                $deleteResult = deleteImage($avatarPath);
                if (!$deleteResult['success']) {
                    $messages[] = $deleteResult['message'];
                }
            }
        }
        $avatarResult = uploadImage($_FILES['avatar'], $_SERVER['DOCUMENT_ROOT'] . "/Website_BanVeXemPhim/uploads/avatars/", $unique);
        if ($avatarResult['success']) {
            $avatar = $avatarResult['filename'];
        } else {
            $messages[] = $avatarResult['message'];
        }
    }
    if (empty($messages)) {

        $query = "UPDATE NguoiDung SET
                Anh = '$avatar',
                NguoiCapNhat = '$id',
                NgayCapNhat = CURRENT_TIMESTAMP
                WHERE MaND = '$id'";

        if (mysqli_query($conn, $query)) {
            redirect('profile-user.php', 'success', 'Cập nhật avatar thành công');
        } else {
            redirect('profile-user.php', 'error', 'Cập nhật avatar thất bại');
        }
    } else {
        redirect('profile-user.php', 'messages', $messages);
        $_SESSION['form_data'] = $_POST;
    }
}

if (isset($_POST['forget-password'])) {
    $messages = []; // Khởi tạo mảng thông báo
    $recipientEmail = validate($_POST['email-fpwd']); // Địa chỉ email của người nhận
    $username = validate($_POST['username-fpwd']);
    $user = getByID('taikhoan', 'TenDangNhap', $username);
    $subject = 'Thay đổi mật khẩu';

    if (empty($recipientEmail)) {
        $messages["email-fpwd"] = "Email không được để trống";
    }
    if (empty($user)) {
        $messages["username-fpwd"] = "Tên đăng nhập không được để trống";
    } else if (!isset($user['data']['TenDangNhap'])) {
        $messages["username-fpwd"] = "Tên đăng nhập không tồn tại";
    }

    if (empty($messages)) {
        $password = generateRandomPassword(6);
        $newPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "UPDATE taikhoan SET
                    MatKhau = '$newPassword'
                WHERE TenDangNhap = '$username'";
        // Tạo nội dung email

        if (mysqli_query($conn, $query)) {
            // Gửi email
            $body = '
            <h2>Mật khẩu mới là: ' . $password . '</h2></br>
            <p>' . nl2br(htmlspecialchars($message)) . '</p>';

            if (sendEmail($recipientEmail, $subject, $body)) {
                redirect(
                    'login.php',
                    'success',
                    'Thay đổi mật khẩu thành công.'
                );
            } else {
                redirect(
                    'login.php',
                    'error',
                    'Thay đổi mật khẩu thất bại.'
                );
            }
        } else {
            redirect('login.php', 'error', 'Thay đổi mật khẩu thất bại');
        }
    } else {
        redirect('login.php', 'error', 'Thay đổi mật khẩu thất bại ngu ');
    }
}

$conn->close();