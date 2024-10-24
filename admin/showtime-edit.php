<?php include('includes/header.php'); ?>

<div class="row">
    <div class="col-xl-12 col-lg-12 mx-auto">
        <h2>Chỉnh sửa suất chiếu</h2>
        <!-- Nút quay lại nằm sát bên phải -->
        <div class="text-end mb-4">
            <a class="btn btn-secondary" href="showtime.php">
                Quay lại
            </a>
        </div>

        <!-- Form chỉnh sửa suất chiếu -->
        <form id="editShowtimeForm" action="../admin/controllers/code.php" method="post">
            <input type="hidden" name="showtime_id" value="<?php //echo htmlspecialchars($showtime_id); ?>">

            <div class="row">
                <!-- Giờ chiếu -->
                <div class="col-md-6 mb-3">
                    <label for="gio_chieu">Giờ chiếu</label>
                    <input type="time" class="form-control" id="gio_chieu" name="gio_chieu" value="<?php //echo htmlspecialchars($showtime['gio_chieu']); ?>" required>
                </div>

                <!-- Dropdown chọn mã phim -->
                <div class="col-md-6 mb-3">
                    <label for="ma_phim">Mã phim</label>
                    <select class="form-control" id="ma_phim" name="ma_phim" required>
                        <option value="">Chọn mã phim</option>
                        <?php
                        // Giả sử bạn có một mảng $films chứa danh sách phim
                        //foreach ($films as $film): ?>
                            <option value="<?php //echo htmlspecialchars($film['id']); ?>" <?php //echo ($film['id'] == $showtime['ma_phim']) ? 'selected' : ''; ?>>
                                <?php //echo htmlspecialchars($film['ten_phim']); ?>
                            </option>
                        <?php //endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- Nút submit -->
            <button type="submit" name="updateShowtime" class="btn btn-success mt-3">Cập nhật suất chiếu</button>
        </form>
    </div>
</div>

<?php include('includes/footer.php'); ?>
