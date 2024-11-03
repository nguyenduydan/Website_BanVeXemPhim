<?php
ob_start();
session_start();
require '../config/function.php';
include('includes/header.php');
$messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : []; // Lấy lỗi từ session
$formData = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];
unset($_SESSION['messages']); // Xóa lỗi khỏi session sau khi hiển thị
unset($_SESSION['form_data']);
$pagination = setupPagination($conn, 'Menu'); // Sửa tên bảng thành 'Menu'
$data = $pagination['data'];
$records_per_page = $pagination['records_per_page'];
?>
<style>
li {
    list-style-type: none;
}
</style>
<div id="toast"></div>

<?php alertMessage() ?>

<!-- Hiển thị nội dung danh sách menu -->
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center pb-0">
                <h5><?php echo $title ?></h5>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="row px-4">
                    <div class="col-4">
                        <div class="card px-3">
                            <div class="card-body form-control shadow">
                                <label for="records_per_page" class="me-2 fs-6">Chọn vị trí</label>
                                <select class="form-select">
                                    <option>Header</option>
                                    <option>Footer</option>
                                </select>
                            </div>
                            <div class="card-body">
                                <ul class="ps-0" data-widget="treeview" role="menu" data-accordion="false">
                                    <li class="dropdown form-control w-100 mb-3 border shadow">
                                        <div class="border-bottom">
                                            <label class="mt-2 fs-6" for="">Trạng thái phim</label>
                                            <a class="float-end mt-1 me-2 fs-3" data-bs-toggle="collapse"
                                                data-bs-target="#listStatus" aria-expanded="false"><i
                                                    class="bi bi-plus-square-fill text-success"></i>
                                            </a>
                                        </div>
                                        <ul class="treeview collapse mt-3" id="listStatus">
                                            <?php
                                            $status = getAll('Phim');
                                            foreach ($status as $row):
                                            ?>
                                            <li class="mb-3 fs-6 fw-bold">
                                                <div class="form-check align-items-center">
                                                    <input name="status" id="status-<?= $row['MaPhim'] ?>"
                                                        type="checkbox" class="form-check-input">
                                                    <label for="status-<?= $row['MaPhim'] ?>">
                                                        <?= $row['TrangThai'] == 1 ? 'Đang chiếu' : 'Sắp chiếu' ?></label>
                                                </div>
                                            </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                    <li class="dropdown form-control w-100 mb-3 border shadow">
                                        <div class="border-bottom">
                                            <label class="mt-2 fs-6" for="">Tùy chọn</label>
                                            <a class="float-end mt-1 me-2 fs-3" data-bs-toggle="collapse"
                                                data-bs-target="#random" aria-expanded="false"><i
                                                    class="bi bi-plus-square-fill text-success"></i>
                                            </a>
                                        </div>
                                        <ul class="treeview collapse mt-3 ps-0" id="random">
                                            <form action="controllers/menu-controller.php" method="post">
                                                <li class="mb-3 fs-6 fw-bold">
                                                    <div class="align-items-center ps-0 mb-3">
                                                        <label for="name">Nhập tên menu</label>
                                                        <input class="form-control" type="text" name="name" id="name">
                                                        <?php if (isset($messages['name'])): ?>
                                                        <small
                                                            class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['name']) ?></small>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="align-items-center ps-0">
                                                        <label for="lienket">Nhập đường link</label>
                                                        <input class="form-control" type="text" name="lienket"
                                                            id="lienket">
                                                        <?php if (isset($messages['lienket'])): ?>
                                                        <small
                                                            class="text-danger m-2 text-xs"><?= htmlspecialchars($messages['lienket']) ?></small>
                                                        <?php endif; ?>
                                                    </div>
                                                </li>
                                                <li class="fs-6 fw-bold d-flex justify-content-center">
                                                    <button
                                                        class="btn btn-sm py-2 px-3 bg-gradient-success d-flex align-items-center"
                                                        name="addMenuTuyChon">Thêm<i
                                                            class="bi bi-plus ms-1 text-lg"></i></button>
                                                </li>
                                            </form>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-8 card card-body">
                        <div class="w-25">
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
                        </div>
                        <div class="table-responsive p-0">
                            <table class="table table-striped table-borderless align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-xs font-weight-bolder">STT</th>
                                        <th class="text-center text-uppercase text-xs font-weight-bolder">Tên Menu</th>
                                        <th class="text-center text-uppercase text-xs font-weight-bolder">Liên Kết</th>
                                        <th class="text-center text-uppercase text-xs font-weight-bolder">Thứ Tự</th>
                                        <th class="text-center text-uppercase text-xs font-weight-bolder">Trạng Thái
                                        </th>
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
                                        <th class="text-center text-xs font-weight-bolder"
                                            style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                            <?= $item['LienKet']; ?></th>
                                        <th class="text-center text-xs font-weight-bolder"><?= $item['Order']; ?></th>
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
                                            <a class="btn btn-success m-0"
                                                style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                href="views/menu/menu-detail.php?id=<?= $item['Id'] ?>">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a class="btn btn-info m-0"
                                                style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                href="views/menu/menu-edit.php?id=<?= $item['Id'] ?>">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <a class="btn btn-danger m-0 delete-btn" data-id="<?= $item['Id'] ?>"
                                                data-url="views/menu/menu-delete.php"
                                                style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                data-bs-toggle="modal" data-bs-target="#confirmModal">
                                                <i class="bi bi-trash"></i>
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