<?php
$this->assign('pagetitle', __('Bookings'));
$this->Custom->addCrumb(__('Bookings'));
$this->start('top_links');
echo $this->Html->link(__('Add Booking'),array('action'=>'add'),array('icon'=>'fa-plus','title'=>__('Add Booking'),'class'=>'btn btn-primary','escape'=>false));
$this->end();
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body row">
                <div class="col-md-12">
                 <?php echo $this->Form->create('Booking', array('autocomplete' => 'off', 'novalidate' => 'novalidate'));
                 ?>

                 <label>&nbsp</label>
                 <div class="col-md-12 form-group">
                  <?php echo $this->Form->submit(__('Search'), array('class' => 'btn btn-primary margin-right10', 'div' => false));		echo $this->Html->link(__('Reset Search'), array('action' => 'index', 'all'), array('title' => __('reset search'), 'class' => 'btn btn-default')); ?>
              </div>

              <?php echo $this->Form->end();?>
          </div>
      </div>
  </div>
</div>
</div>

<div class="box box-primary">           
    <div class="box-footer clearfix">
        <?php echo $this->element('paginationtop'); ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th><?php echo $this->Paginator->sort('customer_full_name'); ?></th>
                    <th><?php echo $this->Paginator->sort('customer_date_of_birth'); ?></th>
                    <th><?php echo $this->Paginator->sort('customer_contact_no'); ?></th>
                    <th><?php echo $this->Paginator->sort('customer_email_id'); ?></th>
                    <th><?php echo $this->Paginator->sort('total_tour_member'); ?></th>
                    <th><?php echo $this->Paginator->sort('tour_type'); ?></th>
                    <th><?php echo $this->Paginator->sort('meal_type'); ?></th>
                    <th><?php echo $this->Paginator->sort('place_name'); ?></th>
                    <th><?php echo $this->Paginator->sort('total_payment'); ?></th>
                    <th><?php echo $this->Paginator->sort('customer_emergency_contact_no'); ?></th>
                    <th><?php echo $this->Paginator->sort('customer_tour_name'); ?></th>
                    <th><?php echo $this->Paginator->sort('customer_valid_id_proof'); ?></th>
                    <th><?php echo $this->Paginator->sort('photo'); ?></th>
                    <th><?php echo $this->Paginator->sort('customer_tour_date'); ?></th>
                    <th><?php echo $this->Paginator->sort('car_couch_type'); ?></th>
                    <th><?php echo $this->Paginator->sort('travel_type'); ?></th>
                    <th><?php echo $this->Paginator->sort('travel_number'); ?></th>
                    <th><?php echo $this->Paginator->sort('travel_date'); ?></th>
                    <th><?php echo $this->Paginator->sort('travel_pnr_no'); ?></th>
                    <th><?php echo $this->Paginator->sort('return_travel_number'); ?></th>
                    <th><?php echo $this->Paginator->sort('return_travel_date'); ?></th>
                    <th><?php echo $this->Paginator->sort('return_travel_pnr_no'); ?></th>
                    <th><?php echo $this->Paginator->sort('customer_hotel_type'); ?></th>
                    <th><?php echo $this->Paginator->sort('customer_signature'); ?></th>
                    <th><?php echo $this->Paginator->sort('company_signature'); ?></th>
                    <th><?php echo $this->Paginator->sort('all_t_and_c'); ?></th>
                    <th class="actions text-center"><?php echo __('Actions'); ?></th>
                </tr>			
            </thead>		
            <tbody>
                <?php if(empty($bookings)){?>
                    <tr>
                       <td colspan='29' class='text-warning'><?php echo __('No Booking found.')?></td>
                   </tr>
               <?php }else{?>

                <?php foreach ($bookings as $booking): ?>
                   <tr>
                      <td><?php echo h($booking['Booking']['customer_full_name']); ?>&nbsp;</td>
                      <td><?php echo h($booking['Booking']['customer_date_of_birth']); ?>&nbsp;</td>
                      <td><?php echo h($booking['Booking']['customer_contact_no']); ?>&nbsp;</td>
                      <td><?php echo h($booking['Booking']['customer_email_id']); ?>&nbsp;</td>
                      <td><?php echo h($booking['Booking']['total_tour_member']); ?>&nbsp;</td>
                      <td><?php echo h($booking['Booking']['tour_type']); ?>&nbsp;</td>
                      <td><?php echo h($booking['Booking']['meal_type']); ?>&nbsp;</td>
                      <td><?php echo h($booking['Booking']['place_name']); ?>&nbsp;</td>
                      <td><?php echo h($booking['Booking']['total_payment']); ?>&nbsp;</td>
                      <td><?php echo h($booking['Booking']['customer_emergency_contact_no']); ?>&nbsp;</td>
                      <td><?php echo h($booking['Booking']['customer_tour_name']); ?>&nbsp;</td>
                      <td><?php echo h($booking['Booking']['customer_valid_id_proof']); ?>&nbsp;</td>
                      <td class="photo"><?php echo $this->Html->image(getPhoto($booking['Booking']['id'],$booking['Booking']['proof_file'],BOOKING_IMAGE, false,true))?></td>		
                      <td><?php echo h($booking['Booking']['customer_tour_date']); ?>&nbsp;</td>
                      <td><?php echo h($booking['Booking']['car_couch_type']); ?>&nbsp;</td>
                      <td><?php echo h($booking['Booking']['travel_type']); ?>&nbsp;</td>
                      <td><?php echo h($booking['Booking']['travel_number']); ?>&nbsp;</td>
                      <td><?php echo h($booking['Booking']['travel_date']); ?>&nbsp;</td>
                      <td><?php echo h($booking['Booking']['travel_pnr_no']); ?>&nbsp;</td>
                      <td><?php echo h($booking['Booking']['return_travel_number']); ?>&nbsp;</td>
                      <td><?php echo h($booking['Booking']['return_travel_date']); ?>&nbsp;</td>
                      <td><?php echo h($booking['Booking']['return_travel_pnr_no']); ?>&nbsp;</td>
                      <td><?php echo h($booking['Booking']['customer_hotel_type']); ?>&nbsp;</td>
                      <td><?php echo h($booking['Booking']['customer_signature']); ?>&nbsp;</td>
                      <td><?php echo h($booking['Booking']['company_signature']); ?>&nbsp;</td>
                      <td><?php echo cropDetail($booking['Booking']['all_t_and_c'],10); ?>&nbsp;</td>
                      <td class="actions text-center">
                         <?php echo $this->Html->link(__(''), array('action' => 'view', $booking['Booking']['id']), array('icon'=>'view','title' => __('Click here to view this Booking'))); ?>
                         <?php //echo $this->Html->link(__(''), array('action' => 'edit', $booking['Booking']['id']), array('icon'=>'edit','title' => __('Click here to edit this Booking'))); ?>
                         <?php echo $this->Html->link(__(''), array('action' => 'delete', $booking['Booking']['id']), array('icon'=>'delete','title' => __('Click here to delete this Booking')), __('Are you sure you want to delete Booking?')); ?>
                         <?php 
                        if(!empty($booking['Booking']['enquiry_id']) && empty($booking['Booking']['is_approved'])):
                                    echo $this->Html->link(__(''), array('action' => 'approve', $booking['Booking']['id'], $booking['Booking']['enquiry_id']),
                                        array(
                                            'icon' => 'fa-check',
                                            'class' => 'no-hover-text-decoration',
                                            'title' => __('Approve Customer')
                                        ), __('Are you sure you want to approve selected booking?'));
                                    echo $this->Html->link(__(''), array('action' => 'reject', $booking['Booking']['id'], $booking['Booking']['enquiry_id']),
                                        array(
                                            'icon' => 'fa-close',
                                            'class' => 'no-hover-text-decoration',
                                            'title' => __('Reject Customer')
                                        ), __('Are you sure you want to reject selected booking?'));                                    
                        endif;
                        if(!empty($booking['Booking']['is_approved']) && $booking['Booking']['is_approved']=='Yes'):
                                    echo $this->Html->link(__(''), array('controller'=>'files','action' => 'receipt', $booking['Booking']['id'],'file.pdf'),
                                        array(
                                            'icon' => 'fa-file',
                                            'target'=>'_blank',
                                            'class' => 'no-hover-text-decoration',
                                            'title' => __('View Receipt')
                                        ));
                                    echo $this->Html->link(__(''), array('controller'=>'files','action' => 'voucher', $booking['Booking']['id'],'file.pdf'),
                                        array(
                                            'icon' => 'fa-file-text-o',
                                            'target'=>'_blank',
                                            'class' => 'no-hover-text-decoration',
                                            'title' => __('View Voucher')
                                        ));
                        endif;                         
                         ?>
                     </td>
                 </tr>
             <?php endforeach; ?>
         <?php }?>			
     </tbody>
 </table>
</div>
<div class="box-footer clearfix">
    <?php echo $this->element('pagination'); ?>
</div>
</div>