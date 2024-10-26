<?php
require 'dbcon.php';

// Check if the session is already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

    function validate($inpData)
    {
        global $conn;
        $validatedData = mysqli_real_escape_string($conn, $inpData);
        return trim($validatedData);
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
function deleteImage($filePath)
{
    $result = ['success' => false, 'message' => ''];
    if (file_exists($filePath)) {
        // Thực hiện xóa tệp
        if (unlink($filePath)) {
            $result['success'] = true;
            $result['message'] = 'Tệp đã được xóa thành công.';
        } else {
            $result['message'] = 'Có lỗi xảy ra khi xóa tệp.';
        }
    } else {
        $result['message'] = 'Tệp không tồn tại.';
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
function validateAndHashPassword($password, $re_password)
{
    if ($password !== $re_password) {
        return ['status' => false, 'message' => 'Mật khẩu không trùng khớp'];
    }
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    return ['status' => true, 'hashed' => $hashedPassword];
}

function isUsername($username, $currentId = null)
{
    global $conn; // Kết nối CSDL
    $query = "SELECT COUNT(*) as count FROM NguoiDung WHERE username = '$username'";
    if ($currentId) {
        $query .= " AND MaND != '$currentId'"; // Bỏ qua người dùng hiện tại nếu ID được cung cấp
    }
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    return $data['count'] > 0; // Trả về true nếu username đã tồn tại
}

function isEmail($email, $currentId = null)
{
    global $conn; // Kết nối CSDL
    $query = "SELECT COUNT(*) as count FROM NguoiDung WHERE Email = '$email'";
    if ($currentId) {
        $query .= " AND MaND != '$currentId'"; // Bỏ qua người dùng hiện tại nếu ID được cung cấp
    }
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    return $data['count'] > 0; // Trả về true nếu email đã tồn tại
}

function getAll($tableName)
{
    global $conn;
    $table = validate($tableName);
    $query = "SELECT * FROM $table";
    $result = mysqli_query($conn, $query);
    return $result;
}

function check_valid_ID($id)
{
    if (isset($_GET[$id])) {
        if ($_GET[$id] != NULL) {
            return $_GET[$id];
        } else {
            return 'Không tìm thấy ' . $id;
        }
    } else {
        return 'Không tìm thấy ' . $id;
    }
}
function getByID($tableName, $colName, $id)
{
    global $conn;
    $table = validate($tableName);
    $id = validate($id);
    $query = "SELECT * FROM $table WHERE $colName = '$id' LIMIT 1";
    $result = mysqli_query($conn, $query);
    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $response = [
                'status' => 200,
                'message' => 'Fetched data',
                'data' => $row
            ];
        } else {
            $response = [
                'status' => 404,
                'message' => 'Something Went Wrong'
            ];
            return $response;
        }
    } else {
        $response = [
            'status' => 500,
            'message' => 'Something Went Wrong'
        ];
        return $response;
    }
    return $response;
}


function deleteQuery($tableName, $colName, $id)
{
    global $conn;
    $table = validate($tableName);
    $col = validate($colName);
    $id = validate($id);
    $query = "DELETE FROM $table WHERE $colName ='$id' LIMIT 1";
    $result = mysqli_query($conn, $query);
    return $result;
}

//Phan trang
function paginate($conn, $table, $rowPerPage, $current_page)
{
    // Tính tổng số bản ghi
    $total_query = "SELECT COUNT(*) AS total FROM $table";
    $total_result = $conn->query($total_query);
    $total_row = $total_result->fetch_assoc();
    $total_records = $total_row['total'];

    // Tính số trang
    $total_pages = ceil($total_records / $rowPerPage);

    // Đảm bảo số trang không nhỏ hơn 1
    if ($current_page < 1) {
        $current_page = 1;
    }

    // Tính vị trí bắt đầu cho truy vấn
    $offset = ($current_page - 1) * $rowPerPage;

    // Truy vấn để lấy dữ liệu cho trang hiện tại
    $query = "SELECT * FROM $table LIMIT $offset, $rowPerPage";
    $result = $conn->query($query);

    return [
        'data' => $result,
        'total_pages' => $total_pages,
        'current_page' => $current_page,
        'total_records' => $total_records
    ];
}
// Hàm sort
function sortData(&$data, $sortField, $sortOrder = 'ASC')
{
    usort($data, function ($a, $b) use ($sortField, $sortOrder) {
        if ($sortOrder === 'ASC') {
            return strcmp($a[$sortField], $b[$sortField]);
        } else {
            return strcmp($b[$sortField], $a[$sortField]);
        }
    });
}

//==============================================================================//
