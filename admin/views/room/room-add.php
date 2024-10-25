<?php include('includes/header.php'); ?>

<div class="row">
    <div class="col-xl-12 col-lg-12 mx-auto">
        <h2><?php echo htmlspecialchars($title); ?></h2>
        <!-- Nút quay lại nằm sát bên phải -->
        <div class="text-end mb-4">
            <a class="btn btn-secondary" href="room.php">
                Quay lại
            </a>
        </div>
        <form id="addRoomForm" action="../admin/controllers/code.php" method="post">
            <div class="row">
                <!-- Cột -->
                <div class="col-md-12">
                    <!-- Nhập tên phòng -->
                    <div class="form-group mb-3">
                        <label for="ten_phong">Tên phòng</label>
                        <input type="text" class="form-control" id="ten_phong" name="ten_phong" placeholder="Nhập tên phòng" required>
                    </div>
                </div>
            </div>

            <!-- Nút submit -->
            <button type="submit" name="saveRoom" class="btn btn-success w-15 mt-3">Lưu</button>
        </form>
    </div>
</div>

<?php include('includes/footer.php'); ?>
