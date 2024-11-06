<?php include('includes/header.php'); ?>

<div class="main-banner" id="top"></div>
<div class="container my-4">
    <div class="row">
        <!-- Hồ sơ người dùng -->
        <div class="col-md-4">
            <div class="card profile-card shadow-sm">
                <div class="card-body text-center">
                    <h4>Tên người dùng</h4>
                    <div class="spending-info mt-3">
                        <?php
                        // if ($tongTien < 2000000) {
                        //     echo '<span class="badge bg-primary">Thành viên</span>';
                        // } elseif ($tongTien < 5000000) {
                        //     echo '<span class="badge bg-warning text-dark">VIP</span>';
                        // } else {
                        //     echo '<span class="badge bg-purple">Platinum</span>';
                        // }
                        ?>
                        <h5 class="mt-3">Tổng chi tiêu 2024</h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- Biểu mẫu hồ sơ -->
        <div class="col-md-8">
            <?php include('views/detail-user.php'); ?>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>