<?php
$this->assign('pagetitle', __('Flight Details'));
$this->Custom->addCrumb(__('Flight Details'));
$this->start('top_links');
echo $this->Html->link(__('Add Flight Detail'),array('action'=>'add'),array('icon'=>'fa-plus','title'=>__('Add Flight Detail'),'class'=>'btn btn-primary','escape'=>false));
$this->end();
?>
<!-- <div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body row">
                <div class="col-md-12">
                 <?php echo $this->Form->create('FlightDetail', array('autocomplete' => 'off', 'novalidate' => 'novalidate'));
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
                    <th><?php echo $this->Paginator->sort('customer_id'); ?></th>
                    <th><?php echo $this->Paginator->sort('company_name'); ?></th>
                    <th><?php echo $this->Paginator->sort('flight_no'); ?></th>
                    <th><?php echo $this->Paginator->sort('pnr_no'); ?></th>
                    <th><?php echo $this->Paginator->sort('price'); ?></th>
                    <th><?php echo $this->Paginator->sort('payment_type'); ?></th>
                    <th><?php echo $this->Paginator->sort('source'); ?></th>
                    <th><?php echo $this->Paginator->sort('destination'); ?></th>
                    <th><?php echo $this->Paginator->sort('created'); ?></th>
                    <th class="actions text-center"><?php echo __('Actions'); ?></th>
                </tr>			
            </thead>		
            <tbody>
                <?php if(empty($flightDetails)){?>
                    <tr>
                     <td colspan='9' class='text-warning'><?php echo __('No Flight Detail found.')?></td>
                 </tr>
             <?php }else{?>

                <?php foreach ($flightDetails as $flightDetail): ?>
                	<tr>
                        <td><?php echo h($flightDetail['Customer']['name']); ?>&nbsp;</td>
                        <td><?php echo h($flightDetail['FlightDetail']['company_name']); ?>&nbsp;</td>
                        <td><?php echo h($flightDetail['FlightDetail']['flight_no']); ?>&nbsp;</td>
                        <td><?php echo h($flightDetail['FlightDetail']['pnr_no']); ?>&nbsp;</td>
                        <td><?php echo h($flightDetail['FlightDetail']['price']); ?>&nbsp;</td>
                        <td><?php echo h(Inflector::humanize($flightDetail['FlightDetail']['payment_type'])); ?>&nbsp;</td>
                        <td><?php echo h($flightDetail['FlightDetail']['source']); ?>&nbsp;</td>
                        <td><?php echo h($flightDetail['FlightDetail']['destination']); ?>&nbsp;</td>
                        <td><?php echo h($flightDetail['FlightDetail']['created']); ?>&nbsp;</td>
                        <td class="actions text-center">
                         <?php echo $this->Html->link(__(''), array('action' => 'view', $flightDetail['FlightDetail']['id']), array('icon'=>'view','title' => __('Click here to view this Flight Detail'))); ?>
                         <?php echo $this->Html->link(__(''), array('action' => 'edit', $flightDetail['FlightDetail']['id']), array('icon'=>'edit','title' => __('Click here to edit this Flight Detail'))); ?>
                         <?php echo $this->Html->link(__(''), array('action' => 'delete', $flightDetail['FlightDetail']['id']), array('icon'=>'delete','title' => __('Click here to delete this Flight Detail')), __('Are you sure you want to delete Flight Detail?')); ?>
                         <?php echo $this->Html->link(__(''), array('controller'=>'files','action' => 'receipt', $flightDetail['FlightDetail']['ac_id'],$flightDetail['FlightDetail']['invoice_no'].'.pdf'),
                                array(
                                    'icon' => 'fa-file',
                                    'target'=>'_blank',
                                    'class' => 'no-hover-text-decoration',
                                    'title' => __('View Receipt')
                                )); ?>                         
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