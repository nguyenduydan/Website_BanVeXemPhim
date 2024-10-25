<?php

require '../config/function.php';
include('includes/header.php');

?>
<div id="toast">
</div>
<?php alertMessage() ?>
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center pb-0">
                <h5><?php echo $title ?></h5>
                <a href="views/menu/menu-add.php" class="btn btn-lg me-5 btn-add"
                    style="--bs-btn-padding-y: .5rem; --bs-btn-padding-x: 20px; --bs-btn-font-size: 1.25rem;">Thêm</a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0 ">
                    <table class="table table-striped table-borderless align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">STT</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Thể loại phim</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Người tạo</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ngày tạo</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ngày cập nhật</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Trạng thái</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $categories = getAll('TheLoai');
                            $stt = 0;
                            if (mysqli_num_rows($categories) > 0) {
                                foreach ($categories as $categoryItem) {
                                    $stt++;
                            ?>
                                    <tr>
                                        <th class="text-center text-xs font-weight-bolder"><?= $stt ?></th>
                                        <th class="text-center text-xs font-weight-bolder"><?= $categoryItem['TenTheLoai']; ?></th>
                                        <th class="text-center text-xs font-weight-bolder"><?= $categoryItem['NguoiTao']; ?></th>
                                        <th class="text-center text-xs font-weight-bolder"><?= $categoryItem['NgayTao']; ?></th>
                                        <th class="text-center text-xs font-weight-bolder"><?= $categoryItem['NgayCapNhat']; ?></th>
                                        <th class="text-center text-s font-weight-bolder">
                                            <?= $categoryItem['TrangThai'] == 1 ? '<span class="badge badge-sm bg-gradient-success text-uppercase">ON</span>' : '<span class="badge badge-sm bg-gradient-success text-uppercase text-secondary">ON</span>'; ?>
                                        </th>
                                        <td class="align-middle text-center text-sm">
                                            <a class="btn btn-info m-0" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                href="../admin/categories-edit.php?id=<?= $categoryItem['MaTheLoai'] ?>">
                                                <i class="bi bi-pencil"></i> Sửa
                                            </a>
                                            <a class="btn btn-danger m-0" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                href="../admin/categories-delete.php?id=<?= $categoryItem['MaTheLoai'] ?>">
                                                <i class="bi bi-trash"></i> Xoá
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="7" class="text-center">Không có bản ghi nào</td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
