<?php if ($footer == 'true'): ?>
    <module type="layouts" template="footers/skin-4" id="footer-layout" template-filter="footers" />
<?php endif; ?>

</div>

<button id="to-top" class="btn btn-primary btn-square" style="display: block;"><i class="mdi mdi-arrow-up mdi-18px lh-1 m-0"></i></button>

<?php include('footer_cart.php'); ?>


<?php $collaplseNav_file = normalize_path( mw_includes_path().'api/libs/collapse-nav/dist/collapseNav.js',false);   ?>
<?php if(is_file($collaplseNav_file)){ ?>
    <script>
        // collapse nav
        <?php print  @file_get_contents($collaplseNav_file) ?>
    </script>
<?php } ?>


<?php $collaplseNav_file = normalize_path( mw_includes_path().'api/libs/collapse-nav/dist/collapseNav.css',false);   ?>
<?php if(is_file($collaplseNav_file)){ ?>
    <style>
        // collapse nav
        <?php print  @file_get_contents($collaplseNav_file) ?>
    </style>
<?php } ?>
</body>
</html>
