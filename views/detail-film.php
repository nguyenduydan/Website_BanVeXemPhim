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
</style>
<div class="banner bg-black">
    <div class="banner-overlay">
        <img src="../uploads/slider-imgs/slide_1.jpg" alt="Venom: Kèo Cuối" class="banner-image">
    </div>
</div>

<div class="container px-5 w-75">
    <div class="row">
        <div class="col-lg-8">
            <div class="row flex-nowrap">
                <!-- Phần ảnh phim -->
                <div class="col-lg-5">
                    <img src="../uploads/film-imgs/anhphim.jpg" alt="Thiên Đường Quả Báo"
                        class="img-fluid movie-poster rounded"
                        style="border: 2px solid #fff;transform: translateY(-60px);">
                </div>
                <!-- Thông tin chi tiết phim -->
                <div class="col-lg-7 ms-3">
                    <div class="d-flex align-items-center mb-2 mt-5">
                        <h2 class="movie-title-detail me-3">Thiên Đường Quả Báo</h2>
                        <span class="movie-age-detail">T18</span>
                    </div>
                    <div class="movie-meta">
                        <span class="me-3 text-black"><i class="bi bi-clock text-warning"></i> 131 Phút</span>
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

        <div class="col-lg-4 mt-5">
            <h4 class="mb-4 text-uppercase ps-3" style="border-left: 4px solid black;">
                Phim đang chiếu
            </h4>
            <div class="">
                <img src="../uploads/film-imgs/anhphim.jpg" alt="Thiên Đường Quả Báo"
                    class="img-fluid movie-poster rounded">
            </div>
        </div>

    </div>


</div>

<?php include('../includes/footer.php'); ?>