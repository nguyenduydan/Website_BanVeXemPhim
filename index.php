<?php
include('includes/header.php');

?>

<?php include('includes/slider.php'); ?>

<div id="toast"></div>

<?php alertMessage(); ?>

<div class="container mx-10 py-3 content vh-100">
    <?php include('views/list-film.php'); ?>
    <?php include('views/list-content.php'); ?>
</div>

<?php include('includes/footer.php'); ?>