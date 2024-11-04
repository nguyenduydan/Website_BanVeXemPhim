<?php include('includes/header.php'); ?>

<div class="main-banner" id="top"></div>
<div class="container my-4">
    <div class="row">
        <div class="col-md-4">
            <div class="profile-card">
                <div class="user-info">
                    <h4>@item.TenND</h4>
                </div>
                <div class="spending-info">
                    @if (ViewBag.Tongtien < 2000000) { <span style="color:blue">Thành viên</span>
                        }
                        else if (ViewBag.Tongtien < 5000000) { <span style="color:orange">VIP</span>
                            }
                            else
                            {
                            <span style="color:purple">Platinum</span>
                            }
                            <h5 class="mt-1">Tổng chi tiêu 2024</h5>

                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="profile-form">
                <form>
                    <div class="form-group">
                        <label for="fullName">Họ và tên</label>
                        <div class="input-container">
                            <i class="fas fa-user icon"></i>
                            <input type="text" class="form-control" id="fullName" value="" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="dob">Ngày sinh</label>
                        <div class="input-container">
                            <i class="fas fa-calendar-alt icon"></i>
                            <input type="text" class="form-control" id="dob" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <div class="input-container">
                            <i class="fas fa-envelope icon"></i>
                            <input type="email" class="form-control" id="email" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone">Số điện thoại</label>
                        <div class="input-container">
                            <i class="fas fa-phone icon"></i>
                            <input type="text" class="form-control" id="phone" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Giới tính</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="male" value="true" disabled>
                            <label class="form-check-label" for="male">Nam</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="female" value="false"
                                disabled>
                            <label class="form-check-label" for="female">Nữ</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Mật khẩu</label>
                        <div class="input-container">
                            <i class="fas fa-lock icon"></i>
                            <input type="password" class="form-control" id="password" value="" readonly>
                            <div class="icon-container">
                                <i class="fas fa-eye-slash toggle-password"
                                    onclick="togglePasswordVisibility('password')"></i>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        let currentSpending = parseInt(); // Lấy giá trị từ ViewBag và chuyển đổi thành số nguyên
        const maxSpending = 4000000;
        const progressBar = document.getElementById('progressBar');
        const tongTienText = document.getElementById('tongTienText');

        // Cập nhật thanh tiến trình và số tiền hiển thị
        function updateProgress(spendingAmount) {
            const progressPercentage = (spendingAmount / maxSpending) * 100;
            progressBar.style.width = `${progressPercentage}%`;
            progressBar.setAttribute('aria-valuenow', spendingAmount);
            progressBar.innerText =
                `${spendingAmount.toLocaleString()} ₫`; // Sử dụng hàm toLocaleString để format số tiền có dấu phân cách
            tongTienText.innerText = `${spendingAmount.toLocaleString()} ₫`;
        }

        // Gọi hàm updateProgress khi trang được tải
        updateProgress(currentSpending);

        // Xử lý sự kiện khi nhấn nút "Cập nhật chi tiêu"
        document.getElementById('updateSpending').addEventListener('click', () => {
            let additionalSpending = parseInt(document.getElementById('spendingInput').value);
            if (!isNaN(additionalSpending) && additionalSpending >= 0) {
                currentSpending += additionalSpending;
                if (currentSpending > maxSpending) {
                    currentSpending = maxSpending;
                }
                updateProgress(currentSpending);
            } else {
                alert(`Vui lòng nhập một số tiền hợp lệ`);
            }
        });
    });

    function togglePasswordVisibility(inputId) {
        var passwordInput = document.getElementById(inputId);
        var toggleIcon = document.querySelector(`#${inputId} ~ .toggle-password`);
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleIcon.classList.remove("fa-eye-slash");
            toggleIcon.classList.add("fa-eye");
        } else {
            passwordInput.type = "password";
            toggleIcon.classList.remove("fa-eye");
            toggleIcon.classList.add("fa-eye-slash");
        }
    }
</script>

<?php include('includes/footer.php'); ?>