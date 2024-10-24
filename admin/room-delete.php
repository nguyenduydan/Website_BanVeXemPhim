<?php include('includes/header.php'); ?>

<div class="row">
    <div class="col-xl-12 col-lg-12 mx-auto">
        <h2>Xoá phòng</h2>
        <!-- Nút quay lại nằm sát bên phải -->
        <div class="text-end mb-4">
            <a class="btn btn-secondary" href="room.php">
                <i class="bi bi-arrow-left-short"></i> Quay lại
            </a>
        </div>

        <div class="alert alert-warning" role="alert">
            Bạn có chắc chắn muốn xoá phòng "<strong><?php echo htmlspecialchars($title); ?></strong>" không?
        </div>

        <!-- Nút xác nhận xoá phòng -->
        <form action="../admin/controllers/code.php" method="post" class="d-flex justify-content-center">
            <input type="hidden" name="room_id" value="<?php echo htmlspecialchars($room_id); ?>">
            <a href="javascript:window.history.back(-1);" class="btn btn-danger me-3">Huỷ</a>
            <button type="submit" name="confirmDelete" class="btn btn-success">Đồng ý</button>
        </form>
    </div>
</div>

<?php include('includes/footer.php'); ?>
