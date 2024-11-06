<div class="card profile-form shadow-sm">
    <div class="card-body">
        <form>
            <!-- Tên đầy đủ -->
            <div class="mb-3">
                <label for="fullName" class="form-label">Họ và tên</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" class="form-control" id="fullName" value="<?php //echo htmlspecialchars($item['fullName']); 
                                                                                    ?>" readonly>
                </div>
            </div>

            <!-- Ngày sinh -->
            <div class="mb-3">
                <label for="dob" class="form-label">Ngày sinh</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                    <input type="text" class="form-control" id="dob" value="<?php //echo htmlspecialchars($item['dob']); 
                                                                            ?>" readonly>
                </div>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" class="form-control" id="email" value="<?php //echo htmlspecialchars($item['email']); 
                                                                                ?>" readonly>
                </div>
            </div>

            <!-- Số điện thoại -->
            <div class="mb-3">
                <label for="phone" class="form-label">Số điện thoại</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    <input type="text" class="form-control" id="phone" value="<?php //echo htmlspecialchars($item['phone']); 
                                                                                ?>" readonly>
                </div>
            </div>

            <!-- Giới tính -->
            <div class="mb-3">
                <label class="form-label">Giới tính</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="male" value="male" <?php //echo ($item['gender'] == 'male') ? 'checked' : ''; 
                                                                                                        ?> disabled>
                    <label class="form-check-label" for="male">Nam</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="female" value="female" <?php //echo ($item['gender'] == 'female') ? 'checked' : ''; 
                                                                                                            ?>
                        disabled>
                    <label class="form-check-label" for="female">Nữ</label>
                </div>
            </div>

            <!-- Mật khẩu -->
            <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control" id="password" value="<?php //echo htmlspecialchars($item['password']); 
                                                                                        ?>" readonly>
                    <button class="btn btn-outline-secondary" type="button"
                        onclick="togglePasswordVisibility('password')">
                        <i class="fas fa-eye-slash"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>