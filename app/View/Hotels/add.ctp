    <?php
    $type = empty($edit) ? 'Add' : 'Edit';
    	$this->assign('pagetitle', __('%s Hotel',$type));
	$this->Custom->addCrumb(__('Hotels'),array('action'=>'index'));
	$this->Custom->addCrumb(__('%s Hotel',$type));
	$this->start('top_links');
		echo $this->Html->link(__('Back'),array('action'=>'index'),array('icon'=>'fa-angle-double-left','class'=>'btn btn-default','escape'=>false));
	$this->end();
?>
    <div class="box box-primary">
        <div class="overflow-hide-break">
            <?php echo $this->Form->create('Hotel', array('class' => 'form-validate','type'=>'file')); ?>
            <div class="box-body box-content">
                	<?php
		echo $this->Form->input('id',array('type'=>'hidden'));
		echo $this->Form->input('name',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
		echo $this->Form->input('price',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
		echo $this->Form->input('address',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
?><label class="form-group" style="margin-bottom: 10px">Hotel</label><div class="form-group row"><div id='photoId' class='col-md-4'><?php echo $this->Html->image(NO_IMAGE, array('class' => 'thumbnail img-responsive', 'style' => 'max-width: 250px')) ?></div><?php 		echo $this->Form->input('photo', array('required' => false, 'label' => false, 'type' => 'file', 'before' => '<label for="HotelPhoto" class="btn btn-info"><i class="fa fa-upload">&nbsp;</i>' . __('Select Photo') . '</label>', 'after' => '<span id="photo-name" style="margin-left: 15px"></span>', 'class' => 'hidden photo', 'div' => array('class' => 'col-md-10'))) ?><div for='HotelPhoto' generated='true' class='error' style='display: none'><span class="errorDV"> </span></div></div><?php		echo $this->Form->input('type',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
		echo $this->Form->input('meal_plan',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
	?>
            </div>
            <div class="form-action">
                <?php echo $this->Form->submit(__('Save'), array('div' => false,'class' => 'btn btn-primary'));?>
                &nbsp;&nbsp;
                <?php echo $this->Html->link(__('Cancel'), array('action' => 'index'), array('class' => 'btn btn-default'));?>
            </div>
            
			<?php $arrValidation = array(
		'Rules' => array(
'name' => array('required' => 1),
			 'price' => array('required' => 1),
			 'address' => array('required' => 1),
			 'photo' => array('required' => 1),
			 'type' => array('required' => 1),
			 'meal_plan' => array('required' => 1),

		),
					 'Messages' => array(
'name' => array('required' => __('Please enter Name')),
			 'price' => array('required' => __('Please enter Price')),
			 'address' => array('required' => __('Please enter Address')),
			 'photo' => array('required' => __('Please enter Photo')),
			 'type' => array('required' => __('Please enter Type')),
			 'meal_plan' => array('required' => __('Please enter Meal Plan')),));



 echo $this->Form->setValidation($arrValidation); ?>

            <?php echo $this->Form->end(); ?>
        </div>
    </div>
