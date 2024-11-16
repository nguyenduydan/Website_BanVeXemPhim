<?php
require '../config/function.php'; // Bao gồm các hàm chức năng từ file function.php
include('includes/header.php'); // Bao gồm phần header của trang

// Kiểm tra người dùng đã đăng nhập chưa, nếu chưa thì chuyển hướng đến trang đăng nhập
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    redirect('sign-in.php', 'error', 'Vui lòng đăng nhập'); // Chuyển hướng đến trang đăng nhập nếu chưa đăng nhập
}
if (isset($_SESSION['EmployedIn']) && $_SESSION['EmployedIn'] == true) {
    redirect('index.php', 'error', 'Bạn không phải admin!', 'admin');
}
// Lấy chuỗi tìm kiếm từ GET request và loại bỏ khoảng trắng thừa
$searchString = isset($_GET['searchString']) ? trim($_GET['searchString']) : '';

// Lấy số bản ghi muốn hiển thị mỗi trang từ POST request, mặc định là 5
$records_per_page = isset($_POST['records_per_page']) ? (int)$_POST['records_per_page'] : 5;

// Lấy số trang hiện tại từ GET request, mặc định là trang 1
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Thiết lập phân trang với tìm kiếm
$pagination = setupPagination($conn, 'TaiKhoan', $records_per_page, $searchString, 'TenDangNhap');
$data = $pagination['data']; // Dữ liệu của các thể loại
$records_per_page = $pagination['records_per_page']; // Số bản ghi trên mỗi trang
?>

<div id="toast"></div>

<?php alertMessage() ?>
<!-- Hiển thị thông báo lỗi hoặc thành công từ session -->

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center pb-0">
                <h5><?php echo $title ?></h5> <!-- Hiển thị tiêu đề của trang -->
                <!-- Form để chọn số bản ghi hiển thị mỗi trang -->
                <form method="POST" class="d-inline">
                    <label for="records_per_page" class="me-2 fs-6">Chọn hiển thị số bản ghi:</label>
                    <select name="records_per_page" id="records_per_page" class="form-select"
                        onchange="this.form.submit()">
                        <!-- Các lựa chọn số lượng bản ghi trên mỗi trang -->
                        <option value="2" <?= $records_per_page == 2 ? 'selected' : '' ?>>2</option>
                        <option value="5" <?= $records_per_page == 5 ? 'selected' : '' ?>>5</option>
                        <option value="10" <?= $records_per_page == 10 ? 'selected' : '' ?>>10</option>
                        <option value="20" <?= $records_per_page == 20 ? 'selected' : '' ?>>20</option>
                    </select>
                </form>

                <!-- Form tìm kiếm thể loại -->
                <div class="col-3">
                    <form class="mb-3 mb-lg-0 me-3 input-group w-100 flex-nowrap" role="search" method="GET" action="#">
                        <button type="submit" class="bg-transparent p-0 border-0">
                            <span class="input-group-text bg-dark text-white border" style="cursor: pointer;">
                                <i class="bi bi-search"></i> <!-- Biểu tượng tìm kiếm -->
                            </span>
                        </button>
                        <input type="search" name="searchString" class="form-control ps-2" placeholder="Search..."
                            aria-label="Search" value="<?= htmlspecialchars($searchString) ?>">
                        <!-- Ô nhập từ khóa tìm kiếm -->
                        <input type="hidden" name="page" value="<?= $current_page ?>"> <!-- Ẩn trang hiện tại -->
                    </form>
                </div>
            </div>

            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0 ">
                    <table class="table table-striped table-borderless align-items-center mb-0">
                        <thead>
                            <tr>
                                <!-- Các tiêu đề của bảng -->
                                <th class="text-center text-uppercase text-xs font-weight-bolder">STT</th>
                                <th class="text-center text-uppercase text-xs font-weight-bolder">Tên đăng nhập</th>
                                <th class="text-center text-uppercase text-xs font-weight-bolder">Quyền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $stt = 0;
                            if (!empty($data)) {
                                foreach ($data as $item) {
                                    $stt++; // Đếm số thứ tự
                            ?>
                            <tr>
                                <th class="text-center text-xs font-weight-bolder"><?= $stt ?></th> <!-- Số thứ tự -->
                                <th class="text-center text-xs font-weight-bolder"><?= $item['TenDangNhap']; ?></th>
                                <!-- Tên quyền -->
                                <?php
                                        $roles = [
                                            1 => 'Admin',
                                            0 => 'Người dùng',
                                            2 => 'Nhân viên'
                                        ];
                                        $role = $roles[$item['Quyen']] ?: 'Không xác định';
                                        ?>
                                <th class="text-center text-xs font-weight-bolder"><?= $role; ?></th>
                                <td class="align-middle text-center text-sm">
                                    <!-- Nút chỉnh sửa -->
                                    <a class="btn btn-info m-0"
                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                        href="views/category/categories-edit.php?id=<?= $item['MaND'] ?>">
                                        <i class="bi bi-pencil"></i> Sửa
                                    </a>
                                    <!-- Nút xóa với modal xác nhận -->
                                    <a class="btn btn-danger m-0 delete-btn" data-id="<?= $item['MaND'] ?>"
                                        data-url="views/account/account-delete.php"
                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                        data-bs-toggle="modal" data-bs-target="#confirmModal">
                                        <i class="bi bi-trash"></i> Xoá
                                    </a>
                                    <!-- Modal xác nhận xóa -->
                                    <div class="modal fade" id="confirmModal" tabindex="-1"
                                        aria-labelledby="confirmModalLabel" aria-hidden="true">
                                        <div class="modal-dialog mt-10">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="confirmModalLabel">Xác Nhận Xóa</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p class="p-2 fs-5">Bạn có muốn xóa không?</p>
                                                </div>
                                                <div class="modal-footer d-flex justify-content-center">
                                                    <button type="button" id="confirmYes"
                                                        class="btn btn-sm btn-success">Có</button>
                                                    <button type="button" class="btn btn-sm btn-danger me-2"
                                                        data-bs-dismiss="modal">Không</button>
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
                                <td colspan="8" class="text-center">Không có bản ghi nào</td>
                                <!-- Nếu không có dữ liệu -->
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