<?php
$type = empty($edit) ? 'Add' : 'Edit';
$this->assign('pagetitle', __('%s Car Detail',$type));
$this->Custom->addCrumb(__('Car Details'),array('action'=>'index'));
$this->Custom->addCrumb(__('%s Car Detail',$type));
$this->start('top_links');
echo $this->Html->link(__('Back'),array('action'=>'index'),array('icon'=>'fa-angle-double-left','class'=>'btn btn-default','escape'=>false));
$this->end();
?>
<div class="box box-primary">
	<div class="overflow-hide-break">
		<?php echo $this->Form->create('CarDetail', array('class' => 'form-validate multiple_save' ,'type'=>'file')); ?>
		<div class="box-body box-content">
			<div class="row no-margin">
                <div class="col-md-6">
				<?php
				echo $this->Form->input('id',array('type'=>'hidden'));
				echo $this->Form->input('customer_id',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
				echo $this->Form->input('company_name',array('class' => 'form-control', 'div' => array('class' => 'form-group required')));
				echo $this->Form->input('source',array('class' => 'form-control', 'div' => array('class' => 'form-group required')));
				echo $this->Form->input('destination',array('class' => 'form-control', 'div' => array('class' => 'form-group required'))); 
				echo $this->Form->input('car_no',array('class' => 'form-control','div' => array('class' => 'form-group required'))); ?>
				</div>
				<div class="col-md-6">
				<?php

				echo $this->Form->input('pnr_no',array('class' => 'form-control', 'div' => array('class' => 'form-group required')));
				echo $this->Form->input('price',array('class' => 'form-control', 'div' => array('class' => 'form-group required')));
				echo $this->Form->input('payment_with_gst',array('class' => 'form-control','disabled', 'div' => array('class' => 'form-group')));
				echo $this->Form->input('payment_received',array('class' => 'form-control', 'div' => array('class' => 'form-group required')));
				?>
				</div>
			</div>
		</div>
		<div class="form-action">
			<?php echo $this->Form->submit(__('Save'), array('div' => false,'class' => 'btn btn-primary btn_dsbl'));?>
			&nbsp;&nbsp;
			<?php echo $this->Html->link(__('Cancel'), array('action' => 'index'), array('class' => 'btn btn-default'));?>
		</div>

		<?php $arrValidation = array(
			'Rules' => array(
				'customer_id' => array('required' => 1),
				'company_name' => array('required' => 1,'alphabates'=> true),
				'car_no' => array('required' => 1),
				'pnr_no' => array('required' => 1),
				'price' => array('required' => 1),
				'source' => array('required' => 1,'alphabates'=> true),
				'destination' => array('required' => 1,'alphabates'=> true),
				'payment_received' => array('required' => 1),

			),
			'Messages' => array(
				'customer_id' => array('required' => __('Please select Customer')),
				'company_name' => array('required' => __('Please enter Company Name')),
				'car_no' => array('required' => __('Please enter Car No')),
				'pnr_no' => array('required' => __('Please enter Pnr No')),
				'price' => array('required' => __('Please enter Price')),
				'source' => array('required' => __('Please enter Source')),
				'payment_received' => array('required' => __('Please enter Payment Received.')),
				'destination' => array('required' => __('Please enter Destination')),));
		
		echo $this->Form->setValidation($arrValidation); ?>

		<?php echo $this->Form->end(); ?>
	</div>
</div>

<script type="text/javascript">
	var gst = '<?php echo $config_gst; ?>';
    jQuery(document).ready(function () { 
    	$( document ).on('keyup','#CarDetailPrice', function(e) {
			var amount = parseInt($(this).val());
			var payment_with_gst = parseInt((amount * gst) / 100);
			var total_payment = (amount + payment_with_gst);
			$('#CarDetailPaymentWithGst').val(total_payment);
		});
    });
</script>
