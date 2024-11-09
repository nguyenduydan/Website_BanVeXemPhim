function previewImageAdd(event) {
    var reader = new FileReader();
    reader.onload = function () {
        var output = document.getElementById('preview');
        output.src = reader.result;
        output.style.display = 'block';
    };
    reader.readAsDataURL(event.target.files[0]);
}

function previewImagesAdd2(event) {
    const previewContainer = document.getElementById('preview');
    previewContainer.innerHTML = '';

    const files = event.target.files;
    Array.from(files).forEach((file) => {
        const reader = new FileReader();
        reader.onload = function (e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.classList.add('img-fluid');
            img.style.maxWidth = '100%';
            img.style.maxHeight = '15rem';
            previewContainer.appendChild(img);
        };
        reader.readAsDataURL(file);
    });
}

function previewImage(event, previewId) {
    var preview = document.getElementById(previewId);
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
    let deleteId = null; // Lưu ID người dùng
    let deleteUrl = null; // Lưu URL của trang xóa

    // Lắng nghe sự kiện cho tất cả các nút xóa
    document.querySelectorAll('.delete-btn').forEach(function (button) {
        button.addEventListener('click', function () {
            deleteId = this.getAttribute('data-id'); // Lưu ID người dùng
            deleteUrl = this.getAttribute('data-url'); // Lưu URL trang xóa
        });
    });

    // Xác nhận xóa
    const confirmYesButton = document.getElementById('confirmYes');
    if (confirmYesButton) {
        confirmYesButton.onclick = function () {
            if (deleteId && deleteUrl) {
                // Chuyển hướng đến trang xóa với ID từ data-id
                window.location.href = `${deleteUrl}?id=${deleteId}`;
            }
        };
    }
});

function togglePasswordVisibility(passwordFieldId, iconId) {
    const passwordInput = document.getElementById(passwordFieldId);
    const icon = document.getElementById(iconId);
    // Kiểm tra nếu phần tử tồn tại
    if (!passwordInput) {
        console.error('Không tìm thấy phần tử input với ID:', passwordFieldId);
        return;
    }
    if (!icon) {
        console.error('Không tìm thấy phần tử icon với ID:', iconId);
        return;
    }
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

document.addEventListener('DOMContentLoaded', function () {
    const togglePassword = document.getElementById('togglePassword');
    const toggleRePassword = document.getElementById('toggleRePassword');

    if (togglePassword) {
        togglePassword.addEventListener('click', function () {
            togglePasswordVisibility('password', 'togglePassword');
        });
    }

    if (toggleRePassword) {
        toggleRePassword.addEventListener('click', function () {
            togglePasswordVisibility('re_password', 'toggleRePassword');
        });
    }
});


