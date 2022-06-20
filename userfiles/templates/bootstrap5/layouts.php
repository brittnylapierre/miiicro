 
<?php include template_dir() . "header.php"; ?>
<div class="main-content" data-layout-container>
    <?php
    $module_layouts = module_templates('layouts');
	 
    foreach ($module_layouts as $module) {
        if (strpos($module['layout_file'], 'content/') !== false OR strpos($module['layout_file'], 'header/') !== false OR strpos($module['layout_file'], 'features/') !== false OR strpos($module['layout_file'], 'team/') !== false OR strpos($module['layout_file'], 'testimonials/') !== false OR strpos($module['layout_file'], 'gallery/') !== false OR strpos($module['layout_file'], 'call-to-action/') !== false OR strpos($module['layout_file'], 'contacts/') !== false) {
            //print '<module type="layouts"  template="' . ($module['layout_file']) . '" id="mod-' . md5($module['name']) . '" />';
        } else {
            //print '<module type="layouts"  template="' . ($module['layout_file']) . '" id="mod-' . md5($module['name']) . '" />';
        }
            print '<module type="layouts"  template="' . ($module['layout_file']) . '" id="mod-' . md5($module['name']) . '" />';

        if (strpos($module['layout_file'], 'ecommerce/') !== false) {
           // print '<module type="layouts"  template="' . ($module['layout_file']) . '" id="mod-' . md5($module['name']) . '" />';
        }

        if (strpos($module['layout_file'], 'features/') !== false) {
            //print '<module type="layouts"  template="' . ($module['layout_file']) . '" id="mod-' . md5($module['name']) . '" />';
        }

        if (strpos($module['layout_file'], 'content/') !== false) {
            //print '<module type="layouts"  template="' . ($module['layout_file']) . '" id="mod-' . md5($module['name']) . '" />';
        }
    }
    ?>
</div>
<?php /*
<div class="main-content edit" rel="module" field="content">
    <module type="layouts" template="home-banners/skin-1"/>
    <module type="layouts" template="pricing/skin-1"/>
    <module type="layouts" template="cta/skin-2"/>
</div>*/ ?>

<?php include template_dir() . "footer.php"; ?>
