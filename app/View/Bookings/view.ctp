<?php
$this->assign('pagetitle', __('Booking Detail').' 
<small>'.__('Bookings').'</small>');
$this->Custom->addCrumb(__('Bookings'),array('action'=>'index'));
$this->Custom->addCrumb(__('Booking Detail'));
$this->start('top_links');
echo $this->Html->link(__('Delete'), array('action' => 'delete', $booking['Booking']['id']), array('icon'=>'fa-trash-o','title' => __('Click here to delete this Booking'),'class'=>'btn btn-danger','escape'=>false),__('Are you sure? You want to delete this Booking?'));
echo $this->Html->link(__('Edit'), array('action' => 'edit', $booking['Booking']['id']), array('icon'=>'fa-edit','title' => __('Click here to edit this Booking'),'class'=>'btn btn-primary','escape'=>false));
echo $this->Html->link(__('Add Booking'),array('action'=>'add'),array('icon'=>'fa-plus','title' => 'Click here to add Booking','class'=>'btn btn-primary','escape'=>false));
echo $this->Html->link(__('Back'),array('action'=>'index'),array('icon'=>'fa-angle-double-left','class'=>'btn btn-default','escape'=>false));
$this->end();
?>
<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary">
			<div class="overflow-hide-break">
				<div class="box-body userViewPage">
					<div class='col-xs-12 col-sm-3'>
						<?php echo $this->Html->image(getUserPhoto($booking['Booking']['id'],$booking['Booking']['proof_file'],false,false), array('class' => 'thumbnail img-responsive'))?>
					</div>
					<div class='col-xs-12 col-sm-9 detailBox'>
						<div class='row'>
							<div class='col-md-12 col-sm-12 innerBox'>
								<div class='dl-horizontal'>
									
									<ul>
										<li class='innreicons'>
											<?php echo __('Customer Full Name'); ?>
											<i class='fa fa-hand-o-right'></i>
										</li>
										<li>
											<?php echo $booking['Booking']['customer_full_name']; ?>
										</li>
									</ul>
									<ul>
										<li class='innreicons'>
											<?php echo __('Customer Date Of Birth'); ?>
											<i class='fa fa-hand-o-right'></i>
										</li>
										<li>
											<?php echo $booking['Booking']['customer_date_of_birth']; ?>
										</li>
									</ul>
									<ul>
										<li class='innreicons'>
											<?php echo __('Customer Contact No'); ?>
											<i class='fa fa-hand-o-right'></i>
										</li>
										<li>
											<?php echo $booking['Booking']['customer_contact_no']; ?>
										</li>
									</ul>
									<ul>
										<li class='innreicons'>
											<?php echo __('Customer Email Id'); ?>
											<i class='fa fa-hand-o-right'></i>
										</li>
										<li>
											<?php echo $booking['Booking']['customer_email_id']; ?>
										</li>
									</ul>
									<ul>
										<li class='innreicons'>
											<?php echo __('Total Tour Member'); ?>
											<i class='fa fa-hand-o-right'></i>
										</li>
										<li>
											<?php echo $booking['Booking']['total_tour_member']; ?>
										</li>
									</ul>
									<ul>
										<li class='innreicons'>
											<?php echo __('Tour Type'); ?>
											<i class='fa fa-hand-o-right'></i>
										</li>
										<li>
											<?php echo $booking['Booking']['tour_type']; ?>
										</li>
									</ul>
									<ul>
										<li class='innreicons'>
											<?php echo __('Member Id'); ?>
											<i class='fa fa-hand-o-right'></i>
										</li>
										<li>
											<?php echo $booking['Booking']['member_id']; ?>
										</li>
									</ul>
									<ul>
										<li class='innreicons'>
											<?php echo __('Meal Type'); ?>
											<i class='fa fa-hand-o-right'></i>
										</li>
										<li>
											<?php echo $booking['Booking']['meal_type']; ?>
										</li>
									</ul>
									<ul>
										<li class='innreicons'>
											<?php echo __('Place Name'); ?>
											<i class='fa fa-hand-o-right'></i>
										</li>
										<li>
											<?php echo $booking['Booking']['place_name']; ?>
										</li>
									</ul>
									<ul>
										<li class='innreicons'>
											<?php echo __('Total Payment'); ?>
											<i class='fa fa-hand-o-right'></i>
										</li>
										<li>
											<?php echo $booking['Booking']['total_payment']; ?>
										</li>
									</ul>
									<ul>
										<li class='innreicons'>
											<?php echo __('Customer Emergency Contact No'); ?>
											<i class='fa fa-hand-o-right'></i>
										</li>
										<li>
											<?php echo $booking['Booking']['customer_emergency_contact_no']; ?>
										</li>
									</ul>
									<ul>
										<li class='innreicons'>
											<?php echo __('Customer Tour Name'); ?>
											<i class='fa fa-hand-o-right'></i>
										</li>
										<li>
											<?php echo $booking['Booking']['customer_tour_name']; ?>
										</li>
									</ul>
									<ul>
										<li class='innreicons'>
											<?php echo __('Customer Valid Id Proof'); ?>
											<i class='fa fa-hand-o-right'></i>
										</li>
										<li>
											<?php echo $booking['Booking']['customer_valid_id_proof']; ?>
										</li>
									</ul>
									<ul>
										<li class='innreicons'>
											<?php echo __('Customer Tour Date'); ?>
											<i class='fa fa-hand-o-right'></i>
										</li>
										<li>
											<?php echo $booking['Booking']['customer_tour_date']; ?>
										</li>
									</ul>
									<ul>
										<li class='innreicons'>
											<?php echo __('Car Couch Type'); ?>
											<i class='fa fa-hand-o-right'></i>
										</li>
										<li>
											<?php echo $booking['Booking']['car_couch_type']; ?>
										</li>
									</ul>
									<ul>
										<li class='innreicons'>
											<?php echo __('Travel Type'); ?>
											<i class='fa fa-hand-o-right'></i>
										</li>
										<li>
											<?php echo $booking['Booking']['travel_type']; ?>
										</li>
									</ul>
									<ul>
										<li class='innreicons'>
											<?php echo __('Travel Number'); ?>
											<i class='fa fa-hand-o-right'></i>
										</li>
										<li>
											<?php echo $booking['Booking']['travel_number']; ?>
										</li>
									</ul>
									<ul>
										<li class='innreicons'>
											<?php echo __('Travel Date'); ?>
											<i class='fa fa-hand-o-right'></i>
										</li>
										<li>
											<?php echo $booking['Booking']['travel_date']; ?>
										</li>
									</ul>
									<ul>
										<li class='innreicons'>
											<?php echo __('Travel Pnr No'); ?>
											<i class='fa fa-hand-o-right'></i>
										</li>
										<li>
											<?php echo $booking['Booking']['travel_pnr_no']; ?>
										</li>
									</ul>
									<ul>
										<li class='innreicons'>
											<?php echo __('Return Travel Number'); ?>
											<i class='fa fa-hand-o-right'></i>
										</li>
										<li>
											<?php echo $booking['Booking']['return_travel_number']; ?>
										</li>
									</ul>
									<ul>
										<li class='innreicons'>
											<?php echo __('Return Travel Date'); ?>
											<i class='fa fa-hand-o-right'></i>
										</li>
										<li>
											<?php echo $booking['Booking']['return_travel_date']; ?>
										</li>
									</ul>
									<ul>
										<li class='innreicons'>
											<?php echo __('Return Travel Pnr No'); ?>
											<i class='fa fa-hand-o-right'></i>
										</li>
										<li>
											<?php echo $booking['Booking']['return_travel_pnr_no']; ?>
										</li>
									</ul>
									<ul>
										<li class='innreicons'>
											<?php echo __('Customer Hotel Type'); ?>
											<i class='fa fa-hand-o-right'></i>
										</li>
										<li>
											<?php echo $booking['Booking']['customer_hotel_type']; ?>
										</li>
									</ul>
									<ul>
										<li class='innreicons'>
											<?php echo __('Customer Signature'); ?>
											<i class='fa fa-hand-o-right'></i>
										</li>
										<li>
											<?php echo $booking['Booking']['customer_signature']; ?>
										</li>
									</ul>
									<ul>
										<li class='innreicons'>
											<?php echo __('Company Signature'); ?>
											<i class='fa fa-hand-o-right'></i>
										</li>
										<li>
											<?php echo $booking['Booking']['company_signature']; ?>
										</li>
									</ul>
									<ul>
										<li class='innreicons'>
											<?php echo __('All T And C'); ?>
											<i class='fa fa-hand-o-right'></i>
										</li>
										<li>
											<?php echo $booking['Booking']['all_t_and_c']; ?>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>