<?php
$this->assign('pagetitle', __('Vouchers'));
$this->Custom->addCrumb(__('Vouchers'));
$this->start('top_links');
//echo $this->Html->link(__('Add Voucher'),array('action'=>'add'),array('icon'=>'fa-plus','title'=>__('Add Voucher'),'class'=>'btn btn-primary','escape'=>false));
$this->end();
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body row">
                <div class="col-md-12">
                 <?php echo $this->Form->create('Voucher', array('autocomplete' => 'off', 'novalidate' => 'novalidate'));
                 echo $this->Form->input('customer_full_name', array('label' => __('Customer Name'), 'placeholder' => __('Customer Name'), 'required' => false, 'class' => 'form-control', 'div' => array('class' => 'col-md-3')));                 
                 ?>

                 <label>&nbsp</label>
                 <div class="col-md-9 form-group">
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
                    <th><?php echo $this->Paginator->sort('customer_contact_no'); ?></th>
                    <th><?php echo $this->Paginator->sort('customer_tour_type'); ?></th>
                    <th><?php echo $this->Paginator->sort('customer_tour_name'); ?></th>
                    <th><?php echo $this->Paginator->sort('customer_hotel_name'); ?></th>
                    <th><?php echo $this->Paginator->sort('customer_tour_date'); ?></th>
                    <th><?php echo $this->Paginator->sort('customer_hotel_place_name'); ?></th>
                    <th><?php echo $this->Paginator->sort('customer_hotel_check_in_date'); ?></th>
                    <th><?php echo $this->Paginator->sort('customer_hotel_check_out_date'); ?></th>
                    <th><?php echo $this->Paginator->sort('customer_room_type'); ?></th>
                    <th><?php echo $this->Paginator->sort('customer_travel_type'); ?></th>
                    <th><?php echo $this->Paginator->sort('meal_plan'); ?></th>
                    <th><?php echo $this->Paginator->sort('tour_manager_name'); ?></th>
                    <th><?php echo $this->Paginator->sort('tour_manager_contact_no'); ?></th>
                    <th><?php echo $this->Paginator->sort('hotel_contact_no'); ?></th>
                    <th><?php echo $this->Paginator->sort('emergency_contact_no'); ?></th>
                    <th><?php echo $this->Paginator->sort('company_signature'); ?></th>
                    <th><?php echo $this->Paginator->sort('customer_signature'); ?></th>
                    <th><?php echo $this->Paginator->sort('created'); ?></th>
                    <th><?php echo $this->Paginator->sort('updated'); ?></th>
                    <th class="actions text-center"><?php echo __('Actions'); ?></th>
                </tr>			
            </thead>		
            <tbody>
                <?php if(empty($vouchers)){?>
                    <tr>
                       <td colspan='22' class='text-warning'><?php echo __('No Voucher found.')?></td>
                   </tr>
               <?php }else{?>

                <?php foreach ($vouchers as $voucher): ?>
                   <tr>
                      <td><?php echo h($voucher['Voucher']['customer_full_name']); ?>&nbsp;</td>
                      <td><?php echo h($voucher['Voucher']['customer_contact_no']); ?>&nbsp;</td>
                      <td><?php echo h($voucher['Voucher']['customer_tour_type']); ?>&nbsp;</td>
                      <td><?php echo h($voucher['Voucher']['customer_tour_name']); ?>&nbsp;</td>
                      <td><?php echo h($voucher['Voucher']['customer_hotel_name']); ?>&nbsp;</td>
                      <td><?php echo h($voucher['Voucher']['customer_tour_date']); ?>&nbsp;</td>
                      <td><?php echo h($voucher['Voucher']['customer_hotel_place_name']); ?>&nbsp;</td>
                      <td><?php echo h($voucher['Voucher']['customer_hotel_check_in_date']); ?>&nbsp;</td>
                      <td><?php echo h($voucher['Voucher']['customer_hotel_check_out_date']); ?>&nbsp;</td>
                      <td><?php echo h($voucher['Voucher']['customer_room_type']); ?>&nbsp;</td>
                      <td><?php echo h($voucher['Voucher']['customer_travel_type']); ?>&nbsp;</td>
                      <td><?php echo h($voucher['Voucher']['meal_plan']); ?>&nbsp;</td>
                      <td><?php echo h($voucher['Voucher']['tour_manager_name']); ?>&nbsp;</td>
                      <td><?php echo h($voucher['Voucher']['tour_manager_contact_no']); ?>&nbsp;</td>
                      <td><?php echo h($voucher['Voucher']['hotel_contact_no']); ?>&nbsp;</td>
                      <td><?php echo h($voucher['Voucher']['emergency_contact_no']); ?>&nbsp;</td>
                      <td><?php echo h($voucher['Voucher']['company_signature']); ?>&nbsp;</td>
                      <td><?php echo h($voucher['Voucher']['customer_signature']); ?>&nbsp;</td>
                      <td><?php echo h($voucher['Voucher']['created']); ?>&nbsp;</td>
                      <td><?php echo h($voucher['Voucher']['updated']); ?>&nbsp;</td>
                      <td class="actions text-center">
                         <?php //echo $this->Html->link(__(''), array('action' => 'view', $voucher['Voucher']['id']), array('icon'=>'view','title' => __('Click here to view this Voucher'))); ?>
                         <?php echo $this->Html->link(__(''), array('action' => 'edit', $voucher['Voucher']['id']), array('icon'=>'edit','title' => __('Click here to edit this Voucher'))); ?>
                         <?php echo $this->Html->link(__(''), array('action' => 'sendVoucher',$voucher['Voucher']['booking_id'] ), array('icon'=>'fa fa-arrow-right','title' => __('Click here to send voucher again.'))); ?> 
                         <?php echo $this->Html->link(__(''), array('action' => 'delete', $voucher['Voucher']['id']), array('icon'=>'delete','title' => __('Click here to delete this Voucher')), __('Are you sure you want to delete Voucher?')); ?>
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