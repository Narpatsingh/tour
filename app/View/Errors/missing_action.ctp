<?php 
    $this->assign('pagetitle', $message);
    $this->Custom->addCrumb(__('Error'));
?>
<div class="error-page" style='color: white'>
    <div class="error-content">
        <h3><i class="fa fa-warning text-yellow"></i> <?php echo __('Oops! Page not found.')?></h3>
        <p>
            Page Not Found
        </p>
    </div>
	<div style="font-size: 16px" class="text-center">
	<?php echo $this->Html->link(__('Go to Login page'),array('controller' => 'users','action'=>'login'));?>
	</div>
	
</div>

