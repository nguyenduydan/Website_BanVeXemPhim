<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require_once 'function.php';

// Tạo một instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
function sendEmail($to, $subject, $body = '')
{
    $mail = new PHPMailer(true);

    try {
        // Cấu hình máy chủ
        $mail->CharSet = 'UTF-8';
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Địa chỉ máy chủ SMTP
        $mail->SMTPAuth = true;
        $mail->Username   = 'dn135897@gmail.com';  // Tên người dùng SMTP (admin)
        $mail->Password   = 'hzpw gavd dqzw rzfw'; // Mật khẩu ứng dụng
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;        // Kích hoạt mã hóa TLS
        $mail->Port       = 587;                                    // Cổng TCP để kết nối

        if (empty($to)) {
        }
        // Người gửi và người nhận
        $mail->setFrom('dn135897@gmail.com', 'NguyenThietDuyDan'); // Đặt địa chỉ email của admin làm người gửi
        $mail->addAddress($to); // Địa chỉ email của người nhận

        // Nội dung email
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;

        // Gửi email
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

function generateRandomPassword($length = 6)
{
    // Các ký tự cho mật khẩu
    $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numbers = '0123456789';
    $specialChars = '!@#$%^&*()_+-=[]{}|;:,.<>?';

    // Đảm bảo mật khẩu có ít nhất một ký tự viết hoa, một số và một ký tự đặc biệt
    $password = '';
    $password .= $uppercase[random_int(0, strlen($uppercase) - 1)];
    $password .= $numbers[random_int(0, strlen($numbers) - 1)];
    $password .= $specialChars[random_int(0, strlen($specialChars) - 1)];

    // Tạo phần còn lại của mật khẩu
    $allChars = $uppercase . $numbers . $specialChars;
    for ($i = 3; $i < $length; $i++) {
        $password .= $allChars[random_int(0, strlen($allChars) - 1)];
    }

    // Trộn mật khẩu để không có thứ tự cố định
    return str_shuffle($password);
}

// Kiểm tra nếu có dữ liệu POST từ biểu mẫu
if (isset($_POST['lienhe'])) {
    $email = $_POST['email'];
    $fullname = $_POST['fullname']; // Tên người gửi
    $subject = $_POST['subject']; // Tiêu đề
    $sdt = $_POST['phone']; // Tiêu đề
    $message = $_POST['message']; // Nội dung

    // Tạo nội dung email
    $body = '
    <h2>Tin nhắn liên hệ từ ' . htmlspecialchars($fullname) . ' - ' . htmlspecialchars($sdt) . ':</h2></br>
    <p>' . nl2br(htmlspecialchars($message)) . '</p>';

    // Gửi email
    $email = 'dn135897@gmail.com';
    if (sendEmail($recipientEmail, $subject, $body)) {
        redirect('contact.php', 'success', 'Gửi email thành công.');
    } else {
        redirect('contact.php', 'error', 'Gửi email không thành công.');
    }
}



// try {
//     // Thiết lập charset UTF-8
//     $mail->CharSet = 'UTF-8';
//     $mail->isSMTP();                                            // Gửi bằng SMTP
//     $mail->Host       = 'smtp.gmail.com';                     // Đặt máy chủ SMTP
//     $mail->SMTPAuth   = true;                                   // Kích hoạt xác thực SMTP
//     $mail->Username   = 'dn135897@gmail.com';                   // Tên người dùng SMTP (admin)
//     $mail->Password   = 'hzpw gavd dqzw rzfw';                   // Mật khẩu ứng dụng
//     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;        // Kích hoạt mã hóa TLS
//     $mail->Port       = 587;                                    // Cổng TCP để kết nối

//     // Người gửi (email của admin)
//     $mail->setFrom('dn135897@gmail.com', 'NguyenThietDuyDan'); // Đặt địa chỉ email của admin làm người gửi

//     // Thêm địa chỉ email của khách hàng vào Reply-To
//     $customerEmail = $_POST['email']; // Địa chỉ email của khách hàng
//     $mail->addReplyTo($customerEmail, $_POST['fullname']); // Địa chỉ email của khách hàng làm địa chỉ phản hồi

//     // Người nhận (email của admin)
//     $mail->addAddress('dn135897@gmail.com', 'NguyenThietDuyDan'); // Địa chỉ email của admin

//     // Nội dung email
//     $mail->isHTML(true);                                        // Đặt định dạng email là HTML
//     $mail->Subject = $_POST['subject'];                        // Tiêu đề email
//     $mail->Body    = '
//     <h2>Nội dung tin nhắn:</h2>
//     <span>' . htmlspecialchars($_POST['message']) . '</span><br style="width:50px; height:5px; border-bottom: 1px solid black">
//     <h2>SĐT: ' . htmlspecialchars($_POST['phone']) . '</h2>'; // Nội dung email
//     $mail->AltBody = 'This is the body in plain text for non-HTML mail clients'; // Nội dung plain-text

//     $mail->send();
//     redirect('contact.php', 'success', 'Gửi Email thành công');
// } catch (Exception $e) {
//     $error = $mail->ErrorInfo;
//     redirect('contact.php', 'error', 'Tin nhắn không thể gửi đi. Lỗi: ' . $error);
// }