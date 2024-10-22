<?php
// Lấy đường dẫn URL
$url_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path_parts = explode('/', trim($url_path, '/'));

// Giả sử bạn đang sử dụng tên file để xác định trang
$current_page_name = end($path_parts); // Lấy phần cuối cùng của đường dẫn

$page_names = [
    'index' => 'Dashboard',
    'categories' => 'Categories',
    'categories-add' => 'Categories Add',
    'film' => 'Film',
];

// Ánh xạ trang cha cho từng trang
$parent_pages = [
    'categories' => 'Dashboard', // Trang cha của categories
    'categories-add' => 'categories',
    'film' => 'Categories', // Trang cha của film
];

// Gán tên trang cha nếu có
$parent_title = $parent_pages[$current_page_name] ?? null;
?>

<style>
    #searchBox {
        width: 300px;
        padding: 10px;
        font-size: 16px;

    }

    #results {
        position: absolute;
        top: 100%;
        /* Hiển thị ngay dưới ô tìm kiếm */
        left: 20;
        right: 0;
        background-color: white;
        max-height: 200px;
        overflow-y: auto;
        z-index: 1000;
        width: 90%;
        border: 1px #e293d3 solid;
        box-shadow: 0 5px 7px 1px #707070;
        border-radius: 0 0 10px 10px;
        display: none;
    }

    #results a {
        padding: 5px 15px;
        font-weight: 900;
    }


    .result-item {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        text-decoration: none;
        color: #17ad37;
        display: block;
        width: 100%;
        transition: all ease .15s;
    }

    /* Thêm viền và hiệu ứng khi di chuột qua vùng kết quả */
    #results .result-item:hover {
        background-color: #17ad37;
        color: #fff;
    }
</style>

<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <?php if ($parent_title): ?>
                    <li class="breadcrumb-item text-sm"><a class="text-dark" href="javascript:;"><?php echo htmlspecialchars($parent_title); ?></a></li>
                <?php endif; ?>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><?php echo htmlspecialchars($title); ?></li>
            </ol>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <div class="input-group">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" id="searchBox" placeholder="Type here..." onkeyup="searchData()">
                    <div id="results"></div>
                </div>
            </div>

            <!-- Danh sách liên kết ẩn để JavaScript xử lý -->
            <div id="linkContainer" style="display: none;">
                <a class="nav-link-text" href="https://www.google.com">Google</a>
                <a href="https://www.facebook.com">Facebook</a>
                <a href="https://www.youtube.com">YouTube</a>
                <a href="https://www.twitter.com">Twitter</a>
                <a href="https://www.linkedin.com">LinkedIn</a>
            </div>
            <ul class="navbar-nav justify-content-end">

                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<script>
    function searchData() {
        let query = document.getElementById("searchBox").value.toLowerCase();
        let links = document.querySelectorAll("#linkContainer a");
        let results = document.getElementById("results");

        // Xóa kết quả hiện tại
        results.innerHTML = "";

        if (query.length > 0) {
            // Hiển thị vùng kết quả
            results.style.display = "block";

            // Lọc và hiển thị các thẻ <a> có chứa từ khóa tìm kiếm
            links.forEach(function(link) {
                let linkText = link.textContent.toLowerCase();
                if (linkText.includes(query)) {
                    let resultLink = document.createElement("a");
                    resultLink.href = link.href;
                    resultLink.textContent = link.textContent;
                    resultLink.classList.add("result-item");

                    results.appendChild(resultLink);
                }
            });

            // Nếu không có kết quả phù hợp, ẩn vùng kết quả
            if (results.innerHTML.trim() === "") {
                results.style.display = "none";
            }

        } else {
            // Ẩn vùng kết quả nếu không có dữ liệu tìm kiếm
            results.style.display = "none";
        }
    }
</script>


<!-- End Navbar -->
