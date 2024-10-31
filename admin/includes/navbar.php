<style>
    @import url('https://fonts.googleapis.com/css2?family=Black+Ops+One&family=Iceberg&family=Keania+One&family=Rampart+One&display=swap');

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
        background-color: #fff;
        max-height: 200px;
        margin-top: 0.5rem;
        overflow-y: auto;
        z-index: 1000;
        width: 90%;
        border: 0.2px solid #17ad37;
        border-radius: 10px;
        display: none;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
    }

    #results a {
        padding: 5px 15px;
        font-weight: 900;
        border: none;
    }


    .result-item {
        padding: 10px;

        border-bottom: 1px solid #ddd;
        text-decoration: none;
        color: #17ad37;
        display: block;
        width: 100%;
        transition: ease-in-out .05s;
    }

    /* Thêm viền và hiệu ứng khi di chuột qua vùng kết quả */
    #results .result-item:hover {
        background-image: linear-gradient(310deg, #98ec2d 0%, #17ad37 100%);
        color: #fff;
    }

    #clock {
        border-radius: 30px;
        border: 5px solid snow;
        box-shadow:
            0px 4px 6px rgba(0, 0, 0, 0.2),
            -2px 5px 0px rgba(0, 0, 0, 0.2);
        font-family: "Iceberg", sans-serif;
        pointer-events: none;
    }

    #avatar-container {
        width: 60px;
        height: 60px;
        padding: 4px;
        margin-left: 5px;
        background: linear-gradient(45deg, #7928ca, #ff0080);
        display: inline-block;
        box-shadow:
            0px 4px 6px rgba(0, 0, 0, 0.2);
    }

    #avatar {
        width: 100%;
        height: 100%;
        display: block;
        border: 1px solid snow;
    }
</style>

<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none sticky-top" style="background-color: #f8f9fa;">
    <div class="container-fluid py-1 px-3">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
            aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="d-none d-lg-block">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm">
                    <a class="opacity-5 text-dark" id="dashboard" href="../index.php">Dashboard</a>
                </li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">
                    <?php echo htmlspecialchars($title); ?>
                </li>
            </ol>
        </nav>

        <!-- Navbar Collapse -->
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <!-- Clock and Search only on large screens -->
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <div id="clock" class="fs-4 fw-bold me-5 bg-gradient-info text-white p-2 d-none d-lg-block">
                    <!-- Clock content -->
                </div>
                <div class="input-group d-none d-lg-flex">
                    <span class="input-group-text border"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" id="searchBox" placeholder="Tìm kiếm..."
                        onkeyup="searchData()">
                    <div id="results"></div>
                </div>
            </div>

            <!-- Welcome Message and Avatar -->
            <div class="ms-3 d-flex align-items-center">
                <small for="username" class="d-none d-lg-inline">Welcome,
                    <span class="fs-5 text-info text-gradient fw-bolder">username</span>
                </small>
                <div id="avatar-container" class="rounded-circle">
                    <img id="avatar" src="/Website_BanVeXemPhim/uploads/avatars/christmas-9095.gif"
                        class="rounded-circle" alt="Avatar">
                </div>
            </div>

            <!-- External Links and Sidenav Icon -->

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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        function updateClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');

            $('#clock').text(`${hours}:${minutes}:${seconds}`);
        }

        // Cập nhật đồng hồ ngay lập tức
        updateClock();
        // Cập nhật đồng hồ mỗi giây
        setInterval(updateClock, 1000);
    });
</script>
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
