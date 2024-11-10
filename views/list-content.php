<div class="container mt-5 w-75">
    <h4 class="mb-4 text-uppercase ps-3" style="border-left: 4px solid #15036c;">
        Góc điện ảnh
    </h4>
    <div class="row">
        <?php
        // Lấy tất cả các bài viết
        $result = getAll('BaiViet');

        // Kiểm tra nếu có ít nhất một bài viết
        if ($result && $result->num_rows > 0) {
            // Lấy bài viết đầu tiên
            $firstItem = $result->fetch_assoc();
        ?>

        <!-- Bài viết lớn bên trái -->
        <div class="col-lg-7">
            <a href="views/detail-content.php?id=<?= $firstItem['Id'] ?>" class="card-link">
                <div class="hover-zoom">
                    <?php
                        $anhArray = explode(',', $firstItem['Anh']);
                        if (!empty($anhArray[0])) {
                            $anh = trim($anhArray[0]);
                            echo '<img id="img-content-top" src="/Website_BanVeXemPhim/uploads/content-imgs/' . htmlspecialchars($anh) . '" class=" rounded" alt="Article image">';
                        }
                        ?>
                    <div class="card-body mt-3">
                        <h5 class="card-title"><?= htmlspecialchars($firstItem['TenBV']) ?></h5>
                    </div>
                </div>
            </a>
        </div>

        <!-- Các bài viết nhỏ bên phải -->
        <div class="col-lg-5 mb-3">
            <?php
                // Đặt bộ đếm cho bài viết
                $count = 0;

                // Duyệt qua các bài viết còn lại và chỉ hiển thị tối đa 3 bài viết
                while ($item = $result->fetch_assoc()) {
                    if ($count >= 3) break; // Ngừng vòng lặp sau khi hiển thị 3 bài viết

                    // Kiểm tra xem $item có hợp lệ không trước khi truy cập vào các phần tử
                    if ($item) {
                ?>
            <a href="views/detail-content.php?id=<?= $item['Id'] ?>" class="card-link">
                <div class="hover-zoom d-flex mb-2">
                    <?php
                                $anhArray = explode(',', $item['Anh']);
                                if (!empty($anhArray[0])) {
                                    $anh = trim($anhArray[0]);
                                    echo '<img src="/Website_BanVeXemPhim/uploads/content-imgs/' . htmlspecialchars($anh) . '" class="card-img-top w-50 rounded" alt="Article image">';
                                }
                                ?>
                    <div class="card-body ms-3">
                        <h5 class="card-title"><?= htmlspecialchars($item['TenBV']) ?></h5>
                    </div>
                </div>
            </a>
            <?php
                        $count++; // Tăng bộ đếm sau mỗi bài viết
                    }
                }
                ?>
        </div>
        <?php } ?>
    </div>

    <!-- Nút xem thêm -->
    <div class="text-center mt-4">
        <a href="views/list-content-all.php" type="button" class="btn btn-outline-primary">Xem thêm</a>
    </div>
</div>