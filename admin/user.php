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

                <a href="user-add.php" class="btn btn-lg me-5 btn-add"
                    style="--bs-btn-padding-y: .5rem; --bs-btn-padding-x: 20px; --bs-btn-font-size: 1.25rem;">Thêm</a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mã người dùng</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tên đăng nhập</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">SĐT</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ảnh</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Trạng thái</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                                $users = getAll('NguoiDung');
                                if(mysqli_num_rows($users) > 0){
                                    foreach($users as $userItem){
                                        ?>
                                        <tr>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><?= $userItem['MaND']; ?></th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><?= $userItem['username']; ?></th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><?= $userItem['Email']; ?></th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><?= $userItem['SDT']; ?></th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
    <img src="../uploads/avatars/<?= htmlspecialchars($userItem['Anh']); ?>" alt="Ảnh đại diện" class="img-fluid" style="max-width: 100px;">

</th>

                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><?= $userItem['TrangThai'] == 1 ? 'ON': 'OFF'; ?></th>
                                            <td class="align-middle text-center text-sm">
                                                <a class="btn btn-secondary m-0" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" 
                                                    href="../admin/user-detail.php">
                                                    <i class="bi bi-info-circle"></i> Chi tiết
                                            </a>
                                                <a class="btn btn-info m-0" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                    href="../admin/user-edit.php?id=<?=$userItem['MaND']?>">
                                                    <i class="bi bi-pencil"></i> Sửa
                                                </a>
                                                <a class="btn btn-danger m-0" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" 
                                                    href="../admin/user-delete.php">
                                                    <i class="bi bi-trash"></i> Xoá
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                else{
                                    ?>
                                    <tr>
                                        <td colspan="6" class="text-center">Không có bản ghi nào</td>
                                    </tr>
                                    <?php
                                }
                            ?>
                            <tr>

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
