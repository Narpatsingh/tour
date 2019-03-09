    <?php
    $type = empty($edit) ? 'Add' : 'Edit';
    	$this->assign('pagetitle', __('%s Gst Parameter',$type));
	$this->Custom->addCrumb(__('Gst Parameters'),array('action'=>'index'));
	$this->Custom->addCrumb(__('%s Gst Parameter',$type));
	$this->start('top_links');
		echo $this->Html->link(__('Back'),array('action'=>'index'),array('icon'=>'fa-angle-double-left','class'=>'btn btn-default','escape'=>false));
	$this->end();
?>
    <div class="box box-primary">
        <div class="overflow-hide-break">
            <?php echo $this->Form->create('GstParameter', array('class' => 'form-validate multiple_save','type'=>'file')); ?>
            <div class="box-body box-content">
                	<?php
		echo $this->Form->input('id',array('type'=>'hidden'));
		//echo $this->Form->input('name',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
        ?>
        <i class="fa fa-<?=(in_array(Inflector::underscore($this->request->data['GstParameter']['name']),array('flight','tour')))?'fighter-jet':Inflector::underscore($this->request->data['GstParameter']['name']);?> fa-4x"></i>
        <h2><?=$this->request->data['GstParameter']['name'];?></h2>
        <?php
		echo $this->Form->input('value',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
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
			 'value' => array('required' => 1),

		),
					 'Messages' => array(
'name' => array('required' => __('Please enter Name')),
			 'value' => array('required' => __('Please enter Value')),));



 echo $this->Form->setValidation($arrValidation); ?>

            <?php echo $this->Form->end(); ?>
        </div>
    </div>
