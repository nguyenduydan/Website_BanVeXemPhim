<!-- layout.php -->
<?php include('includes/header.php'); ?>
<?php include('includes/navbar.php'); ?>
<?php include('includes/sidebar.php'); ?>

<div class="content">
    <!-- Đây là phần hiển thị nội dung động của mỗi trang -->
    <?php
    if (isset($view_file)) {
        include($view_file);
    } else {
        echo "<h2>Welcome to the website</h2>";
    }
    ?>
</div>

<?php include('includes/footer.php'); ?>
