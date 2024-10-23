<?php include('includes/header.php'); ?>

<!-- Hiển thị nội dung danh sách phòng -->
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center pb-0">
                <h5><?php echo $title ?></h5>
                <a href="../admin/room-add.php" class="btn btn-lg me-5 btn-add"
                    style="--bs-btn-padding-y: .5rem; --bs-btn-padding-x: 20px; --bs-btn-font-size: 1.25rem;">Thêm</a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table table-striped table-borderless align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tên phòng</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Trạng thái</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Người tạo</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ngày tạo</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Người cập nhật</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ngày cập nhật</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bolder mb-0">Phòng họp</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <span class="badge badge-sm bg-gradient-success">Đang hoạt động</span>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0">Nguyễn Văn A</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <span class="text-secondary text-xs font-weight-bold">01/01/2023</span>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0">Trần Thị B</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <span class="text-secondary text-xs font-weight-bold">15/01/2023</span>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <a class="btn btn-info m-0"
                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                        href="../admin/room-edit.php">
                                        <i class="bi bi-pencil"></i> Sửa
                                    </a>
                                    <a class="btn btn-danger m-0"
                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" href="../admin/room-delete.php">
                                        <i class="bi bi-trash"></i> Xoá
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

<?php include('includes/footer.php'); ?>