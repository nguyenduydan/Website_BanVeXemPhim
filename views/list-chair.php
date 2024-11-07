<?php include('../includes/header.php');
require_once("../config/function.php");

ob_start();
$isLoggedIn = isset($_SESSION['NDloggedIn']);

?>

<?php
$id_result = check_valid_ID('id');
if (!is_numeric($id_result)) {
    echo '<h5>' . htmlspecialchars($id_result) . '</h5>';
    return false;
}

$item = getByID('SuatChieu', 'MaSuatChieu', $id_result);
if ($item['status'] == 200) {
    $maPhong = $item['data']['MaPhong'];
    global $conn;
    $query = "SELECT * FROM GHE WHERE MaPhong = '$maPhong'";
    $seats = mysqli_query($conn, $query);
?>
    <div id="toast"></div>

    <?php alertMessage() ?>

    <div class="chair my-5 ">
        <div class="container movie-content w-50 shadow">
            <?php
            $film = getByID('Phim', 'MaPhim', $item['data']['MaPhim']);
            $maPhim = $film['data']['MaPhim'];
            ?>
            <h4 class="text-center mb-4 text-uppercase fw-bold">Chọn ghế cho phim:
                <?= htmlspecialchars($film['data']['TenPhim']) ?></h4>
            <div class="type-chair">
                <ul class="d-flex flex-row justify-content-center">
                    <li class="seat vip">Ghế VIP</li>
                    <li class="seat single">Ghế đơn</li>
                    <li class="seat couple">Ghế đôi</li>
                    <li class="seat choosed">Ghế đã chọn</li>
                    <li class="seat selected">Ghế đã đặt</li>
                </ul>
            </div>
            <div class="room px-5">
                <div class="d-flex justify-content-center flex-column">
                    <div class="tv mx-5"></div>
                    <span class="text-center text-secondary">Màn hình</span>
                </div>

                <div class="list-chair mt-5">
                    <ul class="container-fluid d-flex flex-column">
                        <?php
                        $currentRow = '';
                        foreach ($seats as $seat) {
                            $rowLetter = substr($seat['TenGhe'], 0, 1);
                            $seatNumber = substr($seat['TenGhe'], 1);

                            if ($rowLetter != $currentRow) {
                                if ($currentRow != '') {
                                    echo '</div><div class="col-1 fw-bold text-secondary">' . $currentRow . '</div></li>';
                                }
                                $currentRow = $rowLetter;
                                echo '<li class="d-flex mb-2 text-center"><div class="col-1 fw-bold text-secondary">' . $currentRow . '</div><div class="list col-10 text-center justify-content-center m-auto">';
                            }

                            $seatClass = strtolower($seat['LoaiGhe']) == 'Đơn' ? 'single' : (strtolower($seat['LoaiGhe']) == 'Vip' ? 'vip' : 'couple');

                            if ($seatClass == 'couple') {
                                // Ghép đôi các số ghế thành cặp (1-2, 3-4, ...)
                                if ($seatNumber % 2 != 0) {
                                    $seatNumberPair = htmlspecialchars($seatNumber) . '-' . htmlspecialchars($seatNumber + 1);
                                    echo '<button class="mx-1 ' . $seatClass . ' rounded seat-button" data-row="' . $rowLetter . '" onclick="toggleSeatSelection(this)"><span>' . $seatNumberPair . '</span></button>';
                                }
                            } else {
                                // Hiển thị một số trong một ô cho các loại ghế khác
                                echo '<button class="mx-1 ' . $seatClass . ' rounded seat-button" data-row="' . $rowLetter . '" onclick="toggleSeatSelection(this)"><span>' . htmlspecialchars($seatNumber) . '</span></button>';
                            }
                        }
                        if ($currentRow != '') {
                            echo '</div><div class="col-1 fw-bold text-secondary">' . $currentRow . '</div></li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div>
                <form id="paymentForm" class="text-center" action="ticket.php" method="POST">
                    <input type="hidden" name="seatsInput" id="seatsInput">
                    <button type="button" id="paymentButton" onclick="handlePayment()">Thanh toán</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function toggleSeatSelection(button) {
            button.classList.toggle('choosed');
        }

        function handlePayment() {
            const selectedSeats = document.querySelectorAll('.choosed');
            const selectedSeatNumbers = Array.from(selectedSeats).map(seat => {
                const rowLetter = seat.getAttribute('data-row');
                const seatNumber = seat.textContent.trim();
                if (rowLetter && seatNumber) {
                    return rowLetter + seatNumber;
                }
                return null;
            }).filter(seat => seat);

            if (selectedSeatNumbers.length === 0) {
                <?php $_SESSION['error'] = 'Bạn chưa chọn chỗ ngồi kìa >.<'; ?>
                return;
            }
            const isLoggedIn = <?= json_encode($isLoggedIn) ?>;
            if (!isLoggedIn) {
                <?php $_SESSION['error'] = 'Đăng nhập trước khi mua vé'; ?>
                window.location.href = '../login.php';
                return;
            }
            const dataArray = {
                MaGhe: selectedSeatNumbers.join(','),
                MaPhim: <?= json_encode($maPhim) ?>,
                MaPhong: <?= json_encode($maPhong) ?>,
                MaSuatChieu: <?= json_encode($id_result) ?>
            };
            document.getElementById('seatsInput').value = JSON.stringify(dataArray);
            document.getElementById('paymentForm').submit();
        }
    </script>

<?php
} else {
    echo '<h5>' . htmlspecialchars($item['message']) . '</h5>';
}
?>

<?php include('../includes/footer.php'); ?>
