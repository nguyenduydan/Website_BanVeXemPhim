<?php include('includes/header.php'); ?>

<div class="row">
    <div class="col-xl-12 col-lg-12 mx-auto">
        <h2>T<?php echo htmlspecialchars($title); ?></h2>
        <!-- Nút quay lại nằm sát bên phải -->
        <div class="text-end mb-4">
            <a class="btn btn-secondary" href="categories.php">
                Quay lại
            </a>
        </div>
        <form id="addCategoryForm" action="../admin/controllers/code.php" method="post">
            <div class="row">
                <!-- Cột 1 -->
                <div class="col-md-12">
                    <!-- Nhập tên thể loại -->
                    <div class="form-group mb-3">
                        <label for="ten_the_loai">Tên thể loại</label>
                        <input type="text" class="form-control" id="ten_the_loai" name="ten_the_loai" placeholder="Nhập tên thể loại" required>
                    </div>
                </div>
            </div>

            <!-- Nút submit -->
            <button type="submit" class="btn btn-success w-15 mt-3">Lưu</button>
        </form>
    </div>
</div>

<?php include('includes/footer.php'); ?>