<?php include('includes/header.php'); ?>
<!-- Hiển thị nội dung danh sách chủ đề -->
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center pb-0">
                <h5><?php echo $title ?></h5>
                <a href="views/topic/topic-add.php" class="btn btn-lg me-5 btn-add"
                    style="--bs-btn-padding-y: .5rem; --bs-btn-padding-x: 20px; --bs-btn-font-size: 1.25rem;">Thêm</a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0 ">
                    <table class="table table-striped table-borderless align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mã chủ đề</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tên chủ đề</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tên phòng</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Người tạo</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Trạng thái</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ngày tạo</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0"></p>
                                </td>
                                <td class=" align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0"></p>
                                </td>
                                <td class=" align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0"></p>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold"></span>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <?php
                                    // if ($row['TrangThai'] == '0') {
                                    //     echo '<span class="badge badge-sm bg-gradient-light text-dark">OFF</span>';
                                    // } else {
                                    //     echo '<span class="badge badge-sm bg-gradient-success">ON</span>';
                                    // }
                                    ?>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold"><?php echo $row['NgayTao'] ?? '' ?></span>
                                </td>

                                <td class="align-middle text-center text-sm">
                                    <a class="btn btn-info m-0" data-bs-toggle="modal" data-bs-target="#editTopicModal"
                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                        Sửa
                                    </a>
                                    <a class="btn btn-danger m-0" data-bs-toggle="modal" data-bs-target="#delTopicModal"
                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                        Xóa
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>
