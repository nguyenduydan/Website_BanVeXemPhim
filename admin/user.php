<?php
ob_start(); // Bắt đầu output buffering
session_start(); // Bắt đầu session

require '../config/function.php';
include('includes/header.php');

// Xử lý biểu mẫu
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['records_per_page'])) {
    $_SESSION['records_per_page'] = (int)$_POST['records_per_page'];
    header("Location: " . $_SERVER['PHP_SELF'] . "?page=1"); // Chuyển hướng
    exit; // Dừng thực thi mã
}

// Gán giá trị cho $records_per_page từ session hoặc mặc định là 5
$records_per_page = isset($_SESSION['records_per_page']) ? $_SESSION['records_per_page'] : 5;

// Lấy số trang hiện tại từ URL, mặc định là 1
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
// Gọi hàm phân trang
$pagination = paginate($conn, 'NguoiDung', $records_per_page, $current_page);
$data = $pagination['data'];


// Thêm phần này để xử lý sắp xếp
$sortField = isset($_GET['sort']) ? $_GET['sort'] : 'username'; // Trường sắp xếp mặc định
$sortOrder = isset($_GET['order']) ? $_GET['order'] : 'ASC'; // Thứ tự sắp xếp mặc định


// Chuyển đổi $data từ mysqli_result sang mảng
$dataArray = [];
while ($row = mysqli_fetch_assoc($data)) {
    $dataArray[] = $row;
}

// Gọi hàm sắp xếp
sortData($dataArray, $sortField, $sortOrder);
?>

<div id="toast"></div>

<?php alertMessage() ?>

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center pb-0">
                <h5><?php echo $title ?></h5>
                <form method="POST" class="d-inline">
                    <label for="records_per_page" class="me-2 fs-6">Chọn hiển thị số bản ghi:</label>
                    <select name="records_per_page" id="records_per_page" class="form-select" onchange="this.form.submit()">
                        <option value="2" <?= $records_per_page == 2 ? 'selected' : '' ?>>2</option>
                        <option value="5" <?= $records_per_page == 5 ? 'selected' : '' ?>>5</option>
                        <option value="10" <?= $records_per_page == 10 ? 'selected' : '' ?>>10</option>
                        <option value="20" <?= $records_per_page == 20 ? 'selected' : '' ?>>20</option>
                    </select>
                </form>
                <a href="user-add.php" class="btn btn-lg me-5 btn-add"
                    style="--bs-btn-padding-y: .5rem; --bs-btn-padding-x: 20px; --bs-btn-font-size: 1.25rem;">Thêm</a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table table-striped table-borderless align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-xs font-weight-bolder">STT</th>
                                <th class="text-center text-uppercase text-xs font-weight-bolder">
                                    Tên đăng nhập
                                    <a href="?page=<?= $current_page ?>&sort=username&order=<?= ($sortField === 'username' && $sortOrder === 'ASC') ? 'DESC' : 'ASC' ?>">
                                        <?php if ($sortField === 'username'): ?>
                                            <i class="bi <?= $sortOrder === 'ASC' ? 'bi-sort-alpha-down' : 'bi bi-sort-alpha-up' ?> fs-6 fw-bolder"></i>
                                        <?php endif; ?>
                                    </a>
                                </th>
                                <th class="text-center text-uppercase text-xs font-weight-bolder">
                                    Email
                                </th>
                                <th class="text-center text-uppercase text-xs font-weight-bolder">
                                    SĐT
                                </th>
                                <th class="text-center text-uppercase text-xs font-weight-bolder">Ảnh</th>
                                <th class="text-center text-uppercase text-xs font-weight-bolder">Trạng thái</th>
                                <th class="text-center text-uppercase text-xs font-weight-bolder">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $stt = 0;
                            if (!empty($dataArray) > 0) {
                                foreach ($dataArray as $userItem) {
                                    $stt++;
                            ?>
                                    <tr>
                                        <th class="text-center text-xs font-weight-bolder"><?= $stt ?></th>
                                        <th class="text-center text-xs font-weight-bolder"><?= $userItem['username']; ?></th>
                                        <th class="text-center text-xs font-weight-bolder"><?= $userItem['Email']; ?></th>
                                        <th class="text-center text-xs font-weight-bolder"><?= $userItem['SDT']; ?></th>
                                        <th class="text-center text-xs font-weight-bolder">
                                            <img src="../uploads/avatars/<?= htmlspecialchars($userItem['Anh']); ?>" alt="Ảnh đại diện" class="img-fluid" style="max-width: 100px;">
                                        </th>
                                        <th class="text-center text-s font-weight-bolder">
                                            <?= $userItem['TrangThai'] == 1 ? '<span class="badge badge-sm bg-gradient-success text-uppercase">ON</span>' : '<span class="badge badge-sm bg-gradient-secondary text-uppercase">OFF</span>'; ?>
                                        </th>
                                        <td class="align-middle text-center text-sm">
                                            <a class="btn btn-secondary m-0" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                href="../admin/user-detail.php?id=<?= $userItem['MaND'] ?>">
                                                <i class="bi bi-info-circle"></i> Chi tiết
                                            </a>
                                            <a class="btn btn-info m-0" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                href="../admin/user-edit.php?id=<?= $userItem['MaND'] ?>">
                                                <i class="bi bi-pencil"></i> Sửa
                                            </a>
                                            <a class="btn btn-danger m-0 delete-btn" data-id="<?= $userItem['MaND'] ?>"
                                                style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                data-bs-toggle="modal" data-bs-target="#confirmModal">
                                                <i class="bi bi-trash"></i> Xoá
                                            </a>
                                            <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
                                                <div class="modal-dialog mt-10">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="confirmModalLabel">Xác Nhận Xóa</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body fs-5">
                                                            Bạn có chắc chắn muốn xóa người dùng này?
                                                        </div>
                                                        <div class="modal-footer d-flex justify-content-center">
                                                            <button type="button" class="btn btn-sm btn-success" id="confirmYes">Có</button>
                                                            <button type="button" class="btn btn-sm btn-danger me-2" data-bs-dismiss="modal">Không</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
            <div class="card-footer">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <?php if ($pagination['total_pages'] > 1): // Kiểm tra xem có nhiều hơn 1 trang
                        ?>
                            <?php if ($current_page > 1): ?>
                                <li class="page-item">
                                    <a class="page-link bg-gradient-dark text-white" href="?page=<?= $current_page - 1 ?>">
                                        <i class="bi bi-chevron-left fs-6 fw-bolder"></i>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php for ($i = 1; $i <= $pagination['total_pages']; $i++): ?>
                                <li class="page-item <?= ($i == $current_page) ? 'active' : '' ?>">
                                    <a class="page-link border-radius-xs" href="?page=<?= $i ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>

                            <?php if ($current_page < $pagination['total_pages']): ?>
                                <li class="page-item">
                                    <a class="page-link bg-gradient-dark text-white" href="?page=<?= $current_page + 1 ?>">
                                        <i class="bi bi-chevron-right fs-6 fw-bolder"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endif; // Kết thúc kiểm tra số trang
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>
