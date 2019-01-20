<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <?php echo $this->Html->meta('mg/flight.png', 'img/flight.png', array('type' => 'icon')); ?>
    <title>
        <?php echo 'Silshine Trip - '.strip_tags($this->fetch('pagetitle')) ; ?>
    </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <?php
    echo $this->Html->css(
        array(
            'backend/style.css?'.time(),
            'backend/bootstrap-toggle.min',
            'backend/bootstrap-multiselect'
        ), array('inline' => false)
    );

    echo $this->Html->script(
        array(
            'backend/jquery-2.1.0.min',
            'backend/bootstrap.min',
            'backend/app',
            'lib/jquery.validate',
            'lib/moment',
            'lib/bootstrap-datepicker',
            'backend/custom.js?'.time(),
            'backend/jquery-custom-validation',
            'lib/bootstrap-toggle.min',
            'lib/jquery.cookie',
            'lib/inputmask/inputmask',
            'lib/inputmask/jquery.inputmask',
            'backend/jquery-custom-validation',
            'backend/bootstrap-multiselect',
        ), array('inline' => false)
    );
    echo $this->fetch('css');
    echo $this->fetch('script');

    ?>
    <script type="text/javascript">
        var BaseUrl = '<?php echo $this->Html->url('/', true) ?>';
        jQuery(document).ready(function () {
            jQuery('.sidebar-toggle').on('click', function () {
                if (jQuery('.sidebar-offcanvas').hasClass('collapse-left')) {
                    $.cookie('sidebar', 1, {path: '/'});
                } else {
                    $.cookie('sidebar', 0, {path: '/'});
                    $.removeCookie('sidebar', {path: '/'});
                }
            });
            <?php if(!empty($dashboard)){?>         
                jQuery(".content-header").remove();
                jQuery(".content-crumb ").remove();
                jQuery('.sidebar-offcanvas').addClass('collapse-left')
                jQuery('.right-side').addClass('strech')
            <?php }?>
        });

    </script>
</head>
<body class="wysihtml5-supported  pace-done skin-blue">
<div id="ajaxLoader" class="hidden">
            <span>
                <i class="fa fa-spin fa-spinner"></i>
                <?php echo __('Please wait...') ?>
            </span>
</div>
<?php
$sideBarCheck = isset($_COOKIE['sidebar']) ? $_COOKIE['sidebar'] : 0;
?>
<?php echo $this->element('backend/header') ?>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php echo $this->element('backend/admin_left') ?>
    <aside class="right-side <?php echo !empty($sideBarCheck) ? 'strech' : '' ?>">
        <section class="content-header custom_content_header">
            <h1 class="pageTitleH1"><?php echo $this->fetch('pagetitle'); ?></h1>

            <div class="top-links custom_top_links">
                <?php echo $this->fetch('top_links'); ?>
            </div>
            <div class="clearfix"></div>
        </section>
        <section class="content-crumb">
        <?php echo $this->Custom->getCrumbs('', array(
            'text' => '<i class="fa fa-home"></i> Home',
            'url' => array('controller' => 'users', 'action' => 'dashboard')
        )); ?>
        </section>
        <section class="content content-breadcrumb">
            <?php echo $this->Session->flash(); ?>
            <?php echo $this->fetch('content'); ?>
        </section>
    </aside>
</div>
<div class="modal fade commonModel" id="commonModel" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" id="appendModelContent"></div>
    </div>
</div>

<?php echo $this->element('sql_dump'); ?>
</body>
</html>
