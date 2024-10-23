<?php include('includes/header.php'); ?>

<div class="row">
    <div class="col-xl-12 col-lg-12 mx-auto">
        <h2>Chi tiết phim</h2>
        <!-- Nút quay lại nằm sát bên phải -->
        <div class="text-end mb-4">
            <a class="btn btn-secondary" href="javascript:window.history.back(-1);">
                <i class="bi bi-arrow-left-short"></i> Quay lại
            </a>
        </div>

        <!-- Thông tin chi tiết phim -->
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <!-- Cột 1 -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <strong>Mã phim:</strong>
                            <p>PHIM001</p>
                        </div>
                        <div class="mb-3">
                            <strong>Tên phim:</strong>
                            <p>Cuộc Chiến Sinh Tồn</p>
                        </div>
                        <div class="mb-3">
                            <strong>Thời lượng:</strong>
                            <p>120 phút</p>
                        </div>
                        <div class="mb-3">
                            <strong>Quốc gia:</strong>
                            <p>Việt Nam</p>
                        </div>
                        <div class="mb-3">
                            <strong>Đạo diễn:</strong>
                            <p>Nguyễn Văn A</p>
                        </div>
                        <div class="mb-3">
                            <strong>Diễn viên:</strong>
                            <p>Trần Văn B, Lê Thị C, Phạm Văn D</p>
                        </div>
                    </div>

                    <!-- Cột 2 -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <strong>Thể loại:</strong>
                            <p>Hành động, Phiêu lưu</p>
                        </div>
                        <div class="mb-3">
                            <strong>Phân loại:</strong>
                            <p>C13</p>
                        </div>
                        <div class="mb-3">
                            <strong>Mô tả:</strong>
                            <p>Phim nói về cuộc chiến giữa con người và quái vật trong một thế giới hậu tận thế.</p>
                        </div>
                        <div class="mb-3">
                            <strong>Người tạo:</strong>
                            <p>Nguyễn Văn E</p>
                        </div>
                        <div class="mb-3">
                            <strong>Ngày tạo:</strong>
                            <p>01/01/2023</p>
                        </div>
                        <div class="mb-3">
                            <strong>Người cập nhật:</strong>
                            <p>Trần Văn F</p>
                        </div>
                        <div class="mb-3">
                            <strong>Ngày cập nhật:</strong>
                            <p>01/06/2023</p>
                        </div>
                    </div>

                    <!-- Ảnh phim -->
                    <div class="col-md-12 text-center">
                        <img src="../uploads/film-images/sample-movie.jpg" class="img-fluid" alt="Ảnh phim" style="max-width: 300px; max-height: 400px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

