<?php include('includes/header.php'); ?>

<!-- Hiển thị nội dung danh sách phim -->
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center pb-0">
                <h5><?php echo $title ?></h5>
                <a href="#" class="btn btn-lg me-5 btn-add" data-bs-toggle="modal" data-bs-target="#addFilmModal"
                    style="--bs-btn-padding-y: .5rem; --bs-btn-padding-x: 20px; --bs-btn-font-size: 1.25rem;">Thêm</a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tên phim</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Thời lượng</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ảnh</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Trạng thái</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Đạo diễn</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Diễn viên</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Quốc gia</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Năm phát hành</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Phân loại</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Người tạo</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ngày tạo</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bolder mb-0">phim hành động</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0">120 phút</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <img src="../uploads/product-images/curved5-small.jpg" class="img-fluid">
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <span class="badge badge-sm bg-gradient-success">Online</span>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0">phúc ngu</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0">phúc đần</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0">Việt Nam</p>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0">Việt Nam</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0">Việt Nam</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0">Việt Nam</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <a class="btn btn-danger m-0"
                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                        Xóa
                                    </a>
                                    <a class="btn btn-info m-0"
                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" href="../admin/film-edit.php">
                                        Sửa
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <li class="page-item"><a class="page-link bg-dark text-light font-weight-bold" href="#">Trước</a></li>
                        <li class="page-item active" aria-current="page"><a class="page-link mx-1" href="#">1</a></li>
                        <li class="page-item"><a class="page-link mx-1" href="#">2</a></li>
                        <li class="page-item"><a class="page-link mx-1" href="#">3</a></li>
                        <li class="page-item"><a class="page-link bg-dark text-light font-weight-bold" href="#">Tiếp</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Modal Thêm thể loại phim -->
