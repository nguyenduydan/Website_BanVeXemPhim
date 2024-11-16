<?php
require '../../../config/function.php';

// Kiểm tra xem người dùng đã đăng nhập chưa, nếu chưa thì chuyển hướng đến trang đăng nhập
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    redirect('sign-in.php', 'error', 'Vui lòng đăng nhập');
}
if (isset($_SESSION['EmployedIn']) && $_SESSION['EmployedIn'] === true) {
    redirect('index.php', 'error', 'Bạn không phải admin!','admin'); 
}
// Kiểm tra tính hợp lệ của ID người dùng cần xóa
$result = check_valid_ID('id');
if (is_numeric($result)) {
    $userId = validate($result); // Xác thực và lấy ID người dùng
    $user = getByID('nguoidung', 'MaND', $userId); // Truy xuất thông tin người dùng từ cơ sở dữ liệu

    if ($user['status'] == 200) {
        // Nếu truy xuất thành công thông tin người dùng
        $username = validate($user['data']['username']); // Xác thực tên đăng nhập
        $avatarPath = "../../../uploads/avatars/" . $user['data']['Anh']; // Đường dẫn tới ảnh đại diện
        $userDelete = deleteQuery('nguoidung', 'MaND', $userId); // Thực hiện xóa người dùng

        if ($userDelete) {
            // Nếu xóa người dùng thành công
            if (!empty($user['data']['Anh']) && file_exists($avatarPath)) {
                $deleteResult = deleteImage($avatarPath); // Xóa ảnh đại diện nếu tồn tại
            }
            // Chuyển hướng đến trang người dùng với thông báo thành công
            redirect('user.php', 'success', 'Xóa <span class="text-danger fw-bolder">' . htmlspecialchars($username) . '</span> thành công', 'admin');
        } else {
            // Nếu xóa thất bại, chuyển hướng với thông báo lỗi
            redirect('user.php', 'error', 'Xóa ' . htmlspecialchars($username) . ' thất bại', 'admin');
        }
    } else {
        // Nếu truy xuất thông tin người dùng thất bại, chuyển hướng với thông báo lỗi
        redirect('user.php', 'error', $user['message'], 'admin');
    }
} else {
    // Nếu ID không hợp lệ, chuyển hướng với thông báo lỗi
    redirect('user.php', 'error', $result, 'admin');
}
