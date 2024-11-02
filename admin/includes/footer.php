<!-- Footer -->

<footer class="footer py-3">
    <div class="container-fluid">
        <div class="align-items-center justify-content-lg-bottom">
            <div class="col-lg mb-lg-0 mb-4">
                <div class="copyright text-center text-sm text-muted text-lg-center">
                    © <script>
                        document.write(new Date().getFullYear())
                    </script>,
                    made with <i class="fa fa-heart"></i> by
                    <a href="https://github.com/nguyenduydan/Website_BanVeXemPhim" class="font-weight-bold"
                        target="_blank">Creative FogVN, Dino, Fate</a>
                </div>
            </div>
        </div>
    </div>
</footer>
</div>
</main>

<script src="<?php echo $baseURL; ?>assets/js/core/popper.min.js"></script>
<script src="<?php echo $baseURL; ?>assets/js/core/bootstrap.min.js"></script>
<script src="<?php echo $baseURL; ?>assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="<?php echo $baseURL; ?>assets/js/plugins/smooth-scrollbar.min.js"></script>
<script src="<?php echo $baseURL; ?>assets/js/plugins/chartjs.min.js"></script>

<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>

<script async defer src="https://buttons.github.io/buttons.js"></script>
<script src="<?php echo $baseURL; ?>assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
</body>

</html>
