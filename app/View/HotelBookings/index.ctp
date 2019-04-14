<?php
$this->assign('pagetitle', __('Hotel Bookings'));
$this->Custom->addCrumb(__('Hotel Bookings'));
$this->start('top_links');
echo $this->Html->link(__('Add Hotel Booking'),array('action'=>'add'),array('icon'=>'fa-plus','title'=>__('Add Hotel Booking'),'class'=>'btn btn-primary','escape'=>false));
$this->end();
?>
<!-- <div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body row">
                <div class="col-md-12">
                 <?php echo $this->Form->create('HotelBooking', array('autocomplete' => 'off', 'novalidate' => 'novalidate'));
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
</div> -->

<div class="box box-primary">           
    <div class="box-footer clearfix">
        <?php echo $this->element('paginationtop'); ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th><?php echo $this->Paginator->sort('city_id'); ?></th>
                    <th><?php echo $this->Paginator->sort('state_id'); ?></th>
                    <th><?php echo $this->Paginator->sort('hotel_id'); ?></th>
                    <th><?php echo $this->Paginator->sort('customer_id'); ?></th>
                    <th><?php echo $this->Paginator->sort('price'); ?></th>
                    <th><?php echo $this->Paginator->sort('created'); ?></th>
                    <th><?php echo $this->Paginator->sort('updated'); ?></th>
                    <th class="actions text-center"><?php echo __('Actions'); ?></th>
                </tr>			
            </thead>		
            <tbody>
                <?php if(empty($hotelBookings)){?>
                    <tr>
                       <td colspan='9' class='text-warning'><?php echo __('No Hotel Booking found.')?></td>
                   </tr>
               <?php }else{?>

                <?php foreach ($hotelBookings as $hotelBooking): ?>
                   <tr>
                      <td>
                         <?php echo $this->Html->link($hotelBooking['City']['name'], array('controller' => 'cities', 'action' => 'view', $hotelBooking['City']['id'])); ?>
                     </td>
                     <td>
                         <?php echo $this->Html->link($hotelBooking['State']['name'], array('controller' => 'states', 'action' => 'view', $hotelBooking['State']['id'])); ?>
                     </td>
                     <td>
                         <?php echo $this->Html->link($hotelBooking['Hotel']['name'], array('controller' => 'hotels', 'action' => 'view', $hotelBooking['Hotel']['id'])); ?>
                     </td>
                     <td>
                         <?php echo $this->Html->link($hotelBooking['Customer']['name'], array('controller' => 'customers', 'action' => 'view', $hotelBooking['Customer']['id'])); ?>
                     </td>
                     <td><?php echo h($hotelBooking['HotelBooking']['price']); ?>&nbsp;</td>
                     <td><?php echo h($hotelBooking['HotelBooking']['created']); ?>&nbsp;</td>
                     <td><?php echo h($hotelBooking['HotelBooking']['updated']); ?>&nbsp;</td>
                     <td class="actions text-center"> 
                         <?php echo $this->Html->link(__(''), array('action' => 'view', $hotelBooking['HotelBooking']['id']), array('icon'=>'view','title' => __('Click here to view this Hotel Booking'))); ?>
                         <?php echo $this->Html->link(__(''), array('action' => 'edit', $hotelBooking['HotelBooking']['id']), array('icon'=>'edit','title' => __('Click here to edit this Hotel Booking'))); ?>
                         <?php echo $this->Html->link(__(''), array('action' => 'delete', $hotelBooking['HotelBooking']['id']), array('icon'=>'delete','title' => __('Click here to delete this Hotel Booking')), __('Are you sure you want to delete Hotel Booking?')); ?>
                        <?php echo $this->Html->link(__(''), array('controller'=>'files','action' => 'receipt', $hotelBooking['HotelBooking']['ac_id'],$hotelBooking['HotelBooking']['invoice_no'].'.pdf'),
                            array(
                                'icon' => 'fa-file',
                                'target'=>'_blank',
                                'class' => 'no-hover-text-decoration',
                                'title' => __('View Receipt')
                            )); ?>
                        <?php
                            echo $this->Html->link(__(''), array('controller'=>'files','action' => 'hotel_voucher', $hotelBooking['HotelBooking']['ac_id'],'voucher.pdf'),
                                array(
                                    'icon' => 'fa-file-text-o',
                                    'target'=>'_blank',
                                    'class' => 'no-hover-text-decoration',
                                    'title' => __('View Voucher')
                            ));                        
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