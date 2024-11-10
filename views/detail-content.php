<?php
include('../includes/header.php');
include_once('../config/function.php');
?>

<?php
$id_result = check_valid_ID('id');
if (!is_numeric($id_result)) {
    echo '<h5>' . $id_result . '</h5>';
    return false;
}
$item = getByID('BaiViet', 'Id', check_valid_ID('id'));
if ($item['status'] == 200) {
?>
<a href="http://localhost/Website_BanVeXemPhim/views/list-content-all.php
"><button class="btn btn-dark ms-5 position-absolute">
        <i class="bi bi-arrow-left"></i> Trở về
    </button></a>

<div class="container mt-5 w-75 text-center mb-4">
    <!-- Tiêu đề bài viết -->
    <h1 class="fw-bold mb-3 text-uppercase"><?= $item['data']['TenBV'] ?></h1>

    <!-- Hình ảnh chính với kích thước nhỏ hơn -->
    <div class="d-flex justify-content-center mb-4">
        <?php
            $anhArray = explode(',', $item['data']['Anh']);

            // Kiểm tra xem mảng có ít nhất một phần tử hay không
            if (!empty($anhArray[0])) {
                $anh = trim($anhArray[0]); // Lấy ảnh đầu tiên
                echo '<img src="/Website_BanVeXemPhim/uploads/content-imgs/' . htmlspecialchars($anh) . '" alt="Ảnh xem trước" id="img-content"  class="small-image img-fluid"/> ';
            }
            ?>
    </div>
    <!-- Nội dung bài viết -->
    <p>
        <?= $item['data']['ChiTiet'] ?>
    </p>
</div>
<?php
} else {
    echo '<h5>' . $user['message'] . '</h5>';
}
?>

<?php include('../includes/footer.php'); ?>