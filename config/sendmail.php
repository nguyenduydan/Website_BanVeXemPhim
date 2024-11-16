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
    $recipientEmail = $_POST['email'];
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