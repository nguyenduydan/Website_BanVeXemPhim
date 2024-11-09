<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'function.php';

// Tạo một instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    // Thiết lập charset UTF-8
    $mail->CharSet = 'UTF-8';
    $mail->isSMTP();                                            // Gửi bằng SMTP
    $mail->Host       = 'smtp.gmail.com';                     // Đặt máy chủ SMTP
    $mail->SMTPAuth   = true;                                   // Kích hoạt xác thực SMTP
    $mail->Username   = 'dn135897@gmail.com';                   // Tên người dùng SMTP (admin)
    $mail->Password   = 'hzpw gavd dqzw rzfw';                   // Mật khẩu ứng dụng
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;        // Kích hoạt mã hóa TLS
    $mail->Port       = 587;                                    // Cổng TCP để kết nối

    // Người gửi (email của admin)
    $mail->setFrom('dn135897@gmail.com', 'NguyenThietDuyDan'); // Đặt địa chỉ email của admin làm người gửi

    // Thêm địa chỉ email của khách hàng vào Reply-To
    $customerEmail = $_POST['email']; // Địa chỉ email của khách hàng
    $mail->addReplyTo($customerEmail, $_POST['fullname']); // Địa chỉ email của khách hàng làm địa chỉ phản hồi

    // Người nhận (email của admin)
    $mail->addAddress('dn135897@gmail.com', 'NguyenThietDuyDan'); // Địa chỉ email của admin

    // Nội dung email
    $mail->isHTML(true);                                        // Đặt định dạng email là HTML
    $mail->Subject = $_POST['subject'];                        // Tiêu đề email
    $mail->Body    = '
    <h2>Nội dung tin nhắn:</h2>
    <span>' . htmlspecialchars($_POST['message']) . '</span><br style="width:50px; border-bottom: 1px solid black">
    <h2>SĐT: ' . htmlspecialchars($_POST['phone']) . '</h2>'; // Nội dung email
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients'; // Nội dung plain-text

    $mail->send();
    redirect('contact.php', 'success', 'Gửi Email thành công');
} catch (Exception $e) {
    $error = $mail->ErrorInfo;
    redirect('contact.php', 'error', 'Tin nhắn không thể gửi đi. Lỗi: ' . $error);
}
