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
						<?php echo $this->Html->image(getPhoto($booking['Booking']['id'],$booking['Booking']['proof_file'],BOOKING_IMAGE, false,true), array('class' => 'thumbnail img-responsive'))?>
					</div>
					<div class='col-xs-12 col-sm-9 detailBox'>
						<div class='row'>
							<div class=''>
								<div class='dl-horizontal'>
			                        <div class="table-responsive-lg table-responsive-sm table-responsive-md table-responsive">
			                            <table class="table table-bordered table-striped">
			                            <tbody>     									
											<tr>
												<th class='innreicons'>
													<?php echo __('Customer Full Name'); ?>
												</th>
												<td>
													<?php echo $booking['Booking']['customer_full_name']; ?>
												</td>
											</tr>
											<tr>
												<th class='innreicons'>
													<?php echo __('Customer Date Of Birth'); ?>
												</th>
												<td>
													<?php echo $booking['Booking']['customer_date_of_birth']; ?>
												</td>
											</tr>
											<tr>
												<th class='innreicons'>
													<?php echo __('Customer Contact No'); ?>
												</th>
												<td>
													<?php echo $booking['Booking']['customer_contact_no']; ?>
												</td>
											</tr>
											<tr>
												<th class='innreicons'>
													<?php echo __('Customer Email Id'); ?>
												</th>
												<td>
													<?php echo $booking['Booking']['customer_email_id']; ?>
												</td>
											</tr>
											<tr>
												<th class='innreicons'>
													<?php echo __('Total Tour Member'); ?>
												</th>
												<td>
													<?php echo $booking['Booking']['total_tour_member']; ?>
												</td>
											</tr>
											<tr>
												<th class='innreicons'>
													<?php echo __('Tour Type'); ?>
												</th>
												<td>
													<?php echo $booking['Booking']['tour_type']; ?>
												</td>
											</tr>
											<tr>
												<th class='innreicons'>
													<?php echo __('Meal Type'); ?>
												</th>
												<td>
													<?php echo $booking['Booking']['meal_type']; ?>
												</td>
											</tr>
											<tr>
												<th class='innreicons'>
													<?php echo __('Place Name'); ?>
												</th>
												<td>
													<?php echo $booking['Booking']['place_name']; ?>
												</td>
											</tr>
											<tr>
												<th class='innreicons'>
													<?php echo __('Total Payment'); ?>
												</th>
												<td>
													<?php echo $booking['Booking']['total_payment']; ?>
												</td>
											</tr>
											<tr>
												<th class='innreicons'>
													<?php echo __('Customer Emergency Contact No'); ?>
												</th>
												<td>
													<?php echo $booking['Booking']['customer_emergency_contact_no']; ?>
												</td>
											</tr>
											<tr>
												<th class='innreicons'>
													<?php echo __('Customer Tour Name'); ?>
												</th>
												<td>
													<?php echo $booking['Booking']['customer_tour_name']; ?>
												</td>
											</tr>
											<tr>
												<th class='innreicons'>
													<?php echo __('Customer Valid Id Proof'); ?>
												</th>
												<td>
													<?php echo $booking['Booking']['customer_valid_id_proof']; ?>
												</td>
											</tr>
											<tr>
												<th class='innreicons'>
													<?php echo __('Customer Tour Date'); ?>
												</th>
												<td>
													<?php echo $booking['Booking']['customer_tour_date']; ?>
												</td>
											</tr>
											<tr>
												<th class='innreicons'>
													<?php echo __('Car Couch Type'); ?>
												</th>
												<td>
													<?php echo $booking['Booking']['car_couch_type']; ?>
												</td>
											</tr>
											<tr>
												<th class='innreicons'>
													<?php echo __('Travel Type'); ?>
												</th>
												<td>
													<?php echo $booking['Booking']['travel_type']; ?>
												</td>
											</tr>
											<tr>
												<th class='innreicons'>
													<?php echo __('Travel Number'); ?>
												</th>
												<td>
													<?php echo $booking['Booking']['travel_number']; ?>
												</td>
											</tr>
											<tr>
												<th class='innreicons'>
													<?php echo __('Travel Date'); ?>
												</th>
												<td>
													<?php echo $booking['Booking']['travel_date']; ?>
												</td>
											</tr>
											<tr>
												<th class='innreicons'>
													<?php echo __('Travel Pnr No'); ?>
												</th>
												<td>
													<?php echo $booking['Booking']['travel_pnr_no']; ?>
												</td>
											</tr>
											<tr>
												<th class='innreicons'>
													<?php echo __('Return Travel Number'); ?>
												</th>
												<td>
													<?php echo $booking['Booking']['return_travel_number']; ?>
												</td>
											</tr>
											<tr>
												<th class='innreicons'>
													<?php echo __('Return Travel Date'); ?>
												</th>
												<td>
													<?php echo $booking['Booking']['return_travel_date']; ?>
												</td>
											</tr>
											<tr>
												<th class='innreicons'>
													<?php echo __('Return Travel Pnr No'); ?>
												</th>
												<td>
													<?php echo $booking['Booking']['return_travel_pnr_no']; ?>
												</td>
											</tr>
											<tr>
												<th class='innreicons'>
													<?php echo __('Customer Hotel Type'); ?>
												</th>
												<td>
													<?php echo $booking['Booking']['customer_hotel_type']; ?>
												</td>
											</tr>
											<tr>
												<th class='innreicons'>
													<?php echo __('Customer Signature'); ?>
												</th>
												<td>
													<?php echo $booking['Booking']['customer_signature']; ?>
												</td>
											</tr>
											<tr>
												<th class='innreicons'>
													<?php echo __('Company Signature'); ?>
												</th>
												<td>
													<?php echo $booking['Booking']['company_signature']; ?>
												</td>
											</tr>
											<tr>
												<th class='innreicons'>
													<?php echo __('All T And C'); ?>
												</th>
												<td>
													<?php echo $booking['Booking']['all_t_and_c']; ?>
												</td>
											</tr>
			                                </tbody>
			                            </table>
			                        </div>									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>