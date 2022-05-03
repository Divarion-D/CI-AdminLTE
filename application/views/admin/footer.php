<footer class="main-footer">
        <div class="pull-right hidden-xs">
                <b><?php echo trans('footer_version'); ?></b> Development
        </div>
        <strong><?php echo trans('footer_copyright'); ?> &copy; 2021-<?php echo date('Y'); ?> <a href="http://almsaeedstudio.com" target="_blank">Almsaeed Studio</a> &amp; <a href="https://github.com/Divarion-D" target="_blank">Divarion-D</a>.</strong> <?php echo trans('footer_all_rights_reserved'); ?>.
</footer>
</div>

<script src="<?php echo base_url('assets/frameworks/jquery/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/frameworks/bootstrap/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/frameworks/bootstrap-switch/js/bootstrap-switch.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/slimscroll/slimscroll.min.js'); ?>"></script>
<?php if ($mobile == TRUE) : ?>
        <script src="<?php echo base_url('assets/plugins/fastclick/fastclick.min.js'); ?>"></script>
<?php endif; ?>
<?php if ($this->router->fetch_class() == 'users' && ($this->router->fetch_method() == 'create' or $this->router->fetch_method() == 'edit')) : ?>
        <script src="<?php echo base_url('assets/plugins/pwstrength/pwstrength.min.js'); ?>"></script>
<?php endif; ?>
<?php if ($this->router->fetch_class() == 'groups' && ($this->router->fetch_method() == 'create' or $this->router->fetch_method() == 'edit')) : ?>
        <script src="<?php echo base_url('assets/plugins/tinycolor/tinycolor.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/plugins/colorpickersliders/colorpickersliders.min.js'); ?>"></script>
<?php endif; ?>
<script src="<?php echo base_url('assets/frameworks/adminlte/js/adminlte.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/frameworks/domprojects/js/dp.min.js'); ?>"></script>
<script>
        $(function() {
                $("input[data-bootstrap-switch]").each(function() {
                        $(this).bootstrapSwitch('state', $(this).prop('checked'));
                })
        })
</script>
</body>

</html>