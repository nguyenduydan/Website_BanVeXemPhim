 <div class="px-4">
     <div class="d-none d-md-none d-lg-flex flex-column align-items-center w-100">
         <?php
            $items = getFilm('1'); //Nhập trạng thái muốn hiển thị
            $countCurrentlyShowing = count($items);
            foreach ($items as $value => $item): ?>
             <div class="col-11 mb-4 movie-item <?= $value >= 2 ? 'd-none' : '' ?>">
                 <div class="movie-card card">
                     <img class="img-fluid" src="/Website_BanVeXemPhim/uploads/film-imgs/<?= $item['Anh'] ?>"
                         alt="<?= $item['TenPhim'] ?>">
                     <span class="movie-age"><?= $item['PhanLoai'] ?></span>
                     <a href="/Website_BanVeXemPhim/views/detail-film.php?id=<?= $item['MaPhim'] ?>" class="buy-ticket">
                         <i class="bi bi-ticket-perforated"></i> Mua Vé
                     </a>
                 </div>
                 <div class="movie-info">
                     <div class="movie-title"><?= $item['TenPhim'] ?></div>
                 </div>
             </div>
         <?php endforeach; ?>
     </div>
 </div>
