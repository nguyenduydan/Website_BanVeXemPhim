<?php include('includes/header.php'); ?>

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
                    <h4 class="fw-bold mb-3">Trần Duy Phát</h4>

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
        <div class="col-md-8">
            <div class="card profile-form shadow border-0">
                <div class="card-body p-5">
                    <form>
                        <!-- Tên đầy đủ -->
                        <div class="mb-4">
                            <label for="fullName" class="form-label fw-semibold">Họ và tên</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="fas fa-user"></i></span>
                                <input type="text" class="form-control form-control-lg" id="fullName" value="<?php //echo htmlspecialchars($item['fullName']);
                                                                                                                ?>"
                                    readonly>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="fas fa-envelope"></i></span>
                                <input type="email" class="form-control form-control-lg" id="email" value="<?php //echo htmlspecialchars($item['email']);
                                                                                                            ?>"
                                    readonly>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label fw-semibold">Mật khẩu</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="fas fa-lock"></i></span>
                                <input type="password" class="form-control form-control-lg" id="password" value="<?php //echo htmlspecialchars($item['password']);
                                                                                                                    ?>"
                                    readonly>
                                <button class="btn btn-outline-secondary border-0 bg-light text-black" type="button"
                                    onclick="togglePasswordVisibility('password')">
                                    <i class="fas fa-eye-slash "></i>
                                </button>
                            </div>
                        </div>
                        <!-- Giới tính -->
                        <div class="mb-4 text-center">
                            <label class="form-label fw-semibold">Giới tính</label>
                            <div class="d-flex justify-content-center">
                                <div class="form-check me-5">
                                    <input class="form-check-input" type="radio" name="gender" id="male" value="male"
                                        <?php //echo ($item['gender'] == 'male') ? 'checked' : '';
                                        ?> disabled>
                                    <label class="form-check-label" for="male">Nam</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="female"
                                        value="female" <?php //echo ($item['gender'] == 'female') ? 'checked' : '';
                                                        ?> disabled>
                                    <label class="form-check-label" for="female">Nữ</label>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex row">
                            <div class="col-6">
                                <!-- Ngày sinh -->
                                <div class="mb-4">
                                    <label for="dob" class="form-label fw-semibold">Ngày sinh</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0"><i
                                                class="fas fa-calendar-alt"></i></span>
                                        <input type="text" class="form-control form-control-lg" id="dob" value="<?php //echo htmlspecialchars($item['dob']);
                                                                                                                ?>"
                                            readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <!-- Số điện thoại -->
                                <div class="mb-4">
                                    <label for="phone" class="form-label fw-semibold">Số điện thoại</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0"><i
                                                class="fas fa-phone"></i></span>
                                        <input type="text" class="form-control form-control-lg" id="phone"
                                            value="0898394312<?php //echo htmlspecialchars($item['phone']);
                                                                ?>" readonly>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>
