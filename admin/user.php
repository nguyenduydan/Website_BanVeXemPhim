<?php include($_SERVER['DOCUMENT_ROOT'] . '/Website_BanVeXemPhim/admin/includes/header.php'); ?>

<!-- Hiển thị nội dung danh sách phim -->
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center pb-0">
                <h5><?php echo $title ?></h5>
                <a href="../admin/film-add.php" class="btn btn-lg me-5 btn-add" style="--bs-btn-padding-y: .5rem; --bs-btn-padding-x: 20px; --bs-btn-font-size: 1.25rem;">Thêm</a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">

                    </table>
                </div>
            </div>
            <div class="card-footer">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <li class="page-item"><a class="page-link bg-dark text-light font-weight-bold" href="#">Trước</a></li>
                        <li class="page-item active" aria-current="page"><a class="page-link mx-1" href="#">1</a></li>
                        <li class="page-item"><a class="page-link mx-1" href="#">2</a></li>
                        <li class="page-item"><a class="page-link mx-1" href="#">3</a></li>
                        <li class="page-item"><a class="page-link bg-dark text-light font-weight-bold" href="#">Tiếp</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>


<?php include($_SERVER['DOCUMENT_ROOT'] . '/Website_BanVeXemPhim/admin/includes/footer.php');
?>
