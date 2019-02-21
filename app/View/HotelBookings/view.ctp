<?php
	$this->assign('pagetitle', __('Hotel Booking Detail').' <small>'.__('Hotel Bookings').'</small>');
	$this->Custom->addCrumb(__('Hotel Bookings'),array('action'=>'index'));
	$this->Custom->addCrumb(__('Hotel Booking Detail'));
	$this->start('top_links');
		echo $this->Html->link(__('Delete'), array('action' => 'delete', $hotelBooking['HotelBooking']['id']), array('icon'=>'fa-trash-o','title' => __('Click here to delete this Hotel Booking'),'class'=>'btn btn-danger','escape'=>false),__('Are you sure? You want to delete this Hotel Booking?'));
		echo $this->Html->link(__('Edit'), array('action' => 'edit', $hotelBooking['HotelBooking']['id']), array('icon'=>'fa-edit','title' => __('Click here to edit this Hotel Booking'),'class'=>'btn btn-primary','escape'=>false));
		echo $this->Html->link(__('Add Hotel Booking'),array('action'=>'add'),array('icon'=>'fa-plus','title' => 'Click here to add Hotel Booking','class'=>'btn btn-primary','escape'=>false));
		echo $this->Html->link(__('Back'),array('action'=>'index'),array('icon'=>'fa-angle-double-left','class'=>'btn btn-default','escape'=>false));
	$this->end();
?>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="overflow-hide-break">
                <div class="box-body userViewPage">
                    <div class="col-md-9">
                        <div class="table-responsive-lg table-responsive-sm table-responsive-md table-responsive">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th><?php echo __('City'); ?></th>
                                        <td><p><?php echo $hotelBooking['City']['name']; ?></p></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __('State'); ?></th>
                                        <td><p><?php echo $hotelBooking['State']['name']; ?></p></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __('Customer Name'); ?></th>
                                        <td><p><?php echo $hotelBooking['Customer']['name']; ?></p></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __('Price'); ?></th>
                                        <td><p><?php echo $hotelBooking['HotelBooking']['price']; ?></p></td>
                                    </tr>
                                    <tr>
                                        <th> <?php echo __('Created'); ?></th>
                                        <td><p><?php echo $hotelBooking['HotelBooking']['created']; ?></p></t>
                                    </tr>
                                    <tr>
                                        <th> <?php echo __('Updated'); ?></th>
                                        <td><p><?php echo $hotelBooking['HotelBooking']['updated']; ?></p></t>
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