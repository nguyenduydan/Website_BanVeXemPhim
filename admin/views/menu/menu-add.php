<?php include('../../includes/header.php'); ?>

<div class="row">
    <div class="col-xl-12 col-lg-12 mx-auto">
        <h2><?php echo htmlspecialchars($title); ?></h2>
        <!-- Nút quay lại nằm sát bên phải -->
        <div class="text-end mb-4">
            <a class="btn btn-secondary" href="menu.php">
                Quay lại
            </a>
        </div>
        <form id="addCategoryForm" action="../admin/controllers/code.php" method="post">
            <div class="row ">
                <!-- Cột 1 -->
                <div class="col-md-6 m-auto">
                    <!-- Nhập tên thể loại -->
                    <div class="form-group mb-3">
                        <label for="ten_the_loai">Tên thể loại</label>
                        <input type="text" class="form-control" id="ten_the_loai" name="ten_the_loai" placeholder="Nhập tên thể loại">
                    </div>
                    <div class="form-group mb-3">
                        <label for="status">Trạng thái</label>
                        <select class="form-control" id="status" name="status">
                            <option value="1">Online</option>
                            <option value="0">Offline</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success w-15 mt-3">Lưu</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include('../../includes/footer.php'); ?>
