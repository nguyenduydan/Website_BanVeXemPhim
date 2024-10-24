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
function uploadImage($file, $targetDir)
{
    $result = ['success' => false, 'message' => '', 'filename' => ''];

    if (isset($file) && $file['error'] == 0) {
        $fileName = basename($file["name"]);
        $fileTmpName = $file["tmp_name"];
        $fileSize = $file["size"];
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        
        // Allowed file types
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        
        // Validate file type
        if (!in_array($fileType, $allowedTypes)) {
            $result['message'] = "Chỉ các định dạng JPG, JPEG, PNG và GIF được chấp nhận.";
            return $result;
        }

        $newFileName = uniqid() . "." . $fileType;
        $filePath = $targetDir . $newFileName;
        if (move_uploaded_file($fileTmpName, $filePath)) {
            $result['success'] = true;
            $result['filename'] = $newFileName;
        } else {
            $result['message'] = "Có lỗi xảy ra khi tải tệp lên.";
        }
    } else {
        $result['message'] = "Không có tệp nào được tải lên hoặc có lỗi trong quá trình tải.";
    }
    
    return $result;
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
        // Nếu là mảng, chuyển đổi thành chuỗi
        $errorMessage = is_array($_SESSION['error']) ? implode(', ', $_SESSION['error']) : $_SESSION['error'];
        echo '<script>showErrorToast("' . addslashes($errorMessage) . '");</script>';
        unset($_SESSION['error']); // Xóa thông báo sau khi đã hiển thị
    }
    if (isset($_SESSION['success'])) {
        // Nếu là mảng, chuyển đổi thành chuỗi
        $successMessage = is_array($_SESSION['success']) ? implode(', ', $_SESSION['success']) : $_SESSION['success'];
        echo '<script>showSuccessToast("' . addslashes($successMessage) . '");</script>';
        unset($_SESSION['success']); // Xóa thông báo sau khi đã hiển thị
    }
}

// function uploadAvatar($file, $targetDir)
// {
//     if (isset($file) && $file['error'] === UPLOAD_ERR_OK) {
//         $targetFile = $targetDir . basename($file["name"]);

//         $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
//         $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

//         if (in_array($imageFileType, $allowedTypes)) {
//             if (move_uploaded_file($file["tmp_name"], $targetFile)) {
//                 return "Tệp đã được tải lên thành công: " . htmlspecialchars(basename($file["name"]));
//             } else {
//                 return "Có lỗi khi tải tệp lên.";
//             }
//         } else {
//             return "Chỉ cho phép các tệp ảnh: JPG, JPEG, PNG, GIF.";
//         }
//     } else {
//         return "Không có tệp nào được tải lên hoặc có lỗi xảy ra.";
//     }
// }

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
function getAll($tableName) {
    global $conn;
    $table = validate($tableName);
    $query = "SELECT * FROM $table";
    $result = mysqli_query($conn,$query);
    return $result;
}
class Validator
{
    private $errors = [];

    public function validateRequired($field, $value, $message)
    {
        if (empty($value)) {
            $this->errors[$field] = $message;
        }
    }

    public function validateUsernameAndEmail($username, $email)
    {
        if (isUsernameAndEmailExists($username, $email)) {
            $this->errors['username_email'] = 'Tên đăng nhập hoặc email đã tồn tại, vui lòng sử dụng tên khác';
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function displayError($field)
    {
        if (isset($this->errors[$field])) {
            return '<small style="color: red;">' . $this->errors[$field] . '</small>';
        }
        return '';
    }
}
