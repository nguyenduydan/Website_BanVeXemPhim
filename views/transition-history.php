 <table class="table table-striped table-hover">
     <thead>
         <tr class="text-center">
             <th>STT</th>
             <th>Ngày mua</th>
             <th>Tên phim</th>
             <th>Tổng tiền</th>
         </tr>
     </thead>
     <tbody>
        <?php
        $list_bill = getBillByUserIdd($NDId);

        if (!empty($list_bill)) {
            foreach ($list_bill as $index => $bill) {
                echo "<tr>";
                echo "<td class='text-center'>" . ($index + 1) . "</td>";
                echo "<td class='text-center'>" . htmlspecialchars($bill['NgayLapHD']) . "</td>"; // Hiển thị ngày mua
                echo "<td class='text-center'>" . htmlspecialchars($bill['TenPhim']) . "</td>"; // Hiển thị tên phim
                echo "<td class='text-center'>" . number_format($bill['TongTien'], 0, ',', '.') . " VND</td>"; // Hiển thị tổng tiền
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4' class='text-center'>Chưa có giao dịch nào.</td></tr>";
        }
        ?>
     </tbody>
 </table>