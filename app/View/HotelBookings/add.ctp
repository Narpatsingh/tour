<?php
$type = empty($edit) ? 'Add' : 'Edit';
$this->assign('pagetitle', __('%s Hotel Booking',$type));
$this->Custom->addCrumb(__('Hotel Bookings'),array('action'=>'index'));
$this->Custom->addCrumb(__('%s Hotel Booking',$type));
$this->start('top_links');
echo $this->Html->link(__('Back'),array('action'=>'index'),array('icon'=>'fa-angle-double-left','class'=>'btn btn-default','escape'=>false));
$this->end();
?>
<div class="box box-primary">
	<div class="overflow-hide-break">
		<?php echo $this->Form->create('HotelBooking', array('class' => 'form-validate multiple_save','type'=>'file')); ?>
		<div class="box-body box-content">
            <div class="row no-margin">
                <div class="col-md-6">
    			<?php
    			echo $this->Form->input('id',array('type'=>'hidden'));
    			echo $this->Form->input('state_id',array('class' => 'form-control','empty' => __('Select State'), 'div' => array('class' => 'form-group required')));
                echo $this->Form->input('city_id',array('class' => 'form-control','empty' => __('Select City'), 'div' => array('class' => 'form-group required')));
    			echo $this->Form->input('hotel_id',array('class' => 'form-control', 'empty' => __('Select Hotel'),'div' => array('class' => 'form-group')));
    			echo $this->Form->input('customer_id',array('class' => 'form-control', 'div' => array('class' => 'form-group required'))); 
                echo $this->Form->input('room_type',array('class' => 'form-control', 'div' => array('class' => 'form-group required'))); 
                echo $this->Form->input('nights',array('class' => 'form-control','div' => array('class' => 'form-group required'))); ?>
                </div>
                <div class="col-md-6">
                <?php
                echo $this->Form->input('meal_type',array('class' => 'form-control', 'div' => array('class' => 'form-group required')));
    			echo $this->Form->input('price',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
                echo $this->Form->input('payment_with_gst',array('class' => 'form-control','disabled', 'div' => array('class' => 'form-group')));
                echo $this->Form->input('payment_received',array('class' => 'form-control', 'div' => array('class' => 'form-group required')));
                echo $this->Form->input('check_in_date',array('type'=>'text','class' => 'form-control', 'div' => array('class' => 'form-group')));
                echo $this->Form->input('check_out_date',array('type'=>'text','class' => 'form-control', 'div' => array('class' => 'form-group')));    			
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
				'city_id' => array('required' => 1),
				'state_id' => array('required' => 1),
				'hotel_id' => array('required' => 1),
				'customer_id' => array('required' => 1),
				'price' => array('required' => 1),
                'room_type' => array('required' => 1),
                'meal_type' => array('required' => 1),
                'payment_received' => array('required' => 1),
                'nights' => array('required' => 1,'number' => 1),
                'check_in_date' => array('required' => 1),
                'check_out_date' => array('required' => 1),

			),
			'Messages' => array(
				'city_id' => array('required' => __('Please enter City.')),
				'state_id' => array('required' => __('Please enter State.')),
				'hotel_id' => array('required' => __('Please enter Hotel.')),
				'customer_id' => array('required' => __('Please enter Customer.')),
                'payment_received' => array('required' => __('Please enter Payment Received.')),
				'price' => array('required' => __('Please enter Price.')),
                'meal_type' => array('required' => __('Please enter Meal Type.')),
                'nights' => array('required' => __('Please enter nights count.')),
                'check_in_date' => array('required' => __('Please enter Check In Date')),
                'check_out_date' => array('required' => __('Please enter Check Out Date')),                
                'room_type' => array('required' => __('Please enter Room Type.')),));
			echo $this->Form->setValidation($arrValidation); ?>

		<?php echo $this->Form->end(); ?>
	</div>
</div>
<script type="text/javascript">
    $("#HotelBookingStateId").on('change',function() {
        var id = $(this).val();
        jQuery.ajax({
            url: BaseUrl + 'citys/get_city/' + id,
            type: 'post',
            dataType: 'json',
            success: function (html) {
                $("#HotelBookingCityId option").remove();
                $('#HotelBookingCityId').append($("<option></option>").attr("value","").text("Select City"));
                $.each(html, function(key, value) {
                    $('<option>').val('').text('select');
                    $('<option>').val(key).text(value).appendTo($("#HotelBookingCityId"));
                });
            },
            error: function (e) {

            }
        });
    });

    $("#HotelBookingCityId").on('change',function() {
        var id = $(this).val();
        jQuery.ajax({
            url: BaseUrl + 'hotels/get_hotel/' + id,
            type: 'post',
            dataType: 'json',
            success: function (html) {
                $("#HotelBookingHotelId option").remove();
                $('#HotelBookingHotelId').append($("<option></option>").attr("value","").text("Select Hotel"));
                $.each(html, function(key, value) {
                    $('<option>').val('').text('select');
                    $('<option>').val(key).text(value).appendTo($("#HotelBookingHotelId"));
                });
            },
            error: function (e) {

            }
        });
    });

    var gst = '<?php echo $config_gst; ?>';
    jQuery(document).ready(function () { 
        $( document ).on('keyup','#HotelBookingPrice', function(e) {
            var amount = parseInt($(this).val());
            var payment_with_gst = parseInt((amount * gst) / 100);
            var total_payment = (amount + payment_with_gst);
            $('#HotelBookingPaymentWithGst').val(total_payment);
        });

        $('#HotelBookingCheckInDate').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true
        });
        $('#HotelBookingCheckOutDate').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true
        });        
    });
    
</script>