<?php
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    redirect('sign-in.php', 'error', 'Vui lòng đăng nhập');
}
?>
<div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <?php
                    $current_year = date('Y');
                    $last_year = $current_year - 1;

                    $current_year_revenue = get_yearly_revenue($current_year);
                    $last_year_revenue = get_yearly_revenue($last_year);

                    $current_year_revenue_json = json_encode($current_year_revenue);
                    $last_year_revenue_json = json_encode($last_year_revenue);

                    //Doanh thu ngày
                    $today = date('Y-m-d');
                    $today_revenue = time_revenue($today, $today);
                    // Lấy 7 ngày gần nhất từ hôm nay
                    $days = [];
                    $revenues = [];
                    for ($i = 0; $i < 7; $i++) {
                        $date = date('Y-m-d', strtotime("-$i days")); // Ngày lùi lại từng ngày
                        $day_month = date('d-m', strtotime($date)); // Lấy ngày và tháng (d-m)
                        $revenue = time_revenue($date, $date); // Giả sử đây là hàm tính doanh thu theo ngày
                        $days[] = $day_month;
                        $revenues[] = $revenue;
                    }
                    $monthly_revenue = [];
                    // Lặp từ tháng 1 đến tháng 12
                    for ($month = 1; $month <= 12; $month++) {
                        // Tính năm và tháng tương ứng
                        $year = date('Y');
                        $month_str = str_pad($month, 2, '0', STR_PAD_LEFT);
                        $month_date = "$year-$month_str";

                        // Tính ngày đầu và ngày cuối của tháng
                        $month_start = date('Y-m-01', strtotime($month_date));
                        $month_end = date('Y-m-t', strtotime($month_date));

                        // Gọi hàm time_revenue để tính doanh thu cho tháng này
                        $revenue = time_revenue($month_start, $month_end);

                        // Thêm doanh thu vào mảng
                        $monthly_revenue[] = $revenue;
                    }
                    // Chuyển mảng doanh thu này sang định dạng JSON để JavaScript có thể sử dụng
                    $monthly_revenue_json = json_encode($monthly_revenue);


                    // Đảo ngược mảng days và revenues để hiển thị từ ngày cũ đến ngày mới
                    $days = array_reverse($days);
                    $revenues = array_reverse($revenues);

                    //Doanh thu cả rạp
                    $revenue = ticket_revenue();
                    //Tổng số khách hàng
                    $totalCustomers = count_record('nguoidung');
                    $total_bill = count_record('hoadon');
                    ?>

                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Tổng doanh thu (VNĐ)</p>
                            <h5 class="font-weight-bolder mb-0">
                                <?= number_format($revenue, 0, ',', '.') . ' VNĐ'; ?>
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                            <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Doanh thu hôm nay (VNĐ)</p>
                            <h5 class="font-weight-bolder mb-0">
                                <?= number_format($today_revenue, 0, ',', '.') . ' VNĐ'; ?>
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-success shadow text-center border-radius-md">
                            <i class="bi bi-cash-coin text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Tổng số khách hàng</p>
                            <h5 class="font-weight-bolder mb-0">

                                <?= number_format($totalCustomers, 0, ',', '.'); ?>
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-danger shadow text-center border-radius-md">
                            <i class="bi bi-people-fill text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Tổng hóa đơn (Đơn)</p>
                            <h5 class="font-weight-bolder mb-0">
                                <?= number_format($total_bill, 0, ',', '.'); ?>

                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                            <i class="bi bi-receipt-cutoff text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-lg-5 mb-lg-0 mb-4">
        <div class="card z-index-2">
            <div class="card-body p-2">
                <h3 class="ms-2 mt-4 mb-0 text-center mb-3"> Doanh thu theo ngày </h3>
                <div class="bg-gradient-dark border-radius-md py-3 pe-1 mb-3">
                    <div class="chart">
                        <canvas id="chart-bars" class="chart-canvas"
                            style="display: block; box-sizing: border-box; height: 280px; width: 534px;"></canvas>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="card z-index-2">
            <div class="card-header pb-0 ">
                <h3 class="text-center">Xu hướng doanh thu</h3>
                <p class="text-sm mb-0 text-center fst-italic">
                    Năm <span class="fw-bolder text-decoration-underline"><?= $current_year ?></span>
                    ( <span class="text-small"> <?= number_format($current_year_revenue) ?> VNĐ</span> )
                    <i id="arrow-icon" class="fa"></i>
                    <span id="revenue-change"
                        class="font-weight-bold"><?= number_format($percentage_change, 2) . '%'; ?></span> so với
                    năm <span class="fw-bolder text-decoration-underline"><?= $last_year ?></span>
                    ( <span class="text-small"> <?= number_format($last_year_revenue) ?> VNĐ</span> )
                </p>
            </div>
            <div class="card-body p-3">
                <div class="chart">
                    <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Mảng ngày và doanh thu từ PHP
var days = <?php echo json_encode($days); ?>;
var revenues = <?php echo json_encode($revenues); ?>;

