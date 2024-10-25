<?php include('../../includes/header.php'); ?>

<div class="row">
    <div class="col-xl-12 col-lg-12 mx-auto">
        <h2>Xoá suất chiếu</h2>
        <!-- Nút quay lại nằm sát bên phải -->
        <div class="text-end mb-4">
            <a class="btn btn-secondary" href="showtime.php">
                Quay lại
            </a>
        </div>

        <div class="alert alert-warning" role="alert">
            Bạn có chắc chắn muốn xoá suất chiếu "<strong><?php echo htmlspecialchars($showtime_title); ?></strong>" không?
        </div>

        <!-- Nút xác nhận xoá suất chiếu -->
        <form action="../admin/controllers/code.php" method="post" class="d-flex justify-content-center">
            <input type="hidden" name="showtime_id" value="<?php echo htmlspecialchars($showtime_id); ?>">
            <a href="javascript:window.history.back(-1);" class="btn btn-danger me-3">Huỷ</a>
            <button type="submit" name="confirmDeleteShowtime" class="btn btn-success">Đồng ý</button>
        </form>
    </div>
</div>

<?php include('../../includes/footer.php'); ?>
