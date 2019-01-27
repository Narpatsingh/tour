    <?php
    $type = empty($edit) ? 'Add' : 'Edit';
    	$this->assign('pagetitle', __('%s Customer',$type));
	$this->Custom->addCrumb(__('Customers'),array('action'=>'index'));
	$this->Custom->addCrumb(__('%s Customer',$type));
	$this->start('top_links');
		echo $this->Html->link(__('Back'),array('action'=>'index'),array('icon'=>'fa-angle-double-left','class'=>'btn btn-default','escape'=>false));
	$this->end();
?>
    <div class="box box-primary">
        <div class="overflow-hide-break">
            <?php echo $this->Form->create('Customer', array('class' => 'form-validate','type'=>'file')); ?>
            <div class="box-body box-content">
                	<?php
		echo $this->Form->input('id',array('type'=>'hidden'));
		echo $this->Form->input('name',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
		echo $this->Form->input('package_id',array('class' => 'form-control','multiple' => true, 'div' => array('class' => 'form-group')));
		echo $this->Form->input('mobile',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
		echo $this->Form->input('address',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
		echo $this->Form->input('dob',array('type'=>'text', 'label'=>'Date of birth','class' => 'form-control', 'div' => array('class' => 'form-group')));
		echo $this->Form->input('member',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
		echo $this->Form->input('emergency_mobile',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
		echo $this->Form->input('dob_proof',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
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
							'mobile' => array('required' => 1),
							'address' => array('required' => 1),
							'dob' => array('required' => 1),
							'member' => array('required' => 1),
							'emergency_mobile' => array('required' => 1),
							'dob_proof' => array('required' => 1),

						),
						'Messages' => array(
							'name' => array('required' => __('Please enter Name.')),
							'mobile' => array('required' => __('Please enter Mobile.')),
							'address' => array('required' => __('Please enter Address.')),
							'dob' => array('required' => __('Please enter Dob.')),
							'member' => array('required' => __('Please enter Member.')),
							'emergency_mobile' => array('required' => __('Please enter Emergency Mobile.')),
							'dob_proof' => array('required' => __('Please enter Dob Proof.')),));



 echo $this->Form->setValidation($arrValidation); ?>

            <?php echo $this->Form->end(); ?>
        </div>
    </div>
<script type="text/javascript">
  $( function() {
    $( "#CustomerDob" ).datepicker({
            format: "yyyy-mm-dd",
            autoclose: true    	
    });
  });
</script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#CustomerPackageId').multiselect();
	});	
</script>