// Khởi tạo biểu đồ
var ctx = document.getElementById('chart-bars').getContext('2d');
var chart = new Chart(ctx, {
    type: 'bar', // Chọn loại biểu đồ cột
    data: {
        labels: days, // Gán ngày cho các nhãn trục X
        datasets: [{
            label: 'Doanh thu theo ngày (VNĐ)', // Tiêu đề cho dữ liệu
            data: revenues, // Dữ liệu doanh thu
            tension: 0.4,
            borderWidth: 0,
            borderRadius: 3,
            borderSkipped: false,
            backgroundColor: "#fff",
            maxBarThickness: 20
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false,
            }
        },
        interaction: {
            intersect: false,
            mode: 'index',
        },
        scales: {
            y: {
                grid: {
                    drawBorder: false,
                    display: false,
                    drawOnChartArea: false,
                    drawTicks: false,
                },
                ticks: {
                    suggestedMin: 0,
                    suggestedMax: 500,
                    beginAtZero: true,
                    padding: 15,
                    font: {
                        size: 14,
                        family: "Arial",
                        style: 'normal',
                        lineHeight: 2
                    },
                    color: "#fff"
                },
            },
            x: {
                grid: {
                    drawBorder: false,
                    display: false,
                    drawOnChartArea: false,
                    drawTicks: false
                },
                ticks: {
                    display: true,
                    color: "#fff",
                    font: {
                        size: 14,
                        family: "Arial",
                        style: 'normal',
                        lineHeight: 2
                    },
                },
            },
        },
    },
});

var ctx2 = document.getElementById("chart-line").getContext("2d");

var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);
gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);
gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //dark colors

// Mảng doanh thu theo tháng từ PHP
var monthlyRevenue = <?php echo $monthly_revenue_json; ?>;

// Khởi tạo biểu đồ
new Chart(ctx2, {
    type: "line",
    data: {
        labels: ["Th1", "Th2", "Th3", "Th4", "Th5", "Th6", "Th7", "Th8", "Th9", "Th10", "Th11",
            "Th12"
        ], // Tháng bằng tiếng Việt
        datasets: [{
            label: "Doanh thu hàng tháng (VNĐ)",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 0,
            borderColor: "#cb0c9f", // Màu đường viền
            borderWidth: 3,
            backgroundColor: gradientStroke1,
            fill: true,
            data: monthlyRevenue, // Dữ liệu doanh thu từ PHP
            maxBarThickness: 6
        }],
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false,
            }
        },
        interaction: {
            intersect: false,
            mode: 'index',
        },
        scales: {
            y: {
                grid: {
                    drawBorder: false,
                    display: true,
                    drawOnChartArea: true,
                    drawTicks: false,
                    borderDash: [5, 5]
                },
                ticks: {
                    display: true,
                    padding: 10,
                    color: '#000',
                    font: {
                        size: 13,
                        family: "Arial",
                        style: 'normal',
                        lineHeight: 2
                    },
                }
            },
            x: {
                grid: {
                    drawBorder: false,
                    display: false,
                    drawOnChartArea: false,
                    drawTicks: false,
                    borderDash: [5, 5]
                },
                ticks: {
                    display: true,
                    color: '#000',
                    padding: 20,
                    font: {
                        size: 13,
                        family: "Arial",
                        style: 'normal',
                        lineHeight: 2
                    },
                }
            },
        },
    },
});
let revenueLastYear = <?php echo $last_year_revenue_json; ?>;
let revenueThisYear = <?php echo $current_year_revenue_json; ?>;

let revenueChange = 0;

if (revenueLastYear === 0 && revenueThisYear !== 0) {
    // Nếu doanh thu năm ngoái bằng 0 và năm nay có doanh thu
    revenueChange = 100;
} else if (revenueLastYear !== 0) {
    // Nếu doanh thu năm ngoái khác 0, tính sự thay đổi về doanh thu
    revenueChange = ((revenueThisYear - revenueLastYear) / revenueLastYear) * 100;
}

// Giới hạn sự thay đổi doanh thu từ 1% đến 100%
revenueChange = Math.max(0, Math.min(100, revenueChange));

// Cập nhật giao diện
let revenueChangeElement = document.getElementById("revenue-change");
let arrowIcon = document.getElementById("arrow-icon");

if (revenueChange > 0) {
    revenueChangeElement.textContent = `${revenueChange.toFixed(1)}% nhiều hơn`;
    arrowIcon.classList.remove("text-danger"); // Xóa mũi tên đỏ (giảm)
    arrowIcon.classList.add("text-success"); // Thêm mũi tên xanh (tăng)
    arrowIcon.classList.remove("fa-arrow-down");
    arrowIcon.classList.add("fa-arrow-up");
} else if (revenueChange < 0) {
    revenueChangeElement.textContent = `${Math.abs(revenueChange).toFixed(1)}% ít hơn`;
    arrowIcon.classList.remove("text-success"); // Xóa mũi tên xanh (tăng)
    arrowIcon.classList.add("text-danger"); // Thêm mũi tên đỏ (giảm)
    arrowIcon.classList.remove("fa-arrow-up");
    arrowIcon.classList.add("fa-arrow-down");
} else {
    revenueChangeElement.textContent = "Không thay đổi";
    arrowIcon.classList.remove("text-success", "text-danger");
    arrowIcon.classList.add("fa-close"); // Thêm biểu tượng "đóng" nếu không có thay đổi
}
</script>