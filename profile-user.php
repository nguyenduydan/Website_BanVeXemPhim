<?php include('includes/header.php');
require_once 'config/function.php';
getUser();

?>
<div class="container my-5">
    <div class="row">
        <?php
        $tongTien = 2000000;
        $mucTieu = 4000000;

        $percentage = min(($tongTien / $mucTieu) * 100, 100);
        ?>

        <div class="col-md-4 mb-4">
            <div class="card profile-card shadow border-0">
                <div class="card-body text-center p-4">
                    <img src="uploads/avatars/admin.gif" class="rounded-circle mb-3 border" alt="Profile Picture"
                        width="100px" height="100px">
                    <h4 class="fw-bold mb-3"><?=$user['data']['TenND']?></h4>

                    <h5 class="text-muted mt-3">Tổng chi tiêu 2024</h5>
                    <p class="text-warning fw-bold"><?= number_format($tongTien, 0, ',', '.') ?> ₫</p>

                    <div class="progress my-3" style="height: 10px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: <?= $percentage; ?>%;"
                            aria-valuenow="<?= $percentage; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex justify-content-between text-muted">
                        <span>0 ₫</span>
                        <span>2.000.000 ₫</span>
                        <span>4.000.000 ₫</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Details Form -->
        <div class="col-md-8 profile-form">
            <div class="border-bottom mb-2">
                <ul class="nav d-flex justify-content-center" id="filmTabs">
                    <li class="nav-item">
                        <a class="nav-link" id="transition-history-tab" href="javascript:void(0);"
                            onclick="showTab('transition-history')">Lịch sử giao dịch</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" id="personal-information-tab" href="javascript:void(0);"
                            onclick="showTab('personal-infomation')">Thông tin cá nhân</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content">
                <div id="personal-infomation" class="tab-pane fade show active">
                    <div class="card d-flex justify-content-center  w-100 shadow border-0">
                        <div class=" card-body p-4">
                            <form class="row justify-content-center" action="#" method="post">
                                <div class="col-6">
                                    <!-- Tên đầy đủ -->
                                    <div class="mb-4">
                                        <label for="fullName" class="form-label fw-semibold">Họ và tên</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-0"><i
                                                    class="fas fa-user"></i></span>
                                            <input type="text" class="form-control form-control-lg" id="fullName" value="<?=$user['data']['TenND']?>" readonly>
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div class="mb-4">
                                        <label for="email" class="form-label fw-semibold">Email</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-0"><i
                                                    class="fas fa-envelope"></i></span>
                                            <input type="email" class="form-control form-control-lg" id="email" value="<?=$user['data']['Email']?>" readonly>
                                        </div>
                                    </div>
                                    <div class="mb-4 text-center">
                                        <label class="form-label fw-semibold">Giới tính</label>
                                        <div class="d-flex justify-content-center">
                                            <div class="form-check me-5">
                                                <input class="form-check-input" type="radio" name="gender" id="male"
                                                    value="male" <?php echo ($user['data']['GioiTinh'] == '1') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="male">Nam</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender" id="female"
                                                    value="female" <?php echo ($user['data']['GioiTinh'] == '0') ? 'checked' : ''; ?>
                                                    <?php echo ($user['data']['GioiTinh'] == '1') ? 'disabled' : ''; ?>>
                                                <label class="form-check-label" for="female">Nữ</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <!-- <div class="mb-4">
                                        <label for="password" class="form-label fw-semibold">Mật khẩu</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-0"><i
                                                    class="fas fa-lock"></i></span>
                                            <input type="password" class="form-control form-control-lg" id="password"
                                                value="<?php //echo htmlspecialchars($item['password']);
                                                        ?>" readonly>
                                            <button class="btn btn-outline-secondary border-0 bg-light text-black"
                                                type="button" onclick="togglePasswordVisibility('password')">
                                                <i class="fas fa-eye-slash "></i>
                                            </button>
                                        </div>
                                    </div> -->
                                    <!-- Ngày sinh -->
                                    <div class="mb-4">
                                        <label for="dob" class="form-label fw-semibold">Ngày sinh</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-0"><i class="fas fa-calendar-alt"></i></span>
                                            <input type="text" class="form-control form-control-lg" id="dob" 
                                                value="<?= date('d/m/Y', strtotime($user['data']['NgaySinh'])) ?>" readonly>
                                        </div>
                                    </div>
                                    <!-- Số điện thoại -->
                                    <div class="mb-4">
                                        <label for="phone" class="form-label fw-semibold">Số điện thoại</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-0"><i
                                                    class="fas fa-phone"></i></span>
                                                    <?php
                                                    // Giả sử số điện thoại được lấy từ mảng $user
                                                    $phoneNumber = $user['data']['SDT'];

                                                    // Kiểm tra độ dài của số điện thoại và xử lý
                                                    if (strlen($phoneNumber) >= 6) {
                                                        // Lấy 3 số đầu và 3 số cuối
                                                        $firstThree = substr($phoneNumber, 0, 3);
                                                        $lastThree = substr($phoneNumber, -3);
                                                        $displayPhone = $firstThree . '****' . $lastThree;
                                                    } else {
                                                        // Nếu số điện thoại có độ dài nhỏ hơn 6, hiển thị nguyên bản
                                                        $displayPhone = $phoneNumber;
                                                    }
                                                    ?>

                                                    <input type="text" class="form-control form-control-lg" id="phone" value="<?= htmlspecialchars($displayPhone) ?>" readonly>

                                        </div>
                                    </div>
                                </div>
                                <button type="submit" name="updateInf" class="btn w-25" id="update">Cập
                                    nhật</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="transition-history" class="tab-pane fade">
                    <div class="card d-flex justify-content-center  w-100 shadow border-0">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>
