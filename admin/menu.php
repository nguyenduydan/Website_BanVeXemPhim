<?php
ob_start();
session_start();
require '../config/function.php';
include('includes/header.php');

$pagination = setupPagination($conn, 'Menu'); // Sửa tên bảng thành 'Menu'
$data = $pagination['data'];
$records_per_page = $pagination['records_per_page'];
?>

<div id="toast"></div>

<?php alertMessage() ?>

<!-- Hiển thị nội dung danh sách menu -->
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center pb-0">
                <h5><?php echo $title ?></h5>
                <form method="POST" class="d-inline">
                    <label for="records_per_page" class="me-2 fs-6">Chọn hiển thị số bản ghi:</label>
                    <select name="records_per_page" id="records_per_page" class="form-select"
                        onchange="this.form.submit()">
                        <option value="2" <?= $records_per_page == 2 ? 'selected' : '' ?>>2</option>
                        <option value="5" <?= $records_per_page == 5 ? 'selected' : '' ?>>5</option>
                        <option value="10" <?= $records_per_page == 10 ? 'selected' : '' ?>>10</option>
                        <option value="20" <?= $records_per_page == 20 ? 'selected' : '' ?>>20</option>
                    </select>
                </form>
                <a href="views/menu/menu-add.php" class="btn btn-lg me-5 btn-add"
                    style="--bs-btn-padding-y: .5rem; --bs-btn-padding-x: 20px; --bs-btn-font-size: 1.25rem;">
                    <i class="bi bi-plus me-1 fs-3" style="margin-bottom: 5px;"></i>
                    Thêm
                </a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table table-striped table-borderless align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-xs font-weight-bolder">STT</th>
                                <th class="text-center text-uppercase text-xs font-weight-bolder">Tên Menu</th>
                                <th class="text-center text-uppercase text-xs font-weight-bolder">Kiểu Menu</th>
                                <th class="text-center text-uppercase text-xs font-weight-bolder">Vị Trí</th>
                                <th class="text-center text-uppercase text-xs font-weight-bolder">Liên Kết</th>
                                <th class="text-center text-uppercase text-xs font-weight-bolder">Thứ Tự</th>
                                <th class="text-center text-uppercase text-xs font-weight-bolder">Trạng Thái</th>
                                <th class="text-center text-uppercase text-xs font-weight-bolder">Người Tạo</th>
                                <th class="text-center text-uppercase text-xs font-weight-bolder">Ngày Tạo</th>
                                <th class="text-center text-uppercase text-xs font-weight-bolder">Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $stt = 0;
                            if (!empty($data)) {
                                foreach ($data as $item) {
                                    $stt++;
                            ?>
                            <tr>
                                <th class="text-center text-xs font-weight-bolder"><?= $stt ?></th>
                                <th class="text-center text-xs font-weight-bolder"><?= $item['TenMenu']; ?></th>
                                <th class="text-center text-xs font-weight-bolder"><?= $item['KieuMenu']; ?></th>
                                <th class="text-center text-xs font-weight-bolder"><?= $item['ViTri']; ?></th>
                                <th class="text-center text-xs font-weight-bolder"><?= $item['LienKet']; ?></th>
                                <th class="text-center text-xs font-weight-bolder"><?= $item['Order']; ?></th>
                                <td class="text-center text-xs font-weight-bolder"><?= $item['NguoiTao']; ?></td>
                                <td class="text-center text-xs font-weight-bolder"><?= $item['NgayTao']; ?></td>
                                <th class="text-center text-s font-weight-bolder">
                                    <form action="controllers/menu-controller.php" method="POST"
                                        style="display:inline;">
                                        <input type="hidden" name="id" value="<?= $item['Id'] ?>">
                                        <input type="hidden" name="status"
                                            value="<?= $item['TrangThai'] == 1 ? 0 : 1 ?>">
                                        <button type="submit" name="changeStatus"
                                            class="badge badge-sm <?= $item['TrangThai'] == 1 ? 'bg-gradient-success' : 'bg-gradient-secondary' ?> text-uppercase"
                                            style="border: none; cursor: pointer;">
                                            <?= $item['TrangThai'] == 1 ? 'ON' : 'OFF' ?>
                                        </button>
                                    </form>
                                </th>

                                <td class="align-middle text-center text-sm">
                                    <a class="btn btn-info m-0"
                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                        href="views/menu/menu-edit.php?id=<?= $item['Id'] ?>">
                                        <i class="bi bi-pencil"></i> Sửa
                                    </a>
                                    <a class="btn btn-danger m-0 delete-btn" data-id="<?= $item['Id'] ?>"
                                        data-url="views/menu/menu-delete.php"
                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                        data-bs-toggle="modal" data-bs-target="#confirmModal">
                                        <i class="bi bi-trash"></i> Xoá
                                    </a>
                                </td>
                            </tr>
                            <?php
                                }
                            } else {
                                ?>
                            <tr>
                                <td colspan="10" class="text-center">Không có bản ghi nào</td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Phân trang -->
            <div class="card-footer">
                <?php echo paginate_html($pagination['total_pages'], $pagination['current_page']); ?>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>
