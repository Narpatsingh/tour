<?php
    $type = empty($edit) ? 'Add' : 'Edit';$mem = 1;
    	$this->assign('pagetitle', __('%s Booking',$type));
	$this->Custom->addCrumb(__('Bookings'),array('action'=>'index'));
	$this->Custom->addCrumb(__('%s Booking',$type));
	$this->start('top_links');
		echo $this->Html->link(__('Back'),array('action'=>'index'),array('icon'=>'fa-angle-double-left','class'=>'btn btn-default','escape'=>false));
	$this->end();
	$pcount = empty($this->request->data['Booking']['package_count'])?1:$this->request->data['Booking']['package_count'];
echo $this->Html->script(
    array(
        'backend/ckeditor/ckeditor.js'
    ), array('inline' => false)
);
echo $this->fetch('script');	
?>
<?php if($pcount==1): ?>	

	<!-- For 1 package section start -->
   	<div class="col-md-12">
   		
	    <div class="box box-primary">
	        <div class="overflow-hide-break">
	        	<?php echo $this->Form->create('Booking', array('class' => 'form-validate multiple_save','type'=>'file')); ?>
	        	<div class="box-body box-content">
	        	   	<div class="col-md-6">	
	        		<?php 
	        		/*Upper start*/
					echo $this->Form->input('id',array('type'=>'hidden'));
					echo $this->Form->input('customer_id',array('type'=>'hidden'));
					echo $this->Form->input('multi_hotel',array('type'=>'hidden'));
					echo $this->Form->input('package_count',array('type'=>'hidden','value'=>$pcount));
					echo $this->Form->input('customer_full_name',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('customer_date_of_birth',array('type'=>'text','class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('customer_contact_no',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('customer_emergency_contact_no',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('payment_type',array('options'=>array('cash'=>'Cash', 'cheque'=> 'Cheque', 'net_banking' => 'Net Banking' ), 'empty'=>'Select Payment Type', 'class' => 'form-control', 'div' => array('class' => 'form-group')));					
					echo $this->Form->input('customer_email_id',array('type'=>'text','class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('car_couch_type',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('tour_type',array('class' => 'form-control', 'div' => array('class' => 'form-group')));	        		
					/*Upper End*/

	        		/*Middle Start*/
					echo $this->Form->input('meal_type',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('place_name',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('total_payment',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('payment_recieved',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('tour_photo',array('type'=>'hidden'));
	        		?>
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
	        		<div class="col-md-6">
	        		<?php 					
					echo $this->Form->input('customer_tour_name',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('customer_tour_date',array('type'=>'text','class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('travel_type',array('options' => array('Bus'=>'Bus','Train'=>'Train','Flight'=>'Flight'),'class' => 'form-control','empty' => 'Select Travel Type', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('travel_number',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('travel_date',array('type'=>'text','class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('travel_pnr_no',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('return_travel_number',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('return_travel_date',array('type'=>'text','class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('return_travel_pnr_no',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('customer_hotel_type',array('class' => 'form-control', 'div' => array('class' => 'form-group')));	        		
	        		/*Middle End*/
	        		?>
	        		<?php 
	        		/*Bottom Start*/
					echo $this->Form->input('customer_signature',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('company_signature',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('all_t_and_c',array('type'=>'textarea','class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('customer_valid_id_proof',array('class' => 'form-control', 'div' => array('class' => 'form-group'))); ?>
					<label class="form-group" style="margin-bottom: 10px">Valid Id Proof</label><div class="form-group row"><div id='photoId' class='col-md-4'>
					<?php   echo $this->Html->image(getPhoto($this->request->data['Booking']['id'],$this->request->data['Booking']['proof_file'],BOOKING_IMAGE, false,true), array('class' => 'thumbnail img-responsive', 'style' => 'max-width: 250px')) ?></div>
					<?php 	echo $this->Form->input('proof_file', array('required' => false, 'label' => false, 'type' => 'file', 'class' => 'photo', 'div' => array('class' => 'col-md-10'))) ?><div for='BookingPhoto' generated='true' class='error' style='display: none'><span class="errorDV"> </span></div></div> 
	        		<?php
	        		/*Bottom End*/
	        		?>
	        	</div>
	        	</div>
	            <div class="form-action">
	                <?php echo $this->Form->submit(__('Save'), array('div' => false,'class' => 'btn btn-primary btn_dsbl'));?>
	                &nbsp;&nbsp;
	                <?php echo $this->Html->link(__('Cancel'), array('action' => 'index'), array('class' => 'btn btn-default'));?>
	            </div>	  
				<?php $arrValidation = array(
				'Rules' => array(
				 'customer_full_name' => array('required' => 1),
				 'payment_type' => array('required' => 1),
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
				 'payment_type' => array('required' => __('Please Select Payment Type')),
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
				 'all_t_and_c' => array('required' => __('Please enter All T And C'))
				)); ?>	                  	
	            <?php echo $this->Form->setValidation($arrValidation); ?>
	            <?php echo $this->Form->end(); ?>
	        </div>
	    </div>

   	</div>
   	<!-- For 1 package section end -->

   	<?php elseif($pcount==2): ?>

   	<!-- For 2 packages section start -->
   	<div class="col-md-12">
   		
	    <div class="box box-primary">
	        <div class="overflow-hide-break">
	        	<?php echo $this->Form->create('Booking', array('class' => 'form-validate multiple_save','type'=>'file')); ?>
	        	<div class="box-body box-content">
	        		<div class="col-md-6">
	        		<?php 
	        		/*Upper start*/
					echo $this->Form->input('id',array('type'=>'hidden'));
					echo $this->Form->input('customer_id',array('type'=>'hidden'));
					echo $this->Form->input('multi_hotel',array('type'=>'hidden'));
					echo $this->Form->input('package_count',array('type'=>'hidden','value'=>$pcount));
					echo $this->Form->input('customer_full_name',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('customer_date_of_birth',array('type'=>'text','class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('customer_contact_no',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('customer_emergency_contact_no',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
					?>
					</div>
					<div class="col-md-6">
					<?php
					echo $this->Form->input('payment_type',array('options'=>array('cash'=>'Cash', 'cheque'=> 'Cheque', 'net_banking' => 'Net Banking' ), 'empty'=>'Select Payment Type', 'class' => 'form-control', 'div' => array('class' => 'form-group')));					
					echo $this->Form->input('customer_email_id',array('type'=>'text','class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('car_couch_type',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('payment_recieved',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
					/*Upper End*/
	        		?>
	        		</div>
	        		<?php 
	        		/*Middle Start*/
					?>
			       	<div class="col-md-6">
					 <div class="box box-primary">
					  <div class="overflow-hide-break">
					   <div class="box-body box-content">			       		
					<?php 
					echo "<center><b> Tour Title :  ". $this->request->data['Booking']['customer_tour_name']."</b></center><br>";
					echo $this->Form->input('tour_type',array('class' => 'form-control', 'div' => array('class' => 'form-group')));	        		
					echo $this->Form->input('meal_type',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('place_name',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('total_payment',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('customer_tour_name',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('tour_photo',array('type'=>'hidden'));
					echo $this->Form->input('customer_tour_date',array('type'=>'text','class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('travel_type',array('options' => array('Bus'=>'Bus','Train'=>'Train','Flight'=>'Flight'),'class' => 'form-control','empty' => 'Select Travel Type', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('travel_number',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('travel_date',array('type'=>'text','class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('travel_pnr_no',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('return_travel_number',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('return_travel_date',array('type'=>'text','class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('return_travel_pnr_no',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('customer_hotel_type',array('class' => 'form-control', 'div' => array('class' => 'form-group')));					
					?>
			       	   </div>
			       	  </div>
			       	 </div>
			       	</div>
			       	<div class="col-md-6">
					 <div class="box box-primary">
					  <div class="overflow-hide-break">
					   <div class="box-body box-content">			       		
					<?php 
					echo "<center><b> Tour Title :  ". $this->request->data['Booking']['customer_tour_name2']."</b></center><br>";
					echo $this->Form->input('multi_hotel2',array('type'=>'hidden'));
					echo $this->Form->input('tour_type2',array('class' => 'form-control', 'div' => array('class' => 'form-group')));	        		
					echo $this->Form->input('meal_type2',array('class' => 'form-control','label'=>'Meal Type',  'div' => array('class' => 'form-group')));
					echo $this->Form->input('place_name2',array('class' => 'form-control','label'=>'Place Name',  'div' => array('class' => 'form-group')));
					echo $this->Form->input('total_payment2',array('class' => 'form-control','label'=>'Total Payment',  'div' => array('class' => 'form-group')));
					echo $this->Form->input('customer_tour_name2',array('class' => 'form-control','label'=>'Customer Tour Name',  'div' => array('class' => 'form-group')));
					echo $this->Form->input('tour_photo2',array('type'=>'hidden'));
					echo $this->Form->input('customer_tour_date2',array('type'=>'text','class' =>'form-control', 'label'=>'Customer Tour Date', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('travel_type2',array('options' => array('Bus'=>'Bus','Train'=>'Train','Flight'=>'Flight'),'class' => 'form-control','label'=>'Travel Type','empty' => 'Select Travel Type', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('travel_number2',array('class' => 'form-control','label'=>'Travel Number',  'div' => array('class' => 'form-group')));
					echo $this->Form->input('travel_date2',array('type'=>'text','class' => 'form-control', 'label'=>'Travel Date', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('travel_pnr_no2',array('class' => 'form-control','label'=>'Travel Pnr No',  'div' => array('class' => 'form-group')));
					echo $this->Form->input('return_travel_number2',array('class' => 'form-control','label'=>'Return Travel Number',  'div' => array('class' => 'form-group')));
					echo $this->Form->input('return_travel_date2',array('type'=>'text','class' => 'form-control', 'label'=>'Return Travel Date', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('return_travel_pnr_no2',array('class' => 'form-control','label'=>'Return Travel Pnr No',  'div' => array('class' => 'form-group')));
					echo $this->Form->input('customer_hotel_type2',array('class' => 'form-control','label'=>'Customer Hotel Type',  'div' => array('class' => 'form-group')));										
					?>
			       	   </div>
			       	  </div>
			       	 </div>
			       	</div>
					<?php	        		
	        		/*Middle End*/
	        		?>
	        		<div class="col-md-6">
	        		<?php 
	        		/*Bottom Start*/
					echo $this->Form->input('customer_signature',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('company_signature',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
					?>
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
					<div class="col-md-6">
					<?php
					echo $this->Form->input('all_t_and_c',array('type'=>'textarea','class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('customer_valid_id_proof',array('class' => 'form-control', 'div' => array('class' => 'form-group'))); ?>
					<label class="form-group" style="margin-bottom: 10px">Valid Id Proof</label><div class="form-group row"><div id='photoId' class='col-md-4'>
					<?php   echo $this->Html->image(getPhoto($this->request->data['Booking']['id'],$this->request->data['Booking']['proof_file'],BOOKING_IMAGE, false,true), array('class' => 'thumbnail img-responsive', 'style' => 'max-width: 250px')) ?></div>
					<?php 	echo $this->Form->input('proof_file', array('required' => false, 'label' => false, 'type' => 'file', 'class' => 'photo', 'div' => array('class' => 'col-md-10'))) ?><div for='BookingPhoto' generated='true' class='error' style='display: none'><span class="errorDV"> </span></div></div> 
					<?php	        		
	        		/*Bottom End*/
	        		?>
	        		</div>
	        	</div>
	            <div class="form-action">
	                <?php echo $this->Form->submit(__('Save'), array('div' => false,'class' => 'btn btn-primary btn_dsbl'));?>
	                &nbsp;&nbsp;
	                <?php echo $this->Html->link(__('Cancel'), array('action' => 'index'), array('class' => 'btn btn-default'));?>
	            </div>	  
				<?php $arrValidation = array(
				'Rules' => array(
				 'customer_full_name' => array('required' => 1),
				 'payment_type' => array('required' => 1),
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
				 'meal_type2' => array('required' => 1),
				 'place_name2' => array('required' => 1),
				 'total_payment2' => array('required' => 1),
				 'payment_recieved' => array('required' => 1),
				 'customer_tour_name2' => array('required' => 1),
				 'customer_tour_date2' => array('required' => 1),
				 'travel_type2' => array('required' => 1),
				 'tour_type2' => array('required' => 1),
				 'travel_number2' => array('required' => 1),
				 'travel_date2' => array('required' => 1),
				 'travel_pnr_no2' => array('required' => 1),
				 'return_travel_number2' => array('required' => 1),
				 'return_travel_date2' => array('required' => 1),
				 'return_travel_pnr_no2' => array('required' => 1),
				 'customer_hotel_type2' => array('required' => 1),
				),
				'Messages' => array(
				'customer_full_name' => array('required' => __('Please enter Customer Full Name')),
				'payment_type' => array('required' => __('Please Select Payment Type')),
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
				 'tour_type2' => array('required' => __('Please enter Tour Type')),
				 'all_t_and_c' => array('required' => __('Please enter All T And C')),
				 'meal_type2' => array('required' => __('Please enter Meal Type')),
				 'place_name2' => array('required' => __('Please enter Place Name')),
				 'total_payment2' => array('required' => __('Please enter Total Payment')),
				 'payment_recieved' => array('required' => __('Please enter Payment Recieved')),
				 'customer_tour_name2' => array('required' => __('Please enter Customer Tour Name')),
				 'customer_tour_date2' => array('required' => __('Please enter Customer Tour Date')),
				 'travel_type2' => array('required' => __('Please enter Travel Type')),
				 'travel_number2' => array('required' => __('Please enter Travel Number')),
				 'travel_date2' => array('required' => __('Please enter Travel Date')),
				 'travel_pnr_no2' => array('required' => __('Please enter Travel Pnr No')),
				 'return_travel_number2' => array('required' => __('Please enter Return Travel Number')),
				 'return_travel_date2' => array('required' => __('Please enter Return Travel Date')),
				 'return_travel_pnr_no2' => array('required' => __('Please enter Return Travel Pnr No')),
				 'customer_hotel_type2' => array('required' => __('Please enter Customer Hotel Type')),
				)); ?>	                  	
	            <?php  echo $this->Form->setValidation($arrValidation); ?>
	            <?php echo $this->Form->end(); ?>
	        </div>
	    </div>   		

   	</div>
   	<!-- For 2 packages section end -->
   	
   	<?php else: ?>	

   	<!-- For 3 packages section start -->
   	<div class="col-md-12">

	    <div class="box box-primary">
	        <div class="overflow-hide-break">
	        	<?php echo $this->Form->create('Booking', array('class' => 'form-validate multiple_save','type'=>'file')); ?>
	        	<div class="box-body box-content">
	        		<div class="col-md-6">
	        		<?php 
	        		/*Upper start*/
					echo $this->Form->input('id',array('type'=>'hidden'));
					echo $this->Form->input('customer_id',array('type'=>'hidden'));
					echo $this->Form->input('multi_hotel',array('type'=>'hidden'));
					echo $this->Form->input('package_count',array('type'=>'hidden','value'=>$pcount));
					echo $this->Form->input('customer_full_name',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('customer_date_of_birth',array('type'=>'text','class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('customer_contact_no',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('customer_emergency_contact_no',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
					?>
					</div>
					<div class="col-md-6">
					<?php
					echo $this->Form->input('payment_type',array('options'=>array('cash'=>'Cash', 'cheque'=> 'Cheque', 'net_banking' => 'Net Banking' ), 'empty'=>'Select Payment Type', 'class' => 'form-control', 'div' => array('class' => 'form-group')));					
					echo $this->Form->input('customer_email_id',array('type'=>'text','class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('car_couch_type',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('payment_recieved',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
					/*Upper End*/
	        		?>
	        		</div>
	        		<?php 
	        		/*Middle Start*/
					?>
			       	<div class="col-md-4">
					 <div class="box box-primary">
					  <div class="overflow-hide-break">
					   <div class="box-body box-content">			       		
					<?php 
					echo "<center><b> Tour Title :  ". $this->request->data['Booking']['customer_tour_name']."</b></center><br>";
					echo $this->Form->input('tour_type',array('class' => 'form-control', 'div' => array('class' => 'form-group')));	        		
					echo $this->Form->input('meal_type',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('place_name',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('total_payment',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('customer_tour_name',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('tour_photo',array('type'=>'hidden'));
					echo $this->Form->input('customer_tour_date',array('type'=>'text','class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('travel_type',array('options' => array('Bus'=>'Bus','Train'=>'Train','Flight'=>'Flight'),'class' => 'form-control','empty' => 'Select Travel Type', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('travel_number',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('travel_date',array('type'=>'text','class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('travel_pnr_no',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('return_travel_number',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('return_travel_date',array('type'=>'text','class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('return_travel_pnr_no',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('customer_hotel_type',array('class' => 'form-control', 'div' => array('class' => 'form-group')));					
					?>
			       	   </div>
			       	  </div>
			       	 </div>
			       	</div>
			       	<div class="col-md-4">
					 <div class="box box-primary">
					  <div class="overflow-hide-break">
					   <div class="box-body box-content">			       					       		
					<?php 
					echo "<center><b> Tour Title :  ". $this->request->data['Booking']['customer_tour_name2']."</b></center><br>";
					echo $this->Form->input('multi_hotel2',array('type'=>'hidden'));
					echo $this->Form->input('tour_type2',array('class' => 'form-control', 'div' => array('class' => 'form-group')));	        		
					echo $this->Form->input('meal_type2',array('class' => 'form-control','label'=>'Meal Type',  'div' => array('class' => 'form-group')));
					echo $this->Form->input('place_name2',array('class' => 'form-control','label'=>'Place Name',  'div' => array('class' => 'form-group')));
					echo $this->Form->input('total_payment2',array('class' => 'form-control','label'=>'Total Payment',  'div' => array('class' => 'form-group')));
					echo $this->Form->input('customer_tour_name2',array('class' => 'form-control','label'=>'Customer Tour Name',  'div' => array('class' => 'form-group')));
					echo $this->Form->input('tour_photo2',array('type'=>'hidden'));
					echo $this->Form->input('customer_tour_date2',array('type'=>'text','class' =>'form-control', 'label'=>'Customer Tour Date', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('travel_type2',array('options' => array('Bus'=>'Bus','Train'=>'Train','Flight'=>'Flight'),'class' => 'form-control','label'=>'Travel Type','empty' => 'Select Travel Type', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('travel_number2',array('class' => 'form-control','label'=>'Travel Number',  'div' => array('class' => 'form-group')));
					echo $this->Form->input('travel_date2',array('type'=>'text','class' => 'form-control', 'label'=>'Travel Date', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('travel_pnr_no2',array('class' => 'form-control','label'=>'Travel Pnr No',  'div' => array('class' => 'form-group')));
					echo $this->Form->input('return_travel_number2',array('class' => 'form-control','label'=>'Return Travel Number',  'div' => array('class' => 'form-group')));
					echo $this->Form->input('return_travel_date2',array('type'=>'text','class' => 'form-control', 'label'=>'Return Travel Date', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('return_travel_pnr_no2',array('class' => 'form-control','label'=>'Return Travel Pnr No',  'div' => array('class' => 'form-group')));
					echo $this->Form->input('customer_hotel_type2',array('class' => 'form-control','label'=>'Customer Hotel Type',  'div' => array('class' => 'form-group')));										
					?>
			       	   </div>
			       	  </div>
			       	 </div>
			       	</div>
			       	<div class="col-md-4">
					 <div class="box box-primary">
					  <div class="overflow-hide-break">
					   <div class="box-body box-content">			       		
					<?php 
					echo "<center><b> Tour Title :  ". $this->request->data['Booking']['customer_tour_name3']."</b></center><br>";
					echo $this->Form->input('multi_hotel3',array('type'=>'hidden'));
					echo $this->Form->input('tour_type3',array('class' => 'form-control', 'div' => array('class' => 'form-group')));	        		
					echo $this->Form->input('meal_type3',array('class' => 'form-control','label'=>'Meal Type',  'div' => array('class' => 'form-group')));
					echo $this->Form->input('place_name3',array('class' => 'form-control','label'=>'Place Name',  'div' => array('class' => 'form-group')));
					echo $this->Form->input('total_payment3',array('class' => 'form-control','label'=>'Total Payment',  'div' => array('class' => 'form-group')));
					echo $this->Form->input('customer_tour_name3',array('class' => 'form-control','label'=>'Customer Tour Name',  'div' => array('class' => 'form-group')));
					echo $this->Form->input('tour_photo3',array('type'=>'hidden'));
					echo $this->Form->input('customer_tour_date3',array('type'=>'text','class' =>'form-control', 'label'=>'Customer Tour Date', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('travel_type3',array('options' => array('Bus'=>'Bus','Train'=>'Train','Flight'=>'Flight'),'class' => 'form-control','label'=>'Travel Type','empty' => 'Select Travel Type', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('travel_number3',array('class' => 'form-control','label'=>'Travel Number',  'div' => array('class' => 'form-group')));
					echo $this->Form->input('travel_date3',array('type'=>'text','class' => 'form-control', 'label'=>'Travel Date', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('travel_pnr_no3',array('class' => 'form-control','label'=>'Travel Pnr No',  'div' => array('class' => 'form-group')));
					echo $this->Form->input('return_travel_number3',array('class' => 'form-control','label'=>'Return Travel Number',  'div' => array('class' => 'form-group')));
					echo $this->Form->input('return_travel_date3',array('type'=>'text','class' => 'form-control', 'label'=>'Return Travel Date', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('return_travel_pnr_no3',array('class' => 'form-control','label'=>'Return Travel Pnr No',  'div' => array('class' => 'form-group')));
					echo $this->Form->input('customer_hotel_type3',array('class' => 'form-control','label'=>'Customer Hotel Type',  'div' => array('class' => 'form-group')));										
					?>
			       	   </div>
			       	  </div>
			       	 </div>
			       	</div>
					<?php	        		
	        		/*Middle End*/
	        		?>
	        		<div class="col-md-6">
	        		<?php 
	        		/*Bottom Start*/
					echo $this->Form->input('customer_signature',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('company_signature',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
					?>	
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
					<div class="col-md-6">
					<?php
					echo $this->Form->input('all_t_and_c',array('type'=>'textarea','class' => 'form-control', 'div' => array('class' => 'form-group')));
					echo $this->Form->input('customer_valid_id_proof',array('class' => 'form-control', 'div' => array('class' => 'form-group'))); ?>
					<label class="form-group" style="margin-bottom: 10px">Valid Id Proof</label><div class="form-group row"><div id='photoId' class='col-md-4'>
					<?php   echo $this->Html->image(getPhoto($this->request->data['Booking']['id'],$this->request->data['Booking']['proof_file'],BOOKING_IMAGE, false,true), array('class' => 'thumbnail img-responsive', 'style' => 'max-width: 250px')) ?></div>
					<?php 	echo $this->Form->input('proof_file', array('required' => false, 'label' => false, 'type' => 'file', 'class' => 'photo', 'div' => array('class' => 'col-md-10'))) ?><div for='BookingPhoto' generated='true' class='error' style='display: none'><span class="errorDV"> </span></div></div> 
					<?php	        		
	        		/*Bottom End*/
	        		?>
	        		</div>
	        	</div>
	            <div class="form-action">
	                <?php echo $this->Form->submit(__('Save'), array('div' => false,'class' => 'btn btn-primary btn_dsbl'));?>
	                &nbsp;&nbsp;
	                <?php echo $this->Html->link(__('Cancel'), array('action' => 'index'), array('class' => 'btn btn-default'));?>
	            </div>	  
				<?php $arrValidation = array(
				'Rules' => array(
				 'customer_full_name' => array('required' => 1),
				 'payment_type' => array('required' => 1),
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
				 'meal_type2' => array('required' => 1),
				 'tour_type2' => array('required' => 1),
				 'place_name2' => array('required' => 1),
				 'total_payment2' => array('required' => 1),
				 'payment_recieved' => array('required' => 1),
				 'customer_tour_name2' => array('required' => 1),
				 'customer_tour_date2' => array('required' => 1),
				 'travel_type2' => array('required' => 1),
				 'travel_number2' => array('required' => 1),
				 'travel_date2' => array('required' => 1),
				 'travel_pnr_no2' => array('required' => 1),
				 'return_travel_number2' => array('required' => 1),
				 'return_travel_date2' => array('required' => 1),
				 'return_travel_pnr_no2' => array('required' => 1),
				 'customer_hotel_type2' => array('required' => 1),
				 'meal_type3' => array('required' => 1),
				 'place_name3' => array('required' => 1),
				 'total_payment3' => array('required' => 1),
				 'payment_recieved3' => array('required' => 1),
				 'customer_tour_name3' => array('required' => 1),
				 'customer_tour_date3' => array('required' => 1),
				 'travel_type3' => array('required' => 1),
				 'tour_type3' => array('required' => 1),
				 'travel_number3' => array('required' => 1),
				 'travel_date3' => array('required' => 1),
				 'travel_pnr_no3' => array('required' => 1),
				 'return_travel_number3' => array('required' => 1),
				 'return_travel_date3' => array('required' => 1),
				 'return_travel_pnr_no3' => array('required' => 1),
				 'customer_hotel_type3' => array('required' => 1),				 
				),
				'Messages' => array(
				'customer_full_name' => array('required' => __('Please enter Customer Full Name')),
				'payment_type' => array('required' => __('Please Select Payment Type')),
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
				 'all_t_and_c' => array('required' => __('Please enter All T And C')),
				 'meal_type2' => array('required' => __('Please enter Meal Type')),
				 'place_name2' => array('required' => __('Please enter Place Name')),
				 'tour_type2' => array('required' => __('Please enter Tour Type')),
				 'total_payment2' => array('required' => __('Please enter Total Payment')),
				 'payment_recieved' => array('required' => __('Please enter Payment Recieved')),
				 'customer_tour_name2' => array('required' => __('Please enter Customer Tour Name')),
				 'customer_tour_date2' => array('required' => __('Please enter Customer Tour Date')),
				 'travel_type2' => array('required' => __('Please enter Travel Type')),
				 'travel_number2' => array('required' => __('Please enter Travel Number')),
				 'travel_date2' => array('required' => __('Please enter Travel Date')),
				 'travel_pnr_no2' => array('required' => __('Please enter Travel Pnr No')),
				 'return_travel_number2' => array('required' => __('Please enter Return Travel Number')),
				 'return_travel_date2' => array('required' => __('Please enter Return Travel Date')),
				 'return_travel_pnr_no2' => array('required' => __('Please enter Return Travel Pnr No')),
				 'customer_hotel_type2' => array('required' => __('Please enter Customer Hotel Type')),
				 'meal_type3' => array('required' => __('Please enter Meal Type')),
				 'tour_type3' => array('required' => __('Please enter Tour Type')),
				 'place_name3' => array('required' => __('Please enter Place Name')),
				 'total_payment3' => array('required' => __('Please enter Total Payment')),
				 'payment_recieved3' => array('required' => __('Please enter Payment Recieved')),
				 'customer_tour_name3' => array('required' => __('Please enter Customer Tour Name')),
				 'customer_tour_date3' => array('required' => __('Please enter Customer Tour Date')),
				 'travel_type3' => array('required' => __('Please enter Travel Type')),
				 'travel_number3' => array('required' => __('Please enter Travel Number')),
				 'travel_date3' => array('required' => __('Please enter Travel Date')),
				 'travel_pnr_no3' => array('required' => __('Please enter Travel Pnr No')),
				 'return_travel_number3' => array('required' => __('Please enter Return Travel Number')),
				 'return_travel_date3' => array('required' => __('Please enter Return Travel Date')),
				 'return_travel_pnr_no3' => array('required' => __('Please enter Return Travel Pnr No')),
				 'customer_hotel_type3' => array('required' => __('Please enter Customer Hotel Type')),				 
				)); ?>	                  	
	            <?php  echo $this->Form->setValidation($arrValidation); ?>
	            <?php echo $this->Form->end(); ?>
	        </div>
	    </div>   		

   	</div>
   	<!-- For 3 packages section end -->

<?php endif; ?>    

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

    jQuery(document).ready(function () {
        CKEDITOR.replace('BookingAllTAndC');
    });  
</script>