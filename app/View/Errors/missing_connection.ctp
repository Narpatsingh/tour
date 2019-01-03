<?php 
    $this->assign('pagetitle', $message);
    $this->Custom->addCrumb(__('Error'));

?>
<div class="error-page">
    <div class="error-content">
        <h3><i class="fa fa-warning text-yellow"></i> <?php echo __('Oops! Page not found.')?></h3>
        <p>
            <strong><?php echo __d('cake', 'Error'); ?>: </strong>
            <?php echo __d('cake', 'An Internal Error Has Occurred.'); ?>
        </p>
    </div>
</div>
<?php
if (Configure::read('debug') > 0):
	echo $this->element('exception_stack_trace');
endif;
?>
