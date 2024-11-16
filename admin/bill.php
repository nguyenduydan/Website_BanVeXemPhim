<?php
require '../config/function.php';
include('includes/header.php');

// Kiểm tra xem người dùng đã đăng nhập chưa, nếu chưa thì chuyển hướng đến trang đăng nhập
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    redirect('sign-in.php', 'error', 'Vui lòng đăng nhập');
}
if (isset($_SESSION['EmployedIn']) && $_SESSION['EmployedIn'] === true) {
    redirect('index.php', 'error', 'Bạn không phải admin!', 'admin');
}
$searchString = isset($_GET['searchString']) ? trim($_GET['searchString']) : '';

// Lấy số bản ghi muốn hiển thị mỗi trang từ POST request, mặc định là 5
$records_per_page = isset($_POST['records_per_page']) ? (int)$_POST['records_per_page'] : 5;

// Lấy số trang hiện tại từ GET request, mặc định là trang 1
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Thiết lập phân trang với tìm kiếm
$pagination = setupPagination($conn, 'hoadon', $records_per_page, $searchString, 'MaHD');
$data = $pagination['data']; // Dữ liệu của các hóa đơn
$records_per_page = $pagination['records_per_page']; // Số bản ghi trên mỗi trang
?>

<div id="toast"></div>

<?php alertMessage() ?>

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center pb-0">
                <h5><?php echo $title ?></h5>
                <!-- Form chọn số lượng bản ghi hiển thị trên mỗi trang -->
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
                <div class="col-3">
                    <form class="mb-3 mb-lg-0 me-3 input-group w-100 flex-nowrap" role="search" method="GET" action="#">
                        <button type="submit" class="bg-transparent p-0 border-0">
                            <span class="input-group-text bg-dark text-white border" style="cursor: pointer;">
                                <i class="bi bi-search"></i> <!-- Biểu tượng tìm kiếm -->
                            </span>
                        </button>
                        <input type="search" name="searchString" class="form-control ps-2" placeholder="Search..."
                            aria-label="Search" value="<?= htmlspecialchars($searchString) ?>">
                        <input type="hidden" name="page" value="<?= $current_page ?>"> <!-- Ẩn trang hiện tại -->
                    </form>
                </div>
                <!-- Nút Thêm hóa đơn mới -->
                <a href="views/invoice/invoice-add.php" class="btn btn-lg me-5 btn-add"
                    style="--bs-btn-padding-y: .5rem; --bs-btn-padding-x: 20px; --bs-btn-font-size: 1.25rem;">
                    <i class="bi bi-plus me-1 fs-3" style="margin-bottom: 5px;"></i>
                    Thêm
                </a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <!-- Bảng hiển thị danh sách hóa đơn -->
                    <table class="table table-striped table-borderless align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-xs font-weight-bolder">STT</th>
                                <th class="text-center text-uppercase text-xs font-weight-bolder">Mã Hóa Đơn</th>
                                <th class="text-center text-uppercase text-xs font-weight-bolder">Khách Hàng</th>
                                <th class="text-center text-uppercase text-xs font-weight-bolder">Ngày Lập</th>
                                <th class="text-center text-uppercase text-xs font-weight-bolder">Tổng Tiền</th>
                                <th class="text-center text-uppercase text-xs font-weight-bolder">Trạng Thái</th>
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
                                <th class="text-center text-xs font-weight-bolder"><?= $item['MaHD']; ?></th>
                                <th class="text-center text-xs font-weight-bolder"><?= $item['KhachHang']; ?></th>
                                <th class="text-center text-xs font-weight-bolder"><?= $item['NgayLap']; ?></th>
                                <th class="text-center text-xs font-weight-bolder">
                                    <?= number_format($item['TongTien'], 0, ',', '.') . ' VNĐ'; ?></th>
                                <th class="text-center text-xs font-weight-bolder"><?= $item['TrangThai']; ?></th>
                                <td class="align-middle text-center text-sm">
                                    <a class="btn btn-secondary m-0"
                                        href="views/bill/bill-detail.php?= $item['MaHD'] ?>"
                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                        <i class="bi bi-info-circle"></i> Chi tiết
                                    </a>
                                    <!-- Modal xác nhận xóa hóa đơn -->
                                </td>
                            </tr>
                            <?php
                                }
                            } else {
                                ?>
                            <!-- Thông báo khi không có bản ghi nào -->
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
            <!-- Phân trang -->
            <div class="card-footer">
                <?php echo paginate_html($pagination['total_pages'], $pagination['current_page']); ?>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>