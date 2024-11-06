<?php
header('Content-Type: application/json'); // Đặt header để trả về JSON

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy giá trị selected_date từ AJAX
    $selected_date = $_POST['selected_date'];

    // Mô phỏng dữ liệu ví dụ
    $showtimes = [];

    // Ví dụ dữ liệu cho các ngày khác nhau
    if ($selected_date === '06/11/2024') {
        $showtimes = [
            [
                "id" => 1,
                "date" => "2024-11-06",
                "start_time" => "12:30",
                "end_time" => "14:00"
            ],
            [
                "id" => 2,
                "date" => "2024-11-06",
                "start_time" => "14:00",
                "end_time" => "15:30"
            ]
        ];
    } elseif ($selected_date === '07/11/2024') {
        $showtimes = [
            [
                "id" => 3,
                "date" => "2024-11-07",
                "start_time" => "13:00",
                "end_time" => "14:30"
            ],
            [
                "id" => 4,
                "date" => "2024-11-07",
                "start_time" => "16:00",
                "end_time" => "17:30"
            ]
        ];
    } else {
        // Trả về mảng trống nếu không có giờ chiếu cho ngày đã cho
        $showtimes = [];
    }

    // Trả về dữ liệu dưới dạng JSON
    echo json_encode($showtimes);
} else {
    echo json_encode(['error' => 'Invalid request']);
}
