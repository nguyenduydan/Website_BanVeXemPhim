<?php
include('../includes/header.php');
include_once('../config/function.php');

$id_result = check_valid_ID('id');
if (!is_numeric($id_result)) {
    echo '<h5 class="text-danger text-center">' . htmlspecialchars($id_result) . '</h5>';
    return false;
}

$item = getByID('BaiViet', 'Id', $id_result);
if ($item['status'] == 200) {
?>
<div class="container mb-4">
    <a href="http://localhost/Website_BanVeXemPhim/views/list-content-all.php" class="btn btn-dark mb-3 mt-5">
        <i class="bi bi-arrow-left"></i> Trở về
    </a>
    <div class="row flex-nowrap mt-0">
        <div class="col-9">
            <div class="text-center my-4">
                <!-- Tiêu đề bài viết -->
                <h2 class="fw-bold mb-4 text-uppercase"><?= htmlspecialchars($item['data']['TenBV']) ?></h2>

                <!-- Hình ảnh chính -->
                <div class="mb-4">
                    <?php
                        $anhArray = explode(',', $item['data']['Anh']);
                        if (!empty($anhArray[0])) {
                            $anh = trim($anhArray[0]); // Lấy ảnh đầu tiên
                            echo '<img src="/Website_BanVeXemPhim/uploads/content-imgs/' . htmlspecialchars($anh) . '" alt="Ảnh xem trước" class="img-fluid w-50 rounded shadow"/>';
                        }
                        ?>
                </div>

                <!-- Nội dung bài viết -->
                <div class="content-area">
                    <h2 class="fw-bold text-left">Nội dung bài viết</h2>
                    <?php
                        // Split the content by paragraph breaks or new lines
                        $paragraphs = explode(PHP_EOL, $item['data']['ChiTiet']);
                        foreach ($paragraphs as $paragraph) {
                            // Trim whitespace and check if paragraph is not empty
                            $trimmedParagraph = trim($paragraph);
                            if (!empty($trimmedParagraph)) {
                                echo '<p class="text-justify">' . nl2br(htmlspecialchars($trimmedParagraph)) . '</p>';
                            }
                        }
                        ?>
                </div>
            </div>
        </div>
        <div class="col-3">
            <h4 class="mb-4 text-uppercase ps-3" style="border-left: 4px solid black;">Phim đang chiếu</h4>
            <?php include("currently-showing.php"); ?>
        </div>
    </div>
</div>
<?php
} else {
    echo '<h5 class="text-danger text-center">' . htmlspecialchars($item['message']) . '</h5>';
}
?>

<?php include('../includes/footer.php'); ?>

<style>
.content-area {
    background-color: #f8f9fa;
    /* Light grey background for content area */
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    text-align: left;
    /* Align text to the left for headings */
}

.small-image {
    max-width: 100%;
    /* Ensures image is responsive */
    height: auto;
    /* Maintains aspect ratio */
}

h1,
h2 {
    margin: 20px 0;
    /* Add vertical spacing to headings */
}

h2 {
    color: #343a40;
    /* Darker color for subheadings */
    font-size: 1.5rem;
    /* Adjust font size for subheading */
}

p {
    line-height: 1.6;
    /* Improve readability with line height */
    margin-bottom: 20px;
    /* Increase spacing below paragraphs for better separation */
    text-align: justify;
    /* Justify text for both sides alignment */
}
</style>
