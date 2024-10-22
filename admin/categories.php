<?php include('includes/header.php'); ?>
<?php include('../controllers/category_controller.php'); ?>
<!-- Hiển thị nội dung danh sách phim -->
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center pb-0">
                <h5><?php echo $title ?></h5>
                <a href="#" class="btn btn-lg me-5 btn-add"
                    data-bs-toggle="modal" data-bs-target="#addCategoryModal"
                    style="--bs-btn-padding-y: .5rem; --bs-btn-padding-x: 20px; --bs-btn-font-size: 1.25rem;">Thêm</a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mã thể loại</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Thể loại phim</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Người tạo</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Trạng thái</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ngày tạo</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                <tr>
                                    <td class="align-middle text-center text-sm">
                                        <p class="text-xs font-weight-bold mb-0"><?php echo $row['MaTheLoai'] ?? '' ?></p>
                                    </td>
                                    <td class=" align-middle text-center text-sm">
                                        <p class="text-xs font-weight-bold mb-0"><?php echo $row['TenTheLoai'] ?? '' ?></p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold"><?php echo $row['NguoiTao'] ?? '' ?></span>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <?php
                                        if ($row['TrangThai'] == '0') {
                                            echo '<span class="badge badge-sm bg-gradient-light text-dark">OFF</span>';
                                        } else {
                                            echo '<span class="badge badge-sm bg-gradient-success">ON</span>';
                                        }
                                        ?>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold"><?php echo $row['NgayTao'] ?? '' ?></span>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <a class="btn btn-info m-0" data-bs-toggle="modal" data-bs-target="#editCategoryModal"
                                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" href="../admin/categories-edit.php">
                                            Sửa
                                        </a>
                                        <a class="btn btn-danger m-0" data-bs-toggle="modal" data-bs-target="#delCategoryModal"
                                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                            Xóa
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Thêm thể loại phim -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryModalLabel">Thêm thể loại phim</h5>
                <button type="button" class="btn btn-danger"
                    style="--bs-btn-padding-y: .2rem; --bs-btn-padding-x: .2rem; --bs-btn-font-size: .75rem;"
                    data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                        <path class="text-border" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-xl-12 col-lg-12 mx-auto">
                    <form action="" method="POST">
                        <div class="row">
                            <!-- Cột 1: Tên thể loại và trạng thái -->
                            <div class="col-md">
                                <!-- Nhập tên thể loại -->
                                <div class="form-group mb-3">
                                    <label for="ten_the_loai">Tên thể loại</label>
                                    <input type="text" class="form-control" id="ten_the_loai" name="ten_the_loai" placeholder="Nhập tên thể loại" required>
                                </div>

                                <!-- Dropdown trạng thái -->
                                <div class="form-group mb-3">
                                    <label for="trang_thai">Trạng thái</label>
                                    <select class="form-control" id="trang_thai" name="trang_thai" required>
                                        <option value="Active">Hiển thị</option>
                                        <option value="Inactive">Không hiển thị</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Các trường tự động (Ẩn đi) -->
                            <input type="hidden" id="ma_the_loai" name="ma_the_loai" value="<?php echo uniqid(); ?>">
                            <input type="hidden" id="nguoi_tao" name="nguoi_tao" value="<?php echo $_SESSION['username']; ?>">
                            <input type="hidden" id="ngay_tao" name="ngay_tao" value="<?php echo date('Y-m-d H:i:s'); ?>">
                            <input type="hidden" id="nguoi_cap_nhat" name="nguoi_cap_nhat" value="<?php echo $_SESSION['username']; ?>">
                            <input type="hidden" id="ngay_cap_nhat" name="ngay_cap_nhat" value="<?php echo date('Y-m-d H:i:s'); ?>">

                        </div>

                        <!-- Nút submit -->
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Modal chỉnh sửa thể loại phim-->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel">Sửa thể loại phim</h5>
                <button type="button" class="btn btn-danger"
                    style="--bs-btn-padding-y: .2rem; --bs-btn-padding-x: .2rem; --bs-btn-font-size: .75rem;"
                    data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                        <path class="text-border" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-xl-12 col-lg-12 mx-auto">
                    <form action="" method="POST">
                        <div class="row">
                            <!-- Cột 1: Tên thể loại và trạng thái -->
                            <div class="col-md">
                                <!-- Nhập tên thể loại -->
                                <div class="form-group mb-3">
                                    <label for="ten_the_loai">Tên thể loại</label>
                                    <input type="text" class="form-control" id="ten_the_loai" name="ten_the_loai" placeholder="Nhập tên thể loại" required>
                                </div>

                                <!-- Dropdown trạng thái -->
                                <div class="form-group mb-3">
                                    <label for="trang_thai">Trạng thái</label>
                                    <select class="form-control" id="trang_thai" name="trang_thai" required>
                                        <option value="Active">Hiển thị</option>
                                        <option value="Inactive">Không hiển thị</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Các trường tự động (Ẩn đi) -->
                            <input type="hidden" id="ma_the_loai" name="ma_the_loai" value="<?php echo uniqid(); ?>">
                            <input type="hidden" id="nguoi_tao" name="nguoi_tao" value="<?php echo $_SESSION['username']; ?>">
                            <input type="hidden" id="ngay_tao" name="ngay_tao" value="<?php echo date('Y-m-d H:i:s'); ?>">
                            <input type="hidden" id="nguoi_cap_nhat" name="nguoi_cap_nhat" value="<?php echo $_SESSION['username']; ?>">
                            <input type="hidden" id="ngay_cap_nhat" name="ngay_cap_nhat" value="<?php echo date('Y-m-d H:i:s'); ?>">

                        </div>

                        <!-- Nút submit -->
                        <button type="submit" class="btn btn-primary">Lưu thể loại</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Modal xóa thể loại phim-->
<div class="modal fade" id="delCategoryModal" tabindex="-1" aria-labelledby="delCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delCategoryModalLabel">Xóa thể loại phim</h5>
                <button type="button" class="btn btn-danger"
                    style="--bs-btn-padding-y: .2rem; --bs-btn-padding-x: .2rem; --bs-btn-font-size: .75rem;"
                    data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                        <path class="text-border" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-xl-12 col-lg-12 mx-auto">
                    <form action="" method="POST" class="text-center">
                        <h5 class="my-5">Bạn có đồng ý xóa không?</h5>
                        <div class="d-flex justify-content-center">
                            <button type="button" class="btn btn-danger me-4" data-bs-dismiss="modal" aria-label="Close" style="width: 7rem;">Hủy</button>
                            <button type="submit" class="btn btn-success" style="width: 7rem;">Đồng ý</button>
                        </div>
                        <!-- Nút submit -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
