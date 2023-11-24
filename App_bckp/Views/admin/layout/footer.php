    <footer class="main-footer">
        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.2.0
        </div>
    </footer>

    <aside class="control-sidebar control-sidebar-dark">
    </aside>
</div>

<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="<?= base_url('plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('plugins/chart.js/Chart.min.js') ?>"></script>
<script src="<?= base_url('plugins/sparklines/sparkline.js') ?>"></script>
<script src="<?= base_url('plugins/jqvmap/jquery.vmap.min.js') ?>"></script>
<script src="<?= base_url('plugins/jqvmap/maps/jquery.vmap.usa.js') ?>"></script>
<script src="<?= base_url('plugins/jquery-knob/jquery.knob.min.js') ?>"></script>
<script src="<?= base_url('plugins/moment/moment.min.js') ?>"></script>
<script src="<?= base_url('plugins/daterangepicker/daterangepicker.js') ?>"></script>
<script src="<?= base_url('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') ?>"></script>
<script src="<?= base_url('plugins/summernote/summernote-bs4.min.js') ?>"></script>
<script src="<?= base_url('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') ?>"></script>
<script src="<?= base_url('js/adminlte.js') ?>"></script>
<!-- <script src="<?= base_url('js/pages/dashboard.js') ?>"></script> -->

<script src="<?= base_url('plugins/toastr/toastr.min.js') ?>"></script>
    <?php if (session()->getFlashdata("error")): ?>
        <script>
            toastr.error("<?= session()->getFlashdata("error") ?>")
        </script>
    <?php elseif (session()->getFlashdata("success")): ?>
        <script>
            toastr.success("<?= session()->getFlashdata("success") ?>")
        </script>
    <?php elseif (session()->getFlashdata("errors")): ?>
        <?php foreach (session()->getFlashdata("errors") as $error): ?>
            <script>
                toastr.error("<?= $error ?>")
            </script>
        <?php endforeach ?>
    <?php endif ?>
</body>

</html>