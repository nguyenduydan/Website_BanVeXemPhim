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
                window.location.href = `../admin/user-delete.php?id=${deleteId}`;
            }
        };
    }
});
