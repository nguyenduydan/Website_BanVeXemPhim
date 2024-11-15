<?php
require_once('../../config/function.php');

// Xử lý phản hồi của Google
if (isset($_GET['code'])) {
    $code = $_GET['code'];

    $client_id = '918231739151-2cmcgr7vv80e5bq71uhce9kqfqoopfbt.apps.googleusercontent.com';
    $client_secret = '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';
    $redirect_uri = 'http://localhost/Website_BanVeXemPhim/views/controllers/google-callback.php';

    $token_url = 'https://oauth2.googleapis.com/token';
    $post_data = [
        'code' => $code,
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'redirect_uri' => $redirect_uri,
        'grant_type' => 'authorization_code',
    ];

    // Gửi yêu cầu POST để lấy mã truy cập
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $token_url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $token_data = json_decode($response, true);

    // Kiểm tra xem có lỗi từ Google không
    if (isset($token_data['error'])) {
        redirect('login.php', 'error', 'Đăng nhập thất bại: ' . htmlspecialchars($token_data['error']));
    }

    // Lấy access token
    if (isset($token_data['access_token'])) {
        $access_token = $token_data['access_token'];

        // Lấy thông tin người dùng từ Google
        $user_info_url = 'https://www.googleapis.com/oauth2/v1/userinfo?access_token=' . $access_token;
        $user_info = file_get_contents($user_info_url);
        if ($user_info === false) {
            redirect('login.php', 'error', 'Đăng nhập thất bại: Không thể lấy thông tin người dùng.');
        }

        $user_data = json_decode($user_info, true);

        // Kiểm tra xem thông tin người dùng có hợp lệ không
        if (isset($user_data['email']) && isset($user_data['id'])) {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            // Kiểm tra người dùng trong cơ sở dữ liệu
            $user = getByID('taikhoan', 'TenDangNhap', $user_data['email']);

            if ($user['status'] == 200) {
                $_SESSION['NDId'] = $user['data']['MaND'];
                $_SESSION['NDloggedIn'] = true;
                $_SESSION['lastActivity'] = time();
                $_SESSION['role'] = 'user';
                redirect('index.php', 'success', 'Đăng nhập thành công');
            } else {
                $tendn = $user_data['email'];
                $name = $user_data['name'];

                // Thêm tài khoản mới vào bảng TaiKhoan
                $query = "INSERT INTO taikhoan (TenDangNhap, MatKhau, TenND, Quyen)
              VALUES ('$tendn', '', '$name', '0')";

                if (mysqli_query($conn, $query)) {
                    // Lấy MaND từ bảng TaiKhoan
                    $maND = mysqli_insert_id($conn);

                    // Thêm vào bảng NguoiDung
                    $insert_query = "INSERT INTO NguoiDung (MaND, TenND, Email, NguoiTao, NgayTao, NguoiCapNhat, NgayCapNhat, TrangThai)
                         VALUES ('$maND', '$name','$tendn','0', CURRENT_TIMESTAMP, '0', CURRENT_TIMESTAMP, '1')";

                    if (mysqli_query($conn, $insert_query)) {
                        $_SESSION['NDId'] = $maND; // Lưu MaND vừa được tạo
                        $_SESSION['NDloggedIn'] = true;
                        $_SESSION['lastActivity'] = time();
                        $_SESSION['role'] = 'user';
                        redirect('index.php', 'success', 'Đăng nhập thành công');
                    } else {
                        redirect('login.php', 'error', 'Đăng nhập thất bại: Không thể thêm vào NguoiDung.');
                    }
                } else {
                    redirect('login.php', 'error', 'Đăng nhập thất bại: Không thể thêm vào TaiKhoan.');
                }
            }
        } else {
            redirect('login.php', 'error', 'Đăng nhập thất bại: Không lấy được thông tin người dùng.');
        }
    } else {
        redirect('login.php', 'error', 'Đăng nhập thất bại: Không có access token.');
    }
} else {
    redirect('login.php', 'error', 'Đăng nhập thất bại: Không có mã phản hồi.');
}