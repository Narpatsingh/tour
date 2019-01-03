    <?php
    $type = empty($edit) ? 'Add' : 'Edit';
    	$this->assign('pagetitle', __('%s Flight Detail',$type));
	$this->Custom->addCrumb(__('Flight Details'),array('action'=>'index'));
	$this->Custom->addCrumb(__('%s Flight Detail',$type));
	$this->start('top_links');
		echo $this->Html->link(__('Back'),array('action'=>'index'),array('icon'=>'fa-angle-double-left','class'=>'btn btn-default','escape'=>false));
	$this->end();
?>
    <div class="box box-primary">
        <div class="overflow-hide-break">
            <?php echo $this->Form->create('FlightDetail', array('class' => 'form-validate','type'=>'file')); ?>
            <div class="box-body box-content">
                	<?php
		echo $this->Form->input('id',array('type'=>'hidden'));
		echo $this->Form->input('company_name',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
		echo $this->Form->input('flight_no',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
		echo $this->Form->input('pnr_no',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
		echo $this->Form->input('price',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
	?>
            </div>
            <div class="form-action">
                <?php echo $this->Form->submit(__('Save'), array('div' => false,'class' => 'btn btn-primary'));?>
                &nbsp;&nbsp;
                <?php echo $this->Html->link(__('Cancel'), array('action' => 'index'), array('class' => 'btn btn-default'));?>
            </div>
            
			<?php $arrValidation = array(
		'Rules' => array(
'company_name' => array('required' => 1),
			 'flight_no' => array('required' => 1),
			 'pnr_no' => array('required' => 1),
			 'price' => array('required' => 1),

		),
					 'Messages' => array(
'company_name' => array('required' => __('Please enter Company Name.')),
			 'flight_no' => array('required' => __('Please enter Flight No.')),
			 'pnr_no' => array('required' => __('Please enter Pnr No.')),
			 'price' => array('required' => __('Please enter Price.')),));



 echo $this->Form->setValidation($arrValidation); ?>

            <?php echo $this->Form->end(); ?>
        </div>
    </div>
