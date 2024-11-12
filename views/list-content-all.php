<?php
$title = 'Góc điện ảnh';
include('../includes/header.php');

?>
<div class="container mt-5">
    <div class="row flex-nowrap g-4 m-0">
        <div class="col-9">
            <h4 class="mb-4 text-uppercase ps-3" style="border-left: 4px solid #15036c; ">
                Góc điện ảnh
            </h4>
            <div class="mb-3 d-flex flex-column">
                <?php
                $items = getAll('BaiViet');
                foreach ($items as $key => $item):
                ?>
                <a href="detail-content.php?id=<?= $item['Id'] ?>" class="card-link ">
                    <div class="hover-zoom d-flex mb-2">
                        <?php
                            $anhArray = explode(',', $item['Anh']);

                            // Kiểm tra xem mảng có ít nhất một phần tử hay không
                            if (!empty($anhArray[0])) {
                                $anh = trim($anhArray[0]); // Lấy ảnh đầu tiên
                                echo '<img src="../uploads/content-imgs/' . htmlspecialchars($anh) . '" alt="Ảnh xem trước" id="img-content"  class="rounded small-image img-fluid"/> ';
                            }
                            ?>

                        <div class="card-body ms-3 mt-4">
                            <h5 class="card-title"><?= $item['TenBV'] ?></h5>
                            <br>
                            <small><?= $item['MoTa'] ?></small>
                        </div>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-3">
            <h4 class="mb-4 text-uppercase ps-3" style="border-left: 4px solid black;">Phim đang chiếu</h4>
            <?php include("currently-showing.php"); ?>
        </div>
    </div>
</div>

<?php include('../includes/footer.php'); ?>
