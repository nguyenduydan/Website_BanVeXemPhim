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
function redirect($url, $status,$message)
{
    $_SESSION[$status] = $message;
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
    $query = "SELECT COUNT(*) as count FROM nguoidung WHERE username = '$username'";
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

function setupPagination($conn, $table, $record = 5)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['records_per_page'])) {
        $_SESSION['records_per_page'] = (int)$_POST['records_per_page'];
        header("Location: " . $_SERVER['PHP_SELF'] . "?page=1"); // Redirect to page 1
        exit;
    }
    $records_per_page = isset($_SESSION['records_per_page']) ? $_SESSION['records_per_page'] : $record;

    $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $data = paginate($conn, $table, $records_per_page, $current_page);
    $data['records_per_page'] = $records_per_page;
    return $data;
}

// Hàm phân trang
function paginate($conn, $table, $recordsPerPage, $currentPage)
{
    $totalQuery = "SELECT COUNT(*) AS total FROM $table";
    $totalResult = $conn->query($totalQuery);
    $totalRow = $totalResult->fetch_assoc();
    $totalRecords = $totalRow['total'];

    $totalPages = ceil($totalRecords / $recordsPerPage);
    $currentPage = max(1, min($currentPage, $totalPages));

    $offset = ($currentPage - 1) * $recordsPerPage;

   
    $query = "SELECT * FROM $table LIMIT $offset, $recordsPerPage";
    $result = $conn->query($query);


    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    return [
        'data' => $data,
        'total_pages' => $totalPages,
        'current_page' => $currentPage,
        'total_records' => $totalRecords
    ];
}
function paginate_html($totalPages, $currentPage, $url = "?page=")
{
    if ($totalPages <= 1) {
        return '';
    }

    $paginationHtml = '<nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">';

    if ($currentPage > 1) {
        $paginationHtml .= '<li class="page-item">
                                <a class="page-link bg-gradient-dark text-white" href="' . $url . ($currentPage - 1) . '">
                                    <i class="bi bi-chevron-left fs-6 fw-bolder"></i>
                                </a>
                            </li>';
    }
    for ($i = 1; $i <= $totalPages; $i++) {
        $activeClass = ($i == $currentPage) ? 'active' : '';
        $paginationHtml .= '<li class="page-item ' . $activeClass . '">
                                <a class="page-link border-radius-xs" href="' . $url . $i . '">' . $i . '</a>
                            </li>';
    }

    if ($currentPage < $totalPages) {
        $paginationHtml .= '<li class="page-item">
                                <a class="page-link bg-gradient-dark text-white" href="' . $url . ($currentPage + 1) . '">
                                    <i class="bi bi-chevron-right fs-6 fw-bolder"></i>
                                </a>
                            </li>';
    }

    $paginationHtml .= '</ul></nav>';

    return $paginationHtml;
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

