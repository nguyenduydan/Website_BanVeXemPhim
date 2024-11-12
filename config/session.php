<?php
// Kiểm tra phiên và hết hạn
$inactiveLimit = 600; // Giới hạn thời gian không hoạt động, ví dụ 10 giây
$_SESSION['session_expired'] = false;
require_once('function.php');
// Kiểm tra thời gian không hoạt động
if (isset($_SESSION['lastActivity']) && (time() - $_SESSION['lastActivity'] > $inactiveLimit)) {
    // Nếu đã quá thời gian không hoạt động, hủy session và đăng xuất người dùng
    session_unset();
    $_SESSION['session_expired'] = true; // Đánh dấu phiên đã hết hạn
    // Gọi hàm redirect dựa trên vai trò
    if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
        redirect(
            'sign-in.php',
            'error',
            'Quá phiên đăng nhập! Vui lòng đăng nhập lại',
            'admin'
        );
    } else {
        redirect('login.php', 'error', 'Quá phiên đăng nhập! Vui lòng đăng nhập lại');
    }
}

// Cập nhật thời gian hoạt động cuối cùng của người dùng
$_SESSION['lastActivity'] = time();
?>

<script>
// Biến cờ để kiểm tra xem modal đã hiển thị chưa
var modalShown = false;

// Gán giá trị $inactiveLimit cho biến JavaScript
var inactiveLimit = <?php echo $inactiveLimit; ?> * 1000; // Chuyển đổi sang miligiây
var timeout;
const userRole =
    "<?php echo $_SESSION['role'] ?? 'user'; ?>"; // Nhận giá trị vai trò từ PHP, mặc định là 'user' nếu không có
// Kiểm tra nếu phiên đã hết hạn
window.onload = function() {
    // Kiểm tra nếu PHP đã thiết lập session_expired
    <?php if (isset($_SESSION['session_expired']) && $_SESSION['session_expired'] === true): ?>
    // Chỉ hiển thị modal nếu nó chưa được hiển thị
    if (!modalShown) {
        createSessionExpiredModal(); // Tạo và hiển thị modal
        modalShown = true; // Đánh dấu là modal đã được hiển thị

        // Tự động chuyển hướng đến trang sign-in.php sau 5 giây
        setTimeout(function() {
            window.location.href = userRole === 'admin' ? '/Website_BanVeXemPhim/admin/sign-in.php' :
                '/Website_BanVeXemPhim/login.php';
        }, inactiveLimit);
    }
    <?php unset($_SESSION['session_expired']); ?>
    <?php endif; ?>
}

// Hàm tạo modal động trong JavaScript
function createSessionExpiredModal() {
    // Tạo div cho modal
    var modalDiv = document.createElement('div');
    modalDiv.classList.add('modal', 'fade');
    modalDiv.setAttribute('id', 'sessionExpiredModal');
    modalDiv.setAttribute('tabindex', '-1');
    modalDiv.setAttribute('aria-labelledby', 'sessionExpiredModalLabel');
    modalDiv.setAttribute('aria-hidden', 'true');
    modalDiv.setAttribute('data-bs-backdrop', 'static'); // Ngăn chặn việc đóng bằng cách nhấn ra ngoài
    modalDiv.setAttribute('data-bs-keyboard', 'false'); // Ngăn chặn việc đóng bằng phím Escape

    // Tạo modal dialog
    var modalDialog = document.createElement('div');
    modalDialog.classList.add('modal-dialog');

    // Tạo modal content
    var modalContent = document.createElement('div');
    modalContent.classList.add('modal-content');

    // Tạo modal header
    var modalHeader = document.createElement('div');
    modalHeader.classList.add('modal-header');
    var modalTitle = document.createElement('h5');
    modalTitle.classList.add('modal-title');
    modalTitle.setAttribute('id', 'sessionExpiredModalLabel');
    modalTitle.innerText = 'Phiên đăng nhập đã hết hạn';

    modalHeader.appendChild(modalTitle);

    // Tạo modal body
    var modalBody = document.createElement('div');
    modalBody.classList.add('modal-body');
    modalBody.innerText =
        'Phiên đăng nhập của bạn đã hết hạn do không hoạt động trong một thời gian dài. Vui lòng đăng nhập lại.';

    // Tạo modal footer
    var modalFooter = document.createElement('div');
    modalFooter.classList.add('modal-footer');

    // Chỉ cho phép nút Đăng nhập lại
    var loginButton = document.createElement('a');
    loginButton.classList.add('btn', 'btn-primary');
    loginButton.href = userRole === 'admin' ? '/Website_BanVeXemPhim/admin/sign-in.php' :
        '/Website_BanVeXemPhim/login.php';
    loginButton.innerText = 'Đăng nhập lại';

    modalFooter.appendChild(loginButton);

    // Xây dựng modal content
    modalContent.appendChild(modalHeader);
    modalContent.appendChild(modalBody);
    modalContent.appendChild(modalFooter);

    // Xây dựng modal dialog
    modalDialog.appendChild(modalContent);

    // Xây dựng modal
    modalDiv.appendChild(modalDialog);

    // Thêm modal vào body
    document.body.appendChild(modalDiv);

    // Hiển thị modal
    var modal = new bootstrap.Modal(modalDiv);
    modal.show();
}

// Hàm kiểm tra và reset thời gian hoạt động
function resetTimer() {
    // Hủy bỏ timeout cũ nếu có
    clearTimeout(timeout);

    // Thiết lập lại thời gian timeout
    timeout = setTimeout(function() {
        // Mở modal khi hết phiên đăng nhập
        if (!modalShown) {
            createSessionExpiredModal(); // Tạo và hiển thị modal
            modalShown = true; // Đánh dấu là modal đã được hiển thị
        }

    }, inactiveLimit); // Sử dụng giá trị inactiveLimit
}

// Gọi hàm resetTimer mỗi khi người dùng di chuyển chuột hoặc nhấn phím
document.onmousemove = resetTimer;
document.onkeypress = resetTimer;

// Khởi tạo lần đầu tiên khi trang được tải
resetTimer();
</script>
