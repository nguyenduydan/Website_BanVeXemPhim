<?php include('includes/header.php'); ?>
<div class="container my-5" id="container">
    <div class="form-container sign-up">
        <form>
            <h1>Tạo Tài Khoản</h1>
            <input type="text" placeholder="Họ và tên">
            <input type="email" placeholder="Email">
            <input type="password" placeholder="Mật khẩu">
            <input type="password" placeholder="Nhập lại Mật khẩu">
            <input type="tel" placeholder="Số điện thoại">

            <div class="d-flex align-item-center justify-content-center form-group">
                <input class="form-radio me-1" type="radio" name="gender" id="nam" value="nam">
                <label class="me-3" for="nam">Nam</label>
                <input class="form-radio me-1" type="radio" name="gender" id="nu" value="nu">
                <label for="nu">Nữ</label>
            </div>
            <input type="date" placeholder="Ngày sinh">
            <button>Đăng Ký</button>
        </form>
    </div>
    <div class="form-container sign-in">
        <form>
            <h1>Đăng Nhập</h1>
            <input type="email" placeholder="Email">
            <input type="password" placeholder="Mật khẩu">
            <a href="#">Quên mật khẩu?</a>
            <button>Đăng Nhập</button>
        </form>
    </div>
    <div class="toggle-container">
        <div class="toggle">
            <div class="toggle-panel toggle-left">
                <h1>Chào mừng trở lại!</h1>
                <p>Nhập thông tin cá nhân của bạn để sử dụng tất cả tính năng của trang web</p>
                <button class="hidden" id="login">Đăng Nhập</button>
            </div>
            <div class="toggle-panel toggle-right">
                <h1>Xin chào, Bạn mới!</h1>
                <p>Đăng ký với thông tin cá nhân của bạn để sử dụng tất cả tính năng của trang web</p>
                <button class="hidden" id="register">Đăng Ký</button>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>