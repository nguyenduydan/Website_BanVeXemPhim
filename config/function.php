<?php
require 'dbcon.php';

// Check if the session is already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function validate($inpData)
{
    global $conn;
    return mysqli_real_escape_string($conn, $inpData);
}

function redirect($url, $status)
{
    $_SESSION['status'] = $status;
    header('Location: ' . $url);
    exit(0);
}


function alertMessage()
{

    if (isset($_SESSION['error'])) {
        echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']); // Xóa thông báo sau khi đã hiển thị
    }
    if (isset($_SESSION['success'])) {
        echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
        unset($_SESSION['success']); // Xóa thông báo sau khi đã hiển thị
    }
}



function uploadAvatar($file, $targetDir)
{
    if (isset($file) && $file['error'] === UPLOAD_ERR_OK) {
        $targetFile = $targetDir . basename($file["name"]);

        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($imageFileType, $allowedTypes)) {
            if (move_uploaded_file($file["tmp_name"], $targetFile)) {
                return "Tệp đã được tải lên thành công: " . htmlspecialchars(basename($file["name"]));
            } else {
                return "Có lỗi khi tải tệp lên.";
            }
        } else {
            return "Chỉ cho phép các tệp ảnh: JPG, JPEG, PNG, GIF.";
        }
    } else {
        return "Không có tệp nào được tải lên hoặc có lỗi xảy ra.";
    }
}

function validateAndHashPassword($password, $re_password)
{
    if ($password !== $re_password) {
        return ['status' => false, 'message' => 'Mật khẩu và xác nhận mật khẩu không trùng khớp'];
    }
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    return ['status' => true, 'hashed' => $hashedPassword];
}

function isUsernameAndEmailExists($username, $email)
{
    global $conn;
    $username = validate($username);
    $email = validate($email);

    $query = "SELECT * FROM NguoiDung WHERE Email = '$email' OR username = '$username'";
    $result = mysqli_query($conn, $query);

    return mysqli_num_rows($result) > 0;
}