<div class="modal fade" id="addFilmModal" style="--bs-modal-width: 60rem" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryModalLabel">Thêm phim</h5>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">
                    <span>Đóng</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-xl-12 col-lg-12 mx-auto">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <!-- Cột 1: Tên phim, thể loại, mô tả -->
                            <div class="col-md-6">
                                <!-- Nhập tên phim -->
                                <div class="form-group mb-3">
                                    <label for="ten_phim">Tên phim</label>
                                    <input type="text" class="form-control" id="ten_phim" name="ten_phim" placeholder="Nhập tên phim" required>
                                </div>

                                <!-- Chọn thể loại phim bằng checkbox và thêm thể loại mới -->
                                <div class="form-group mb-3">
                                    <label for="the_loai">Thể loại</label>
                                    <div class="d-flex flex-wrap">
                                        <div class="form-check me-3">
                                            <input class="form-check-input" type="checkbox" name="the_loai[]" value="Hành động" id="the_loai_hanh_dong">
                                            <label class="form-check-label" for="the_loai_hanh_dong">Hành động</label>
                                        </div>
                                        <div class="form-check me-3">
                                            <input class="form-check-input" type="checkbox" name="the_loai[]" value="Tình cảm" id="the_loai_tinh_cam">
                                            <label class="form-check-label" for="the_loai_tinh_cam">Tình cảm</label>
                                        </div>
                                        <div class="form-check me-3">
                                            <input class="form-check-input" type="checkbox" name="the_loai[]" value="Kinh dị" id="the_loai_kinh_di">
                                            <label class="form-check-label" for="the_loai_kinh_di">Kinh dị</label>
                                        </div>
                                        <div class="form-check me-3">
                                            <input class="form-check-input" type="checkbox" name="the_loai[]" value="Viễn tưởng" id="the_loai_vien_tuong">
                                            <label class="form-check-label" for="the_loai_vien_tuong">Viễn tưởng</label>
                                        </div>
                                        <div class="form-check me-3">
                                            <input class="form-check-input" type="checkbox" name="the_loai[]" value="Hài" id="the_loai_hai">
                                            <label class="form-check-label" for="the_loai_hai">Hài</label>
                                        </div>
                                        <!-- Nút thêm thể loại mới chuyển sang trang categories-add.php -->
                                        <a href="../admin/categories-add.php" class="btn btn-success btn-sm ms-2">
                                            <i class="fas fa-plus"></i> Thêm thể loại
                                        </a>
                                    </div>
                                </div>

                                <!-- Thêm diễn viên, đạo diễn và quốc gia -->
                                <div class="form-group mb-3">
                                    <label for="dien_vien">Diễn viên</label>
                                    <input type="text" class="form-control" id="dien_vien" name="dien_vien" placeholder="Nhập tên diễn viên" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="dao_dien">Đạo diễn</label>
                                    <input type="text" class="form-control" id="dao_dien" name="dao_dien" placeholder="Nhập tên đạo diễn" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="quoc_gia">Quốc gia</label>
                                    <input type="text" class="form-control" id="quoc_gia" name="quoc_gia" placeholder="Nhập quốc gia sản xuất" required>
                                </div>

                                <!-- Nhập mô tả phim -->
                                <div class="form-group mb-3">
                                    <label for="mo_ta">Mô tả phim</label>
                                    <textarea class="form-control" id="mo_ta" name="mo_ta" rows="3" placeholder="Nhập mô tả phim" required></textarea>
                                </div>


                            </div>

                            <!-- Cột 2: Ảnh phim -->
                            <div class="col-md-6">
                                <!-- Chọn phân loại phim -->
                                <div class="form-group mb-3">
                                    <label for="phan_loai">Phân loại</label>
                                    <select class="form-control" id="phan_loai" name="phan_loai" required>
                                        <option value="P">Phổ thông</option>
                                        <option value="C13">C13</option>
                                        <option value="C16">C16</option>
                                        <option value="C18">C18</option>
                                    </select>
                                </div>

                                <!-- Năm phát hành -->
                                <div class="form-group mb-3">
                                    <label for="nam_phat_hanh">Năm phát hành</label>
                                    <input type="number" class="form-control" id="nam_phat_hanh" name="nam_phat_hanh" placeholder="Nhập năm phát hành" required>
                                </div>

                                <!-- Thời lượng phim -->
                                <div class="form-group mb-3">
                                    <label for="thoi_luong">Thời lượng (phút)</label>
                                    <input type="number" class="form-control" id="thoi_luong" name="thoi_luong" placeholder="Nhập thời lượng phim" required>
                                </div>

                                <!-- Chọn ảnh phim -->
                                <div class="form-group mb-3">
                                    <label for="anh_phim">Chọn ảnh phim</label>
                                    <input type="file" class="form-control" id="anh_phim" name="anh_phim" accept="image/*" required onchange="previewImage(event)">
                                </div>

                                <!-- Hiển thị ảnh đã chọn -->
                                <div class="form-group mb-3">
                                    <img id="preview" src="#" alt="Ảnh xem trước" style="display:none; max-width: 100%; height: auto;" />
                                </div>
                            </div>
                        </div>

                        <!-- Các trường tự động (Ẩn đi) -->
                        <input type="hidden" id="id_phim" name="id_phim" value="<?php echo uniqid(); ?>">
                        <input type="hidden" id="ngay_tao" name="ngay_tao" value="<?php echo date('Y-m-d H:i:s'); ?>">
                        <input type="hidden" id="nguoi_tao" name="nguoi_tao" value="<?php echo $_SESSION['username']; ?>">
                        <input type="hidden" id="ngay_chinh_sua" name="ngay_chinh_sua" value="<?php echo date('Y-m-d H:i:s'); ?>">
                        <input type="hidden" id="nguoi_chinh_sua" name="nguoi_chinh_sua" value="<?php echo $_SESSION['username']; ?>">

                        <!-- Nút submit -->
                        <button type="submit" class="btn btn-primary">Thêm phim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('preview');
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

    <?php include('includes/footer.php'); ?>
