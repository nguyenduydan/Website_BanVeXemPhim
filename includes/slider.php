<?php
require_once 'config/function.php';
?>
<style>
.carousel-item {
    height: 28rem !important;
    width: 100% !important;
}
</style>
<?php
$items = getHeaderSliders($conn); // Lấy các slider có vị trí là header
?>

<div class="d-lg-flex d-sm-flex d-none justify-content-center bg-black">
    <div id="carousel" class="carousel slide w-sm-100 w-md-100 w-lg-75" data-bs-ride="carousel" data-bs-touch="true">
        <div class="carousel-indicators">
            <?php foreach ($items as $index => $item): ?>
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="<?= $index ?>"
                class="<?= $index === 0 ? 'active' : '' ?>" aria-current="<?= $index === 0 ? 'true' : 'false' ?>"
                aria-label="Slide <?= $index + 1 ?>"></button>
            <?php endforeach; ?>
        </div>
        <div class="carousel-inner border-radius-2xl">
            <?php foreach ($items as $index => $item): ?>
            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>" data-bs-interval="5000">
                <a class="link" href="<?= htmlspecialchars($item['URL']) ?>" target="_blank">
                    <!-- Thêm target="_blank" nếu bạn muốn mở trong tab mới -->
                    <img src="uploads/slider-imgs/<?= htmlspecialchars($item['Anh']) ?>" class="d-block w-100 h-100"
                        alt="<?= htmlspecialchars($item['TenSlider']) ?>">
                </a>
            </div>
            <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>