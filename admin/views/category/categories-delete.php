<?php
require '../../../config/function.php'; // Bao gồm các hàm chức năng từ file function.php
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    redirect('sign-in.php', 'error', 'Vui lòng đăng nhập');
}
// Kiểm tra ID hợp lệ từ GET request, trả về kết quả nếu là số
$result = check_valid_ID('id');
if (is_numeric($result)) { // Nếu ID hợp lệ (là số)
    $categoryId = validate($result); // Xác thực và lấy ID của thể loại
    // Lấy thông tin thể loại từ cơ sở dữ liệu dựa trên ID
    $category = getByID('theloai', 'MaTheLoai', $categoryId);

    if ($category['status'] == 200) { // Kiểm tra nếu thể loại tồn tại trong cơ sở dữ liệu
        $name = validate($category['data']['TenTheLoai']); // Lấy tên thể loại và xác thực
        // Thực hiện xóa thể loại trong cơ sở dữ liệu
        $categoryDelete = deleteQuery('theloai', 'MaTheLoai', $categoryId);
        if ($categoryDelete) { // Nếu xóa thành công
            // Chuyển hướng về trang categories.php với thông báo thành công
            redirect('categories.php', 'success', 'Xóa <span class="text-danger fw-bolder">' . htmlspecialchars($name) . '</span> thành công', 'admin');
        } else { // Nếu xóa thất bại
            // Chuyển hướng về trang categories.php với thông báo thất bại
            redirect('categories.php', 'error', 'Xóa ' . htmlspecialchars($name) . ' thất bại', 'admin');
        }
    } else { // Nếu thể loại không tồn tại
        // Chuyển hướng về trang categories.php với thông báo lỗi từ API
        redirect('categories.php', 'error', $category['message'], 'admin');
    }
} else { // Nếu ID không hợp lệ (không phải số)
    // Chuyển hướng về trang categories.php với thông báo lỗi
    redirect('categories.php', 'error', $result, 'admin');
}
