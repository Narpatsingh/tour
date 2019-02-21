<?php
    $type = empty($edit) ? 'Add' : 'Edit';$mem = 1;
    	$this->assign('pagetitle', __('%s Booking',$type));
	$this->Custom->addCrumb(__('Bookings'),array('action'=>'index'));
	$this->Custom->addCrumb(__('%s Booking',$type));
	$this->start('top_links');
		echo $this->Html->link(__('Back'),array('action'=>'index'),array('icon'=>'fa-angle-double-left','class'=>'btn btn-default','escape'=>false));
	$this->end();
	$pcount = empty($this->request->data['Booking']['package_count'])?1:$this->request->data['Booking']['package_count'];
?>
    <div class="box box-primary">
        <div class="overflow-hide-break">
            <?php echo $this->Form->create('Booking', array('class' => 'form-validate','type'=>'file')); ?>
            <div class="box-body box-content">
                	<?php
		echo $this->Form->input('id',array('type'=>'hidden'));
		echo $this->Form->input('customer_full_name',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
		echo $this->Form->input('customer_date_of_birth',array('type'=>'text','class' => 'form-control', 'div' => array('class' => 'form-group')));
		echo $this->Form->input('customer_contact_no',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
		echo $this->Form->input('customer_emergency_contact_no',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
		echo $this->Form->input('customer_email_id',array('type'=>'text','class' => 'form-control', 'div' => array('class' => 'form-group')));
		echo $this->Form->input('car_couch_type',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
		echo $this->Form->input('tour_type',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
		for ($i=2; $i <= $pcount; $i++) { 
		echo $this->Form->input('tour_type'.$i,array('class' => 'form-control', 'div' => array('class' => 'form-group')));	
		}
		echo $this->Form->input('meal_type',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
		for ($i=2; $i <= $pcount; $i++) { 
		echo $this->Form->input('meal_type'.$i,array('class' => 'form-control', 'div' => array('class' => 'form-group')));
		}
		echo $this->Form->input('place_name',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
		for ($i=2; $i <= $pcount; $i++) { 
		echo $this->Form->input('place_name'.$i,array('class' => 'form-control', 'div' => array('class' => 'form-group')));
		}
		echo $this->Form->input('total_payment',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
		for ($i=2; $i <= $pcount; $i++) { 
		echo $this->Form->input('total_payment'.$i,array('class' => 'form-control', 'div' => array('class' => 'form-group')));
		}
		echo $this->Form->input('payment_recieved',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
		echo $this->Form->input('customer_tour_name',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
		for ($i=2; $i <= $pcount; $i++) { 
		echo $this->Form->input('customer_tour_name'.$i,array('class' => 'form-control', 'div' => array('class' => 'form-group')));
		}
     	echo $this->Form->input('customer_tour_date',array('type'=>'text','class' => 'form-control', 'div' => array('class' => 'form-group')));
     	for ($i=2; $i <= $pcount; $i++) { 
     	echo $this->Form->input('customer_tour_date'.$i,array('type'=>'text','class' => 'form-control', 'div' => array('class' => 'form-group')));
		}
		echo $this->Form->input('travel_type',array('options' => array('Bus'=>'Bus','Train'=>'Train','Flight'=>'Flight'),'class' => 'form-control','empty' => 'Select Travel Type', 'div' => array('class' => 'form-group')));
		for ($i=2; $i <= $pcount; $i++) { 
		echo $this->Form->input('travel_type'.$i,array('options' => array('Bus'=>'Bus','Train'=>'Train','Flight'=>'Flight'),'class' => 'form-control','empty' => 'Select Travel Type', 'div' => array('class' => 'form-group')));
		}
		echo $this->Form->input('travel_number',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
		for ($i=2; $i <= $pcount; $i++) { 
		echo $this->Form->input('travel_number'.$i,array('class' => 'form-control', 'div' => array('class' => 'form-group')));
		}
		echo $this->Form->input('travel_date',array('type'=>'text','class' => 'form-control', 'div' => array('class' => 'form-group')));
		for ($i=2; $i <= $pcount; $i++) { 
		echo $this->Form->input('travel_date'.$i,array('type'=>'text','class' => 'form-control', 'div' => array('class' => 'form-group')));
		}
		echo $this->Form->input('travel_pnr_no',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
		for ($i=2; $i <= $pcount; $i++) { 
		echo $this->Form->input('travel_pnr_no'.$i,array('class' => 'form-control', 'div' => array('class' => 'form-group')));
		}
		echo $this->Form->input('return_travel_number',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
		for ($i=2; $i <= $pcount; $i++) { 
		echo $this->Form->input('return_travel_number'.$i,array('class' => 'form-control', 'div' => array('class' => 'form-group')));
		}
		echo $this->Form->input('return_travel_date',array('type'=>'text','class' => 'form-control', 'div' => array('class' => 'form-group')));
		for ($i=2; $i <= $pcount; $i++) { 
		echo $this->Form->input('return_travel_date'.$i,array('type'=>'text','class' => 'form-control', 'div' => array('class' => 'form-group')));
		}
		echo $this->Form->input('return_travel_pnr_no',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
		for ($i=2; $i <= $pcount; $i++) { 
		echo $this->Form->input('return_travel_pnr_no'.$i,array('class' => 'form-control', 'div' => array('class' => 'form-group')));
		}
		echo $this->Form->input('customer_hotel_type',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
		for ($i=2; $i <= $pcount; $i++) { 
		echo $this->Form->input('customer_hotel_type'.$i,array('class' => 'form-control', 'div' => array('class' => 'form-group')));
		}
		echo $this->Form->input('customer_signature',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
		echo $this->Form->input('company_signature',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
		echo $this->Form->input('all_t_and_c',array('type'=>'textarea','class' => 'form-control', 'div' => array('class' => 'form-group')));
		echo $this->Form->input('customer_valid_id_proof',array('class' => 'form-control', 'div' => array('class' => 'form-group'))); ?>
		<label class="form-group" style="margin-bottom: 10px">Valid Id Proof</label><div class="form-group row"><div id='photoId' class='col-md-4'>
<?php   echo $this->Html->image(getPhoto($this->request->data['Booking']['id'],$this->request->data['Booking']['proof_file'],BOOKING_IMAGE, false,true), array('class' => 'thumbnail img-responsive', 'style' => 'max-width: 250px')) ?></div>
<?php 	echo $this->Form->input('proof_file', array('required' => false, 'label' => false, 'type' => 'file', 'before' => '<label for="BookingProofFile" class="btn btn-info"><i class="fa fa-upload">&nbsp;</i>' . __('Select Id-proof file') . '</label>', 'after' => '<span id="photo-name" style="margin-left: 15px"></span>', 'class' => 'hidden photo', 'div' => array('class' => 'col-md-10'))) ?><div for='BookingPhoto' generated='true' class='error' style='display: none'><span class="errorDV"> </span></div></div> 
<?php	echo $this->Form->input('total_tour_member',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
		echo "<div id='guest_members'>";
		if(!empty($this->request->data['Booking']['total_tour_member'])){
			for ($i=0; $i < $this->request->data['Booking']['total_tour_member']; $i++) { 
				echo '<hr>';
				echo "<h6>Member ".$mem++.".</h6>";
				echo $this->Form->input('member_name',array('name'=>'data[GuestMember]['.$i.'][member_name]', 'class' => 'form-control', 'div' => array('class' => 'form-group')));
				echo $this->Form->input('member_age',array('name'=>'data[GuestMember]['.$i.'][member_age]', 'class' => 'form-control', 'div' => array('class' => 'form-group')));
				echo $this->Form->input('member_dob',array('name'=>'data[GuestMember]['.$i.'][member_dob]', 'class' => 'form-control member_dob', 'div' => array('class' => 'form-group')));
				echo $this->Form->input('member_gender',array('name'=>'data[GuestMember]['.$i.'][member_gender]', 'options' => array('male'=>'Male','female'=>'Female'),'class' => 'form-control','empty' => 'Select Gender', 'div' => array('class' => 'form-group')));
				echo $this->Form->input('member_valid_proof',array('name'=>'data[GuestMember]['.$i.'][member_valid_proof]', 'class' => 'form-control', 'div' => array('class' => 'form-group')));
			}
		}
		echo "</div>";
		echo $this->Form->input('generate_receipt',array('type'=>'checkbox'));
?>

            </div>
            <div class="form-action">
                <?php echo $this->Form->submit(__('Save'), array('div' => false,'class' => 'btn btn-primary'));?>
                &nbsp;&nbsp;
                <?php echo $this->Html->link(__('Cancel'), array('action' => 'index'), array('class' => 'btn btn-default'));?>
            </div>
            
			<?php $arrValidation = array(
		'Rules' => array(
'customer_full_name' => array('required' => 1),
			 'customer_date_of_birth' => array('required' => 1),
			 'customer_contact_no' => array('required' => 1),
			 'customer_email_id' => array('required' => 1),
			 'total_tour_member' => array('required' => 1),
			 'tour_type' => array('required' => 1),
			 'member_id' => array('required' => 1),
			 'meal_type' => array('required' => 1),
			 'place_name' => array('required' => 1),
			 'total_payment' => array('required' => 1),
			 'customer_emergency_contact_no' => array('required' => 1),
			 'customer_tour_name' => array('required' => 1),
			 'customer_valid_id_proof' => array('required' => 1),
			 'proof_file' => array('required' => 1),
			 'customer_tour_date' => array('required' => 1),
			 'car_couch_type' => array('required' => 1),
			 'travel_type' => array('required' => 1),
			 'travel_number' => array('required' => 1),
			 'travel_date' => array('required' => 1),
			 'travel_pnr_no' => array('required' => 1),
			 'return_travel_number' => array('required' => 1),
			 'return_travel_date' => array('required' => 1),
			 'return_travel_pnr_no' => array('required' => 1),
			 'customer_hotel_type' => array('required' => 1),
			 'customer_signature' => array('required' => 1),
			 'company_signature' => array('required' => 1),
			 'all_t_and_c' => array('required' => 1),

		),
			'Messages' => array(
'customer_full_name' => array('required' => __('Please enter Customer Full Name')),
			 'customer_date_of_birth' => array('required' => __('Please enter Customer Date Of Birth')),
			 'customer_contact_no' => array('required' => __('Please enter Customer Contact No')),
			 'customer_email_id' => array('required' => __('Please enter Customer Email Id')),
			 'total_tour_member' => array('required' => __('Please enter Total Tour Member')),
			 'tour_type' => array('required' => __('Please enter Tour Type')),
			 'member_id' => array('required' => __('Please enter Member Id')),
			 'meal_type' => array('required' => __('Please enter Meal Type')),
			 'place_name' => array('required' => __('Please enter Place Name')),
			 'total_payment' => array('required' => __('Please enter Total Payment')),
			 'customer_emergency_contact_no' => array('required' => __('Please enter Customer Emergency Contact No')),
			 'customer_tour_name' => array('required' => __('Please enter Customer Tour Name')),
			 'customer_valid_id_proof' => array('required' => __('Please enter Customer Valid Id Proof')),
			 'proof_file' => array('required' => __('Please Select Id proof file')),
			 'customer_tour_date' => array('required' => __('Please enter Customer Tour Date')),
			 'car_couch_type' => array('required' => __('Please enter Car Couch Type')),
			 'travel_type' => array('required' => __('Please enter Travel Type')),
			 'travel_number' => array('required' => __('Please enter Travel Number')),
			 'travel_date' => array('required' => __('Please enter Travel Date')),
			 'travel_pnr_no' => array('required' => __('Please enter Travel Pnr No')),
			 'return_travel_number' => array('required' => __('Please enter Return Travel Number')),
			 'return_travel_date' => array('required' => __('Please enter Return Travel Date')),
			 'return_travel_pnr_no' => array('required' => __('Please enter Return Travel Pnr No')),
			 'customer_hotel_type' => array('required' => __('Please enter Customer Hotel Type')),
			 'customer_signature' => array('required' => __('Please enter Customer Signature')),
			 'company_signature' => array('required' => __('Please enter Company Signature')),
			 'all_t_and_c' => array('required' => __('Please enter All T And C')),));



 echo $this->Form->setValidation($arrValidation); ?>

            <?php echo $this->Form->end(); ?>
        </div>
    </div>
<script type="text/javascript">
	jQuery(document).ready(function () {

        $('.member_dob').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true
        });
        $('#BookingCustomerDateOfBirth').datepicker({
           	format: "yyyy-mm-dd",
            autoclose: true,
            beforeShow: function (input, inst) {
		        setTimeout(function () {
		            inst.dpDiv.css({
		                top: $("#BookingCustomerDateOfBirth").offset().top + 40,
		                left: $("#BookingCustomerDateOfBirth").offset().left
		            });
		        }, 0);
		    },
        });
        $('#BookingCustomerTourDate').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true
        });
        $('#BookingTravelDate').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true
        });
        $('#BookingReturnTravelDate').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true
        });
        $('#BookingCustomerTourDate2').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true
        });
        $('#BookingCustomerTourDate3').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true
        });                
        $('#BookingTravelDate2').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true
        });                
        $('#BookingTravelDate3').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true
        });                
        $('#BookingReturnTravelDate2').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true
        });                
        $('#BookingReturnTravelDate3').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true
        });                
    });    
	jQuery(document).on('change','#BookingTotalTourMember',function (e) {
		var bla = $('#BookingTotalTourMember').val();
		if(bla>50){
			alert('maximum 50 member are allow, please enter a valid value.');	
		}else{
				var mem = 1; var append_guest_members = '';
			for (var i = 0; i < bla; i++) {
				append_guest_members += '<hr>';
				append_guest_members += '<h6>Member '+ mem++ +'.</h6>';
				append_guest_members += '<div class="form-group">';
				append_guest_members += '<label for="BookingMemberName">Member Name</label>';
				append_guest_members += '<input name="data[GuestMember]['+i+'][member_name]" class="form-control" dir="ltr" type="text" id="BookingMemberName">';
				append_guest_members += '</div>';
				append_guest_members += '<div class="form-group">';
				append_guest_members += '<label for="BookingMemberAge">Member Age</label>';
				append_guest_members += '<input name="data[GuestMember]['+i+'][member_age]" class="form-control" dir="ltr" type="text" id="BookingMemberAge">';
				append_guest_members += '</div>';
				append_guest_members += '<div class="form-group">';
				append_guest_members += '<label for="BookingMemberDob">Member Dob</label>';
				append_guest_members += '<input name="data[GuestMember]['+i+'][member_dob]" class="form-control" dir="ltr" type="date" id="BookingMemberDob">';
				append_guest_members += '</div>';
				append_guest_members += '<div class="form-group">';
				append_guest_members += '<label for="BookingMemberGender">Member Gender</label>';
				append_guest_members += '<select name="data[GuestMember]['+i+'][member_gender]" class="form-control" dir="ltr" id="BookingMemberGender">';
				append_guest_members += '<option value="">Select Gender</option>';
				append_guest_members += '<option value="male">Male</option>';
				append_guest_members += '<option value="female">Female</option>';
				append_guest_members += '</select>';
				append_guest_members += '</div>';
				append_guest_members += '<div class="form-group">';
				append_guest_members += '<label for="BookingMemberValidProof">Member Valid Proof</label>';
				append_guest_members += '<input name="data[GuestMember]['+i+'][member_valid_proof]" class="form-control" dir="ltr" type="text" id="BookingMemberValidProof">';
				append_guest_members += '</div>';
			}
			$("#guest_members").html('');
			$("#guest_members").html(append_guest_members);
		}
	});    
</script>