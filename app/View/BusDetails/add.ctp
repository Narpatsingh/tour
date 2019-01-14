<?php
    $type = empty($edit) ? 'Add' : 'Edit';
    	$this->assign('pagetitle', __('%s Bus Detail',$type));
	$this->Custom->addCrumb(__('Bus Details'),array('action'=>'index'));
	$this->Custom->addCrumb(__('%s Bus Detail',$type));
	$this->start('top_links');
		echo $this->Html->link(__('Back'),array('action'=>'index'),array('icon'=>'fa-angle-double-left','class'=>'btn btn-default','escape'=>false));
	$this->end();
?>
    <div class="box box-primary">
        <div class="overflow-hide-break">
            <?php echo $this->Form->create('BusDetail', array('class' => 'form-validate','type'=>'file')); ?>
            <div class="box-body box-content">
                	<?php
		echo $this->Form->input('id',array('type'=>'hidden'));
		echo $this->Form->input('customer_id',array('class' => 'form-control','empty' => 'Select Customer', 'div' => array('class' => 'form-group')));		
		echo $this->Form->input('booking_type',array('class' => 'form-control','options' => array('single'=>'Single','whole'=>'Whole'),'empty' => 'Select Type', 'div' => array('class' => 'form-group')));		
		echo "<div id='BusDetailMemberDiv'>";
		echo $this->Form->input('member',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
		echo "</div>";
		echo $this->Form->input('company_name',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
		echo $this->Form->input('bus_no',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
		echo $this->Form->input('city_name',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
		echo $this->Form->input('price',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
		echo $this->Form->input('pnr_no',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
		echo $this->Form->input('source',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
		echo $this->Form->input('destination',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
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
						 'bus_no' => array('required' => 1),
						 'city_name' => array('required' => 1),
						 'price' => array('required' => 1),
						 'pnr_no' => array('required' => 1),

					),
					'Messages' => array(
						 'company_name' => array('required' => __('Please enter Company Name.')),
						 'bus_no' => array('required' => __('Please enter Bus No.')),
						 'city_name' => array('required' => __('Please enter City Name.')),
						 'price' => array('required' => __('Please enter Price.')),
						 'pnr_no' => array('required' => __('Please enter Pnr No.')),));



 echo $this->Form->setValidation($arrValidation); ?>

            <?php echo $this->Form->end(); ?>
        </div>
    </div>
<script type="text/javascript">
	$( document ).ready(function() {
		$("#BusDetailMemberDiv").hide();
		$("#BusDetailBookingType").on('change',function(e) {
			var type = $(this).val();
			if(type=='whole'){
				$("#BusDetailMemberDiv").hide();
			}else{
				$("#BusDetailMemberDiv").show();
			}
		});
	});
</script>