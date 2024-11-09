<?php
ob_start();
session_start();

require '../config/function.php';
include('includes/header.php');

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    redirect('sign-in.php', 'error', 'Vui lòng đăng nhập');
}

$records_per_page = isset($_POST['records_per_page']) ? (int)$_POST['records_per_page'] : 5;
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$searchString = isset($_GET['searchString']) ? trim($_GET['searchString']) : '';

$pagination = searchString($searchString, $records_per_page, $current_page, 'Phim', 'TenPhim');
$data = $pagination['data'];
$total_pages = $pagination['total_pages'];
?>

<div id="toast"></div>

<?php alertMessage() ?>

<!-- Hiển thị nội dung danh sách phim -->
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center pb-0">
                <h5 class="col-2"><?php echo $title ?></h5>

                <form method="POST" class="d-inline col-2">
                    <label for="records_per_page" class="me-2 fs-6">Chọn hiển thị số bản ghi:</label>
                    <select name="records_per_page" id="records_per_page" class="form-select" onchange="this.form.submit()">
                        <option value="2" <?= $records_per_page == 2 ? 'selected' : '' ?>>2</option>
                        <option value="5" <?= $records_per_page == 5 ? 'selected' : '' ?>>5</option>
                        <option value="10" <?= $records_per_page == 10 ? 'selected' : '' ?>>10</option>
                        <option value="20" <?= $records_per_page == 20 ? 'selected' : '' ?>>20</option>
                    </select>
                </form>

                <div class="col-3">
                    <form class="mb-3 mb-lg-0 me-3 input-group w-100 flex-nowrap" role="search" method="GET" action="#">
                        <button type="submit"><span class="input-group-text bg-dark text-white border" style="cursor: pointer;">
                                <i class="bi bi-search"></i>
                            </span></button>
                        <input type="search" name="searchString" class="form-control ps-4" placeholder="Search..." aria-label="Search" value="<?= htmlspecialchars($searchString) ?>">
                        <input type="hidden" name="page" value="<?= $current_page ?>">
                    </form>
                </div>

                <a href="views/film/film-add.php" class="btn col-1 btn-lg me-5 btn-add" style="--bs-btn-padding-y: .5rem; --bs-btn-padding-x: 20px; --bs-btn-font-size: 1.25rem;">
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
                                <th class="text-center text-uppercase text-xs font-weight-bolder">Tên phim</th>
                                <th class="text-center text-uppercase text-xs font-weight-bolder">Thời lượng</th>
                                <th class="text-center text-uppercase text-xs font-weight-bolder">Quốc gia</th>
                                <th class="text-center text-uppercase text-xs font-weight-bolder" style="max-width: 150px;">Thể loại</th>
                                <th class="text-center text-uppercase text-xs font-weight-bolder">Phân loại</th>
                                <th class="text-center text-uppercase text-xs font-weight-bolder">Ngày tạo</th>
                                <th class="text-center text-uppercase text-xs font-weight-bolder">Trạng thái</th>
                                <th class="text-center text-uppercase text-xs font-weight-bolder">Hành động</th>
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
                                        <th class="text-center text-xs font-weight-bolder"><?= htmlspecialchars($item['TenPhim']); ?></th>
                                        <th class="text-center text-xs font-weight-bolder"><?= htmlspecialchars($item['ThoiLuong']); ?></th>
                                        <th class="text-center text-xs font-weight-bolder"><?= htmlspecialchars($item['QuocGia']); ?></th>
                                        <?php
                                        // Fetch genres
                                        global $conn;
                                        $query = "SELECT GROUP_CONCAT(Theloai.TenTheLoai SEPARATOR ', ') AS TheLoai
                                                  FROM PHIM
                                                  JOIN THELOAI_FILM ON PHIM.MAPHIM = THELOAI_FILM.MAPHIM
                                                  JOIN THELOAI ON THELOAI_FILM.MATHELOAI = THELOAI.MATHELOAI
                                                  WHERE PHIM.MAPHIM = {$item['MaPhim']}
                                                  GROUP BY PHIM.MAPHIM";
                                        $result = $conn->query($query);
                                        $genres = $result->fetch_assoc()['TheLoai'] ?? 'Chưa xác định';
                                        ?>
                                        <th class="text-center text-xs font-weight-bolder" style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                            <?= htmlspecialchars($genres); ?></th>
                                        <th class="text-center text-xs font-weight-bolder"><?= htmlspecialchars($item['PhanLoai'] ?? 'Chưa xác định'); ?></th>
                                        <th class="text-center text-xs font-weight-bolder"><?= htmlspecialchars($item['NgayTao']); ?></th>
                                        <th class="text-center text-s font-weight-bolder">
                                            <form action="controllers/film-controller.php" method="POST" style="display:inline;">
                                                <input type="hidden" name="ma_phim" value="<?= $item['MaPhim'] ?>">
                                                <input type="hidden" name="status" value="<?= ($item['TrangThai'] + 1) % 3 ?>">
                                                <button type="submit" name="changeStatus" class="badge badge-sm <?= $item['TrangThai'] == 0 ? 'bg-gradient-secondary' : ($item['TrangThai'] == 1 ? 'bg-gradient-success' : 'bg-gradient-warning') ?> text-uppercase" style="border: none; cursor: pointer;">
                                                    <?= $item['TrangThai'] == 0 ? 'OFF' : ($item['TrangThai'] == 1 ? 'ON' : 'COMING SOON') ?>
                                                </button>
                                            </form>
                                        </th>
                                        <td class="align-middle text-center text-sm">
                                            <a class="btn btn-secondary m-0" href="views/film/film-detail.php?id=<?= $item['MaPhim'] ?>" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                                <i class="bi bi-info-circle"></i> Chi tiết
                                            </a>
                                            <a class="btn btn-info m-0" href="views/film/film-edit.php?id=<?= $item['MaPhim'] ?>" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                                <i class="bi bi-pencil"></i> Sửa
                                            </a>
                                            <a class="btn btn-danger m-0 delete-btn" data-url="views/film/film-delete.php" data-id="<?= $item['MaPhim'] ?>" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" data-bs-toggle="modal" data-bs-target="#confirmModal">
                                                <i class="bi bi-trash"></i> Xoá
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="9" class="text-center">Không có bản ghi nào</td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <?php echo paginate_html($total_pages, $current_page); ?>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
<?php $conn->close(); ?>