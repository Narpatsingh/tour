<?php
$type = empty($edit) ? 'Add' : 'Edit';
if(empty($voucher)){
    $title =  __(' Car Detail');
    $this->Custom->addCrumb(__($title),array('action'=>'index'));
}else{
    $title =  __(' Car Detail Voucher');
    $this->Custom->addCrumb(__($title),array('action'=>'index','voucher'));    
}
$this->assign('pagetitle', __($type.$title));
$this->Custom->addCrumb(__($type.$title));
$this->start('top_links');
if(empty($voucher)){
    echo $this->Html->link(__('Back'),array('action'=>'index'),array('icon'=>'fa-angle-double-left','class'=>'btn btn-default','escape'=>false));
}else{
    echo $this->Html->link(__('Back'),array('action'=>'index','voucher'),array('icon'=>'fa-angle-double-left','class'=>'btn btn-default','escape'=>false));    
}
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
				echo $this->Form->input('customer_id',array('class' => 'form-control','empty' => 'Select Customer', 'div' => array('class' => 'form-group')));
				echo $this->Form->input('company_name',array('class' => 'form-control', 'div' => array('class' => 'form-group required')));
				echo $this->Form->input('total_members',array('class' => 'form-control', 'div' => array('class' => 'form-group required')));
    			echo $this->Form->input('state_id',array('class' => 'form-control','empty' => __('Select State'), 'div' => array('class' => 'form-group required')));
                echo $this->Form->input('city_id',array('class' => 'form-control','empty' => __('Select City'), 'div' => array('class' => 'form-group required')));
				echo $this->Form->input('source',array('class' => 'form-control', 'div' => array('class' => 'form-group required')));
                echo $this->Form->input('pick_up_date',array('class' => 'form-control','type' => 'text','div' => array('class' => 'form-group required')));
				echo $this->Form->input('car_type',array('class' => 'form-control','div' => array('class' => 'form-group required'))); 
				echo $this->Form->input('special_remark',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
				?>
				</div>
				<div class="col-md-6">
				<?php
                echo $this->Form->input('nights',array('class' => 'form-control','div' => array('class' => 'form-group required')));
				echo $this->Form->input('car_no',array('class' => 'form-control','div' => array('class' => 'form-group'))); 
				echo $this->Form->input('pnr_no',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
				echo $this->Form->input('price',array('class' => 'form-control', 'div' => array('class' => 'form-group required')));
				echo $this->Form->input('payment_with_gst',array('class' => 'form-control','disabled', 'div' => array('class' => 'form-group')));
				echo $this->Form->input('destination',array('class' => 'form-control', 'div' => array('class' => 'form-group required'))); 
                echo $this->Form->input('drop_date',array('class' => 'form-control','type' => 'text','div' => array('class' => 'form-group required')));
				echo $this->Form->input('payment_type',array('options'=>array('cash'=>'Cash', 'cheque'=> 'Cheque', 'net_banking' => 'Net Banking' ), 'empty'=>'Select Payment Type', 'class' => 'form-control', 'div' => array('class' => 'form-group required')));
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
				'city_id' => array('required' => 1),
				'state_id' => array('required' => 1),				
				'pick_up_date' => array('required' => 1),				
				'drop_date' => array('required' => 1),				
				//'car_no' => array('required' => 1),
				'car_type' => array('required' => 1),
				//'pnr_no' => array('required' => 1),
				'total_members' => array('required' => 1),
				'price' => array('required' => 1),
				'payment_type' => array('required' => 1),
				'source' => array('required' => 1,'alphabates'=> true),
				'destination' => array('required' => 1,'alphabates'=> true),
				'payment_received' => array('required' => 1),

			),
			'Messages' => array(
				'customer_id' => array('required' => __('Please select Customer')),
				'payment_type' => array('required' => __('Please select Payment Type')),
				'company_name' => array('required' => __('Please enter Company Name')),
				'city_id' => array('required' => __('Please select City.')),
				'state_id' => array('required' => __('Please select State.')),
				'pick_up_date' => array('required' => __('Please select pick up date.')),
				'drop_date' => array('required' => __('Please select drop date.')),
				'nights' => array('required' => __('Please enter nights count.')),				
				//'car_no' => array('required' => __('Please enter Car No')),
				'car_type' => array('required' => __('Please enter Car Type')),
				//'pnr_no' => array('required' => __('Please enter Pnr No')),
				'total_members' => array('required' => __('Please enter Total Members')),
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

	    $("#CarDetailStateId").on('change',function() {
	        var id = $(this).val();
	        jQuery.ajax({
	            url: BaseUrl + 'citys/get_city/' + id,
	            type: 'post',
	            dataType: 'json',
	            success: function (html) {
	                $("#CarDetailCityId option").remove();
	                $('#CarDetailCityId').append($("<option></option>").attr("value","").text("Select City"));
	                $.each(html, function(key, value) {
	                    $('<option>').val('').text('select');
	                    $('<option>').val(key).text(value).appendTo($("#CarDetailCityId"));
	                });
	            },
	            error: function (e) {

	            }
	        });
	    });		

        $('#CarDetailPickUpDate').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true
        });
        $('#CarDetailDropDate').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true
        });        	    
    });
</script>
