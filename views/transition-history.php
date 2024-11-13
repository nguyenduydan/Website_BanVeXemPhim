 <table class="table table-striped table-hover">
     <thead>
         <tr class="text-center">
             <th>STT</th>
             <th>Ngày giao dịch</th>
             <th>Hóa đơn</th>
             <th>Số tiền</th>
         </tr>
     </thead>
     <tbody>
         <?php
            if (isset($transactions) && count($transactions) > 0) {
                foreach ($transactions as $index => $transaction) {
                    echo "<tr>";
                    echo "<td>" . ($index + 1) . "</td>";
                    echo "<td>" . htmlspecialchars($transaction['date']) . "</td>";
                    echo "<td>" . htmlspecialchars($transaction['movie_name']) . "</td>";
                    echo "<td>" . number_format($transaction['amount'], 0, ',', '.') . " VND</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4' class='text-center'>Chưa có giao dịch nào.</td></tr>";
            }
            ?>
     </tbody>
 </table>