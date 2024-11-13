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

            $silverValue = 1;
            $goldValue = 1;
            $platinumValue = 1;

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
            if ($client_revenue < $silverValue) {
                //rank none
                $level = "Silver";
                $color = "#d6d6e7";
                $backround = "bg-member-none";
                $diff = $silverValue - $client_revenue;
            } elseif ($client_revenue < $goldValue) {
                //rank silver
                $level = "Gold";
                $color = "#6c757d";
                $backround = "bg-member-silver";
                $diff = $goldValue - $client_revenue;
            } elseif ($client_revenue < $platinumValue) {
                //rank gold
                $level = "Platinum";
                $color = "#ffc107";
                $backround = "bg-member-gold";
                $diff = $platinumValue - $client_revenue;
            } else {
                //rank platinum
                $level = "Đã max";
                $color = "#1948ff";
                $backround = "bg-member-platinum";
                $diff = 0; // Đã đạt tối đa
            }

            // Tính tỷ lệ phần trăm cho từng rank
            $silverPercentage = ($silverValue / $mucTieu) * 100;
            $goldPercentage = ($goldValue / $mucTieu) * 100;
            $platinumPercentage = ($platinumValue / $mucTieu) * 100;

            ?>
            <style>
                .bg-member-gold {
                    color: aliceblue;
                    /* Một màu vàng nhạt hơn */
                    background-image: url(https://i.pinimg.com/736x/9d/5c/13/9d5c13e3d92af6e99120a7b2394263cf.jpg);
                    background-repeat: no-repeat;
                    background-size: cover;
                    background-position: center;
                    border: 3px solid gold;
                    box-shadow: 0 0 10px 3px gold;

                }

                .bg-member-silver {
                    color: aliceblue;
                    /* Một màu vàng nhạt hơn */
                    background-image: url(https://i.pinimg.com/736x/2d/a9/e8/2da9e8590c45ef52fd0ce61a822a8197.jpg);
                    background-repeat: no-repeat;
                    background-size: cover;
                    box-shadow: 0 0 10px 3px silver;
                    background-position: center;
                    border: 3px solid silver;
                }


                .bg-member-platinum {
                    color: aliceblue;
                    /* Một màu vàng nhạt hơn */
                    background-image: url(https://media4.giphy.com/media/xTiTnxpQ3ghPiB2Hp6/giphy.gif?cid=6c09b95219sdvq77x4l0mzc1omfnw4yceualg0y556obpxif&ep=v1_internal_gif_by_id&rid=giphy.gif&ct=g);
                    background-repeat: no-repeat;
                    background-size: cover;
                    background-position: center;
                    border: 3px solid dodgerblue;
                    box-shadow: 0 0 10px 3px dodgerblue;
                }

                .bg-member-none {
                    color: aliceblue;
                    /* Một màu vàng nhạt hơn */
                    background-image: url(https://i.pinimg.com/736x/17/a9/a8/17a9a801d17a79fbafc52e4e19aa8750.jpg);
                    background-repeat: no-repeat;
                    background-size: cover;
                    background-position: center;
                    border: 3px solid black;
                    box-shadow: 0 0 10px 3px lightslategray;
                }

                ;
            </style>

            <div class="col-md-4 col-lg-5 mb-4">
                <div class="card profile-card <?= $backround ?>">
                    <div class="card-body text-center p-4">
                        <div class="profile-picture-container position-relative d-inline-block">
                            <input type="file" class="form-control d-none" id="avatar" name="avatar" accept="image/*"
                                onchange="submitAvatarForm();">
                            <img id="preview" style="box-shadow: 0 0 10px 5px <?= $color; ?>;"
                                src="<?= $baseUrl . 'uploads/avatars/' . (!empty($user['data']['Anh']) ? $user['data']['Anh'] : 'user-icon.png') ?>"
                                class="rounded-circle border border-2 border-light mb-3" alt="Profile Picture"
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

                        <h5 class="fw-bold mt-3 mb-2">
                            <i class="<?= $icon ?> me-2"></i>
                            <?= $user['data']['TenND'] ?>
                        </h5>
                        <small class="mt-3">Tổng chi tiêu <span
                                class="text-info fw-bolder fs-5 text-decoration-underline"><?= $current_year = date('Y'); ?></span></small>
                        <p class="fw-bold fs-4"><?= number_format($client_revenue, 0, ',', '.') ?> ₫</p>

                        <div class="progress my-3" style="position: relative;box-shadow: 0 0 7px 2px <?= $color; ?>;">
                            <div class="progress-bar" role="progressbar" style="width: <?= min($percentage, 100); ?>%;"
                                aria-valuenow="<?= $percentage; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            <div class="progress-marks"
                                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
                                <div class="progress-mark"
                                    style="position: absolute; top: 0; left: <?= $silverPercentage; ?>%; width: 2px; height: 100%; background-color: #000;">
                                </div>
                                <div class="progress-mark"
                                    style="position: absolute; top: 0; left: <?= $goldPercentage; ?>%; width: 3px; height: 100%; background-color: #000;">
                                </div>
                                <div class="progress-mark"
                                    style="position: absolute; top: 0; left: <?= $platinumPercentage; ?>%; width: 2px; height: 100%; background-color: #000;">
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between fw-bold">
                            <small class="text-secondary">0</small>
                            <small class="text-secondary"><?= $silverName ?></small>
                            <small class="text-warning"><?= $goldName ?></small>
                            <small class="text-primary"><?= $platinumName ?></small>
                        </div>
                        <div class="container mt-3">
                            <small class="text-sm text-white">Số tiền còn thiếu để đạt <br> <span
                                    class="fw-bold"><?= $level ?></span></small>
                            <p class="fw-bold fs-6 mb-0">
                                +<?= number_format(max(0, $diff), 0, ',', '.') ?> ₫</p>
                            <!-- Đảm bảo không có giá trị âm -->
                        </div>
                    </div>
                </div>
            </div>


            <!-- Profile Details Form -->
            <div class="col-md-8 col-lg-7 profile-form">
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

                                    <div class="mb-4 text-center">
                                        <label class="form-label fw-semibold">Giới tính</label>
                                        <div class="d-flex justify-content-center">
                                            <div class="form-check me-5">
                                                <input class="form-check-input" type="radio" name="gioi_tinh" id="male"
                                                    value="1"
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
