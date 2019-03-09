    <?php
    $type = empty($edit) ? 'Add' : 'Edit';
    	$this->assign('pagetitle', __('%s Contact',$type));
	$this->Custom->addCrumb(__('Contacts'),array('action'=>'index'));
	$this->Custom->addCrumb(__('%s Contact',$type));
	$this->start('top_links');
		echo $this->Html->link(__('Back'),array('action'=>'index'),array('icon'=>'fa-angle-double-left','class'=>'btn btn-default','escape'=>false));
	$this->end();
?>
    <div class="box box-primary">
        <div class="overflow-hide-break">
            <?php echo $this->Form->create('Contact', array('class' => 'form-validate multiple_save','type'=>'file')); ?>
            <div class="box-body box-content">
                	<?php
		echo $this->Form->input('id',array('type'=>'hidden'));
		echo $this->Form->input('name',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
		echo $this->Form->input('email',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
		echo $this->Form->input('message',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
	?>
            </div>
            <div class="form-action">
                <?php echo $this->Form->submit(__('Save'), array('div' => false,'class' => 'btn btn-primary btn_dsbl'));?>
                &nbsp;&nbsp;
                <?php echo $this->Html->link(__('Cancel'), array('action' => 'index'), array('class' => 'btn btn-default'));?>
            </div>
            
			<?php $arrValidation = array(
		'Rules' => array(
'name' => array('required' => 1),
			 'email' => array('required' => 1),
			 'message' => array('required' => 1),

		),
					 'Messages' => array(
'name' => array('required' => __('Please enter Name')),
			 'email' => array('required' => __('Please enter Email')),
			 'message' => array('required' => __('Please enter Message')),));



 echo $this->Form->setValidation($arrValidation); ?>

            <?php echo $this->Form->end(); ?>
        </div>
    </div>
