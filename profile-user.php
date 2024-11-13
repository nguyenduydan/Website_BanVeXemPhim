<?php
$title = 'Trang người dùng';
include('includes/header.php');
require_once 'config/function.php';
$messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : []; // Lấy lỗi từ session
$formData = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];
unset($_SESSION['messages']); // Xóa lỗi khỏi session sau khi hiển thị
unset($_SESSION['form_data']);
getUser();
?>
<div id="toast"></div>
<?php alertMessage() ?>

<form id="avatarForm" action="/Website_BanVeXemPhim/views/controllers/user-controller.php" method="post"
    enctype="multipart/form-data">
    <input type="hidden" name="mand" value="<?= $user['data']['MaND'] ?>">
    <input type="hidden" name="tend" value="<?= $user['data']['TenND'] ?>">

    <div class="container my-5">
        <div class="row">
            <?php
            $client_revenue = client_revenue($NDId);

            $silverValue = 0;
            $goldValue = 0;
            $platinumValue = 0;

            $list_param = getAll('thamso');
            if (!empty($list_param)) {
                foreach ($list_param as $param) {
                    if ($param['TenThamSo'] == 'Silver') {
                        $silverValue = $param['GiaTri'];
                        $silverName = $param['TenThamSo'];
                    }
                    if ($param['TenThamSo'] == 'Gold') {
                        $goldValue = $param['GiaTri'];
                        $goldName = $param['TenThamSo'];
                    }
                    if ($param['TenThamSo'] == 'Platinum') {
                        $platinumValue = $param['GiaTri'];
                        $platinumName = $param['TenThamSo'];
                    }
                }
            }

            $mucTieu = $platinumValue;
            $percentage = ($client_revenue / $mucTieu) * 100;

            // Determine membership level and corresponding styles
            if ($client_revenue < 100000) {
                $level = "Bronze";
                $colorClass = "text-muted";
                $icon = "bi-award";
            } elseif ($client_revenue >= $platinumValue) {
                $level = "Platinum";
                $colorClass = "text-primary";
                $icon = "bi-gem";
            } elseif ($client_revenue >= $goldValue) {
                $level = "Gold";
                $colorClass = "text-warning";
                $icon = "bi-star-fill";
            } elseif ($client_revenue >= $silverValue) {
                $level = "Silver";
                $colorClass = "text-secondary";
                $icon = "bi-trophy";
            } else {
                $level = "Bronze";
                $colorClass = "text-muted";
                $icon = "bi-award";
            }
            ?>


            <div class="col-md-4 mb-4">
                <div class="card profile-card shadow border-0">
                    <div class="card-body text-center p-4">
                        <div class="profile-picture-container position-relative d-inline-block">
                            <input type="file" class="form-control d-none" id="avatar" name="avatar" accept="image/*"
                                onchange="submitAvatarForm();">
                            <img id="preview"
                                src="<?= $baseUrl . 'uploads/avatars/' . (!empty($user['data']['Anh']) ? $user['data']['Anh'] : 'user-icon.png') ?>"
                                class="rounded-circle border border-2 border-light shadow-sm mb-3" alt="Profile Picture"
                                width="120" height="120">
                            <button id="camera" type="button"
                                class="position-absolute top-50 start-50 translate-middle text-white d-none"
                                style="border: none; background: rgba(0, 0, 0, 0.6); width: 40px; height: 40px; border-radius: 50%;">
                                <i class="bi bi-camera" style="font-size: 20px;"></i>
                            </button>
                        </div>

                        <script>
                            document.getElementById('camera').addEventListener('click', function(event) {
                                event.preventDefault();
                                document.getElementById('avatar').click();
                            });

                            function submitAvatarForm() {
                                var submitButton = document.createElement('input');
                                submitButton.type = 'hidden';
                                submitButton.name = 'updateAvt';
                                document.getElementById('avatarForm').appendChild(submitButton);
                                document.getElementById('avatarForm').submit();
                            }
                        </script>

                        <style>
                            .profile-picture-container:hover #camera {
                                display: flex !important;
                                align-items: center;
                                justify-content: center;
                            }
                        </style>

                        <h4 class="fw-bold mb-3 <?= $colorClass ?>">
                            <i class="<?= $icon ?> me-2"></i>
                            <?= $user['data']['TenND'] ?>
                        </h4>
                        <h5 class="text-muted mt-3">Tổng chi tiêu 2024</h5>
                        <p class="fw-bold <?= $colorClass ?>"><?= number_format($client_revenue, 0, ',', '.') ?> ₫</p>

                        <div class="progress my-3" style="height: 10px;">
                            <div class="progress-bar <?= $colorClass ?>" role="progressbar"
                                style="width: <?= min($percentage, 100); ?>%;" aria-valuenow="<?= $percentage; ?>"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <span class="text-muted">0 ₫</span> <!-- For 0 marker -->
                            <span class="text-secondary"><?= $silverName ?></span>
                            <span class="text-warning"><?= $goldName ?></span>
                            <span class="text-primary"><?= $platinumName ?></span>
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
                        <div class="card d-flex justify-content-center w-100 shadow border-0">
                            <div class="card-body p-4">
                                <div class="row justify-content-center">
                                    <div class="col-6">
                                        <!-- Tên đầy đủ -->
                                        <div class="mb-4">
                                            <label for="fullName" class="form-label fw-semibold">Họ và tên</label>
                                            <?php if (isset($messages['tennd'])): ?>
                                                <small
                                                    class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['tennd']) ?></small>
                                            <?php endif; ?>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light border-0"><i
                                                        class="fas fa-user"></i></span>
                                                <input type="text" class="form-control form-control-lg" id="fullName"
                                                    name="tennd" value="<?= $user['data']['TenND'] ?>">
                                            </div>
                                        </div>

                                        <!-- Email -->
                                        <div class="mb-4">
                                            <label for="email" class="form-label fw-semibold">Email</label>
                                            <?php if (isset($messages['email'])): ?>
                                                <small
                                                    class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['email']) ?></small>
                                            <?php endif; ?>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light border-0"><i
                                                        class="fas fa-envelope"></i></span>
                                                <input type="email" class="form-control form-control-lg" name="email"
                                                    id="email" value="<?= $user['data']['Email'] ?>">
                                            </div>
                                        </div>

                                        <div class="mb-4 text-center">
                                            <label class="form-label fw-semibold">Giới tính</label>
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check me-5">
                                                    <input class="form-check-input" type="radio" name="gioi_tinh"
                                                        id="male" value="1"
                                                        <?php echo ($user['data']['GioiTinh'] == '1') ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="male">Nam</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="gioi_tinh"
                                                        id="female" value="0"
                                                        <?php echo ($user['data']['GioiTinh'] == '0') ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="female">Nữ</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <!-- Ngày sinh -->
                                        <div class="mb-4">
                                            <label for="dob" class="form-label fw-semibold">Ngày sinh</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light border-0"><i
                                                        class="fas fa-calendar-alt"></i></span>
                                                <input type="date" class="form-control form-control-lg" id="dob"
                                                    name="ngay_sinh"
                                                    max="<?php echo date('Y-m-d', strtotime('-5 years')); ?>"
                                                    value="<?= isset($user['data']['NgaySinh']) ? htmlspecialchars($user['data']['NgaySinh']) : ''; ?>">
                                            </div>
                                        </div>

                                        <!-- Số điện thoại -->
                                        <div class="mb-4">
                                            <label for="phone" class="form-label fw-semibold">Số điện thoại</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light border-0"><i
                                                        class="fas fa-phone"></i></span>
                                                <?php
                                                $phoneNumber = $user['data']['SDT'];
                                                if (strlen($phoneNumber) >= 6) {
                                                    $firstThree = substr($phoneNumber, 0, 3);
                                                    $lastThree = substr($phoneNumber, -3);
                                                    $displayPhone = $firstThree . '****' . $lastThree;
                                                } else {
                                                    $displayPhone = $phoneNumber;
                                                }
                                                ?>
                                                <input type="text" class="form-control form-control-lg" id="phone"
                                                    name="sdt" value="<?= htmlspecialchars($displayPhone) ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" name="updateInf" class="btn w-25" id="update">Cập
                                        nhật</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- lịch sử giao dịch -->
                    <div id="transition-history" class="tab-pane fade">
                        <div class="card d-flex justify-content-center w-100 shadow border-0">
                            <div class="card-body p-4">
                                <?php include('views/transition-history.php'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<?php include('includes/footer.php'); ?>