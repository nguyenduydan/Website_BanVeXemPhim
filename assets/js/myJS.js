
function previewImageAdd(event) {
    var reader = new FileReader();
    reader.onload = function () {
        var output = document.getElementById('preview');
        output.src = reader.result;
        output.style.display = 'block';
    };
    reader.readAsDataURL(event.target.files[0]);
}

function previewImage(event) {
    var preview = document.getElementById('preview');
    var file = event.target.files[0];
    var reader = new FileReader();

    reader.onload = function () {
        preview.src = reader.result;
        preview.style.display = 'block';
    };

    if (file) {
        reader.readAsDataURL(file);
    } else {
        preview.src = '#';
        preview.style.display = 'none';
    }
}

document.addEventListener('DOMContentLoaded', function () {
    let deleteId = null; // Biến để lưu ID người dùng

    // Lắng nghe sự kiện cho tất cả các nút xóa
    document.querySelectorAll('.delete-btn').forEach(function (button) {
        button.addEventListener('click', function () {
            deleteId = this.getAttribute('data-id'); // Lưu ID người dùng vào biến
        });
    });

    // Kiểm tra xem nút "Có" trong modal có tồn tại không
    const confirmYesButton = document.getElementById('confirmYes');
    if (confirmYesButton) {
        confirmYesButton.onclick = function () {
            if (deleteId) {
                // Chuyển hướng đến trang xóa người dùng
                window.location.href = `views/user/user-delete.php?id=${deleteId}`;
            }
        };
    }
});

function togglePasswordVisibility() {
    const passwordInput = document.getElementById('password');
    const icon = document.getElementById('togglePassword');

    // Chuyển đổi giữa mật khẩu và văn bản
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    } else {
        passwordInput.type = 'password';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    }
}

// Đăng ký sự kiện nhấp vào biểu tượng
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('togglePassword').addEventListener('click', togglePasswordVisibility);
});
