<?php include('includes/header.php'); ?>

<div class="row">
    <div class="col-xl-12 col-lg-12 mx-auto">
        <h2>Xóa ghế</h2>
        <!-- Nút quay lại nằm sát bên phải -->
        <div class="text-end mb-4">
            <a class="btn btn-secondary" href="chair.php">
                Quay lại
            </a>
        </div>

        <div class="alert alert-warning" role="alert">
            Bạn có chắc chắn muốn xóa ghế "<strong><?php echo htmlspecialchars($ten_ghe); ?></strong>" không?
        </div>

        <!-- Nút xác nhận xóa ghế -->
        <form action="../admin/controllers/code.php" method="post" class="d-flex justify-content-center">
            <input type="hidden" name="ghe_id" value="<?php echo htmlspecialchars($ghe_id); ?>"> <!-- ID ghế để xóa -->
            <a href="javascript:window.history.back(-1);" class="btn btn-danger me-3">Huỷ</a>
            <button type="submit" name="confirmDeleteChair" class="btn btn-success">Đồng ý</button>
        </form>
    </div>
</div>

<?php include('includes/footer.php'); ?>