<?php include('includes/header.php'); ?>

<div class="row">
    <div class="col-xl-12 col-lg-12 mx-auto">
        <h2><?php echo htmlspecialchars($title); ?></h2>
        <div class="text-end mb-4">
            <a class="btn btn-secondary" href="room.php">
                Quay lại
            </a>
        </div>
        <form id="editRoomForm" action="../admin/controllers/code.php" method="post">
            <input type="hidden" name="room_id" value="<?php //echo $room['id']; 
                                                        ?>">
            <div class="form-group mb-3">
                <label for="ten_phong">Tên phòng</label>
                <input type="text" class="form-control" id="ten_phong" name="ten_phong" value="<?php //echo htmlspecialchars($room['ten_phong']); 
                                                                                                ?>" placeholder="Nhập tên phòng" required>
            </div>
            <button type="submit" name="updateRoom" class="btn btn-success mt-3">Cập nhật</button>
        </form>
    </div>
</div>

<?php include('includes/footer.php'); ?>