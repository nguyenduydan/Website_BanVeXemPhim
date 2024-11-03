<?php include('../includes/header.php'); ?>
<style>
.banner {
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    height: 550px;
    overflow: hidden;
    padding: 0 10rem;
}

.banner-image {
    width: 100%;
    height: 100%;
    opacity: 0.8;
}

.banner-overlay {
    position: relative;
    height: 100%;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: white;
    background: rgba(0, 0, 0, 0.5);
}

.card .card-movie.hover .buy-ticket {
    display: block;
}
</style>
<div class="banner bg-black">
    <div class="banner-overlay">
        <img src="../uploads/slider-imgs/slide_1.jpg" alt="Venom: Kèo Cuối" class="banner-image">
    </div>
</div>

<div class="container mb-5">
    <div class="row flex-nowrap m-0">
        <div class="col-8">
            <div class="row flex-nowrap">
                <!-- Phần ảnh phim -->
                <div class="col-lg-4">
                    <img src="../uploads/film-imgs/anhphim.jpg" alt="Thiên Đường Quả Báo"
                        class="img-fluid movie-poster rounded"
                        style="border: 2px solid #fff;transform: translateY(-60px);">
                </div>
                <!-- Thông tin chi tiết phim -->
                <div class="col-lg-7 ms-1">
                    <div class="d-flex align-items-center mb-2 mt-5">
                        <h5 class="movie-title-detail me-3">Thiên Đường Quả Báo</h5>
                        <span class="movie-age-detail bg-danger">T18</span>
                    </div>
                    <div class="movie-meta">
                        <span class="me-3 text-black fs-6"><i class="bi bi-clock text-warning"></i> 131 Phút</span>
                        <span class=" text-black"><i class="bi bi-calendar text-warning "></i> 30/10/2024</span>
                    </div>
                    <div class="movie-info mt-3">
                        <p><strong>Quốc gia:</strong> Thái Lan</p>
                        <p><strong>Thể loại:</strong> Hành động - mamma </p>
                        <p><strong>Đạo diễn:</strong> Boss Kuno</p>
                        <p><strong>Diễn viên:</strong> Jeff Satur, Engfa Waraha, Srida Puapimol</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="movie-content mt-5">
                    <h4 class="fw-bold">Nội Dung Phim</h4>
                    <p>Thongkam (Jeff Satur) và Sek (Pongsakorn) làm lụng vất vả, cày ngày cày đêm để xây dựng một mái
                        ấm...
                    </p>
                </div>
            </div>
        </div>
        <div class="col-3 mt-5 ms-3">
            <h4 class="mb-4 text-uppercase ps-3" style="border-left: 4px solid black;">
                Phim đang chiếu
            </h4>
            <div class="card border-0 mb-2" style="width: 350px; height: 280px;object-fit: contain">
                <div class="rounded movie-card w-100 h-100 d-flex justify-content-center"
                    style="object-fit: cover;overflow: hidden;">
                    <img src="../uploads/slider-imgs/slide_2.jpg" loading="lazy" alt="Thiên Đường Quả Báo"
                        style="object-fit:cover;" class="rounded d-flex w-100 h-100 justify-content-center">
                    <a href="" class="buy-ticket">
                        <i class="bi bi-ticket-perforated"></i> Mua Vé
                    </a>

                </div>
                <div class="card-body mt-0">
                    <h6 class="card-title m-0 p-0">Thiên Đường Quả Báo</h6>
                </div>
            </div>
            <div class="card border-0" style="width: 350px; height: 280px;object-fit: contain">
                <div class="rounded movie-card w-100 h-100 d-flex justify-content-center"
                    style="object-fit: cover;overflow: hidden;">
                    <img src="../uploads/slider-imgs/slide_2.jpg" loading="lazy" alt="Thiên Đường Quả Báo"
                        style="object-fit:cover;" class="rounded d-flex w-100 h-100 justify-content-center">
                    <a href="" class="buy-ticket">
                        <i class="bi bi-ticket-perforated"></i> Mua Vé
                    </a>

                </div>
                <div class="card-body mt-0">
                    <h6 class="card-title m-0 p-0">Thiên Đường Quả Báo</h6>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../includes/footer.php'); ?>