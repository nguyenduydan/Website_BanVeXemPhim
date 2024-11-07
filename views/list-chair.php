<?php include('../includes/header.php');

?>

<div class="chair">
    <div class="container movie-content">
        <h4 class="text-center mb-4 text-uppercase fw-bold">Chọn ghế</h4>

        <div class="type-chair">
            <ul class=" d-flex flex-row justify-content-center">
                <li class="seat vip">Ghế vip</li>
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
            <?php
            require_once("../config/function.php");
            // SQL query to fetch seat data
            $query = "SELECT MaGhe, TenGhe, SoLuong, MaPhong, LoaiGhe, GiaGhe FROM Ghe";
            $result = $conn->query($query);

            // Start output
            if ($result->num_rows > 0) {
                echo '<div class="list-chair mt-5">';
                echo '<ul class="container-fluid d-flex flex-column">';

                // Initialize an array to group seats by row
                $seatsByRow = [];

                // Fetch data and group by row (assuming TenGhe indicates the row)
                while ($row = $result->fetch_assoc()) {
                    $seatsByRow[$row['TenGhe']][] = $row; // Group seats by row name
                }

                // Loop through each row
                foreach ($seatsByRow as $rowName => $seats) {
                    echo '<li class="d-flex mb-2 text-center">';
                    echo '<div class="col-1 fw-bold text-secondary">' . htmlspecialchars($rowName) . '</div>';
                    echo '<div class="list col-10 text-center justify-content-center m-auto">';

                    // Loop through seats in this row
                    foreach ($seats as $seat) {
                        // Create multiple buttons based on SoLuong
                        for ($i = 1; $i <= $seat['SoLuong']; $i++) { // Start from 1
                            // Assuming LoaiGhe differentiates seat types (e.g., normal, couple)
                            if ($seat['LoaiGhe'] === 'Đôi') {
                                // Create a single button for couple seats
                                echo '<button class="mx-1 couple border-1 rounded"><span class="me-2">' . htmlspecialchars($i) . '</span><span>' . htmlspecialchars($i + 1) . '</span></button>';
                            } else {
                                // Create multiple buttons based on SoLuong for regular seats
                                for ($i = 1; $i <= $seat['SoLuong']; $i++) {
                                    echo '<button class="mx-1 rounded border-1">' . htmlspecialchars($i) . '</button>'; // Use $i as the label
                                }
                            }
                        }
                    }

                    echo '</div>';
                    echo '<div class="col-1 fw-bold text-secondary">' . htmlspecialchars($rowName) . '</div>';
                    echo '</li>';
                }

                echo '</ul>';
                echo '</div>';
            } else {
                echo '<p>Không có ghế nào trong phòng này.</p>';
            }
            ?>
            <!-- <div class="list-chair mt-5">
            <ul class="container-fluid d-flex flex-column">
                <li class="d-flex mb-2 text-center">
                    <div class="col-1 fw-bold text-secondary">A</div>
                    <div class="list col-10 text-center justify-content-center m-auto">
                        <button class="mx-1 couple border-1 rounded"><span class="me-2">1</span><span>1</span></button>
                        <button class="mx-1 couple border-1 rounded"><span class="me-2">1</span><span>1</span></button>
                        <button class="mx-1 rounded border-1">1</button>
                        <button class="mx-1 rounded border-1">1</button>
                        <button class="mx-1 rounded border-1">1</button>
                    </div>
                    <div class="col-1 fw-bold text-secondary">A</div>
                </li>
                <li class="d-flex mb-2 text-center">
                    <div class="col-1 fw-bold text-secondary">A</div>
                    <div class="list col-10 text-center justify-content-center m-auto">
                        <button class="mx-1 couple border-1 rounded"><span class="me-2">1</span><span>1</span></button>
                        <button class="mx-1 couple border-1 rounded"><span class="me-2">1</span><span>1</span></button>
                        <button class="mx-1 rounded border-1">1</button>
                        <button class="mx-1 rounded border-1">1</button>
                        <button class="mx-1 rounded border-1">1</button>
                    </div>
                    <div class="col-1 fw-bold text-secondary">A</div>
                </li>
                <li class="d-flex mb-2 text-center">
                    <div class="col-1 fw-bold text-secondary">A</div>
                    <div class="list col-10 text-center justify-content-center m-auto">
                        <button class="mx-1 couple border-1 rounded"><span class="me-2">1</span><span>1</span></button>
                        <button class="mx-1 couple border-1 rounded"><span class="me-2">1</span><span>1</span></button>
                        <button class="mx-1 rounded border-1">1</button>
                        <button class="mx-1 rounded border-1">1</button>
                        <button class="mx-1 rounded border-1">1</button>
                    </div>
                    <div class="col-1 fw-bold text-secondary">A</div>
                </li>
            </ul>
        </div> -->
        </div>
    </div>
</div>


<?php include('../includes/footer.php');

?>
