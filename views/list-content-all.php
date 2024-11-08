<?php
$title = 'Góc điện ảnh';
include('../includes/header.php');

?>
<div class="container mt-5 w-75">
    <h4 class="mb-4 text-uppercase ps-3" style="border-left: 4px solid #15036c; ">
        Góc điện ảnh
    </h4>
    <div class="mb-3">
        <?php
        $items = getAll('BaiViet');
        foreach ($items as $key => $item):
        ?>
        <a href="detail-content.php" class="card-link ">
            <div class="hover-zoom d-flex mb-2">
                <?php
                    $anhArray = explode(',', $item['Anh']);

                    // Kiểm tra xem mảng có ít nhất một phần tử hay không
                    if (!empty($anhArray[0])) {
                        $anh = trim($anhArray[0]); // Lấy ảnh đầu tiên
                        echo '<img src="../uploads/content-imgs/' . htmlspecialchars($anh) . '" alt="Ảnh xem trước"  class="card-img-top w-25 rounded img-fluid"  style="max-width: 100px;"/> ';
                    }
                    ?>
                <div class="card-body ms-3">
                    <h5 class="card-title"><?= $item['TenBV'] ?></h5>
                </div>
            </div>
        </a>
        <?php endforeach; ?>
    </div>
</div>

<?php include('../includes/footer.php'); ?>