<?php
$title = 'Liên hệ';
include('includes/header.php');
$messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : []; // Lấy lỗi từ session
$formData = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];
unset($_SESSION['messages']); // Xóa lỗi khỏi session sau khi hiển thị
unset($_SESSION['form_data']);

$isLoggedIn = isset($_SESSION['NDloggedIn']) && $_SESSION['NDloggedIn'] == TRUE;

?>

<div id="toast"></div>

<?php alertMessage() ?>

<section class="py-3 py-md-5" style="
background:linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.1)),url(https://wallpaperaccess.com/full/8406708.gif);
 background-repeat: no-repeat;
    background-size:cover;
    background-position: center;

">
    <div class="container">
        <div class="row gy-3 gy-md-4 gy-lg-0 align-items-xl-center">
            <div class="col-12 col-lg-6 d-none d-sm-none d-md-none d-lg-block">
                <img class="img-fluid rounded" loading="lazy"
                    src="https://photo2.tinhte.vn/data/avatars/l/3037/3037189.jpg?1723275753" alt="Get in Touch">
            </div>
            <div class="col-12 col-lg-6">
                <div class="row justify-content-xl-center">
                    <div class="col-12 col-xl-11">
                        <div class="bg-white rounded-3 shadow overflow-hidden">
                            <form action="config/sendmail.php" method="POST">
                                <div class="row gy-2 gy-xl-3 p-4 p-xl-5">
                                    <div class="col-12">
                                        <label for="fullname" class="form-label fw-bold">Họ và tên <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="fullname" name="fullname">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="email" class="form-label fw-bold">Email <span
                                                class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email" name="email">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="phone" class="form-label fw-bold">Số điện thoại</label>
                                        <input type="tel" class="form-control" id="phone" name="phone">
                                    </div>
                                    <div class="col-12">
                                        <label for="subject" class="form-label fw-bold">Tiêu đề <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="subject" name="subject">
                                    </div>
                                    <div class="col-12">
                                        <label for="message" class="form-label fw-bold">Tin nhắn <span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control" id="message" name="message" rows="3"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <?php
                                            if (!$isLoggedIn) {
                                                echo '
                                                <button class="btn btn-secondary btn-lg" id="login" type="button" disabled>Vui lòng đăng nhập để gửi tin nhắn</button>';
                                            } else {
                                                echo '<button class="btn btn-primary btn-lg" id="login" name="lienhe" type="submit">Gửi tin nhắn</button>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('includes/footer.php'); ?>