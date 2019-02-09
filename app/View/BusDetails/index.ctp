<?php
$this->assign('pagetitle', __('Bus Details'));
$this->Custom->addCrumb(__('Bus Details'));
$this->start('top_links');
echo $this->Html->link(__('Add Bus Detail'),array('action'=>'add'),array('icon'=>'fa-plus','title'=>__('Add Bus Detail'),'class'=>'btn btn-primary','escape'=>false));
$this->end();
?>
<!-- <div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body row">
                <div class="col-md-12">
                    <?php echo $this->Form->create('BusDetail', array('autocomplete' => 'off', 'novalidate' => 'novalidate'));?>
                    <label>&nbsp</label>
                    <div class="col-md-12 form-group">
                        <?php 
                            echo $this->Form->submit(__('Search'), array('class' => 'btn btn-primary margin-right10', 'div' => false));		
                            echo $this->Html->link(__('Reset Search'), array('action' => 'index', 'all'), array('title' => __('reset search'), 'class' => 'btn btn-default')); 
                        ?>
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
                    <th><?php echo $this->Paginator->sort('bus_no'); ?></th>
                    <th><?php echo $this->Paginator->sort('city_name'); ?></th>
                    <th><?php echo $this->Paginator->sort('price'); ?></th>
                    <th><?php echo $this->Paginator->sort('pnr_no'); ?></th>
                    <th><?php echo $this->Paginator->sort('Source'); ?></th>
                    <th><?php echo $this->Paginator->sort('Destination'); ?></th>
                    <th><?php echo $this->Paginator->sort('created'); ?></th>
                    <th class="actions text-center"><?php echo __('Actions'); ?></th>
                </tr>			
            </thead>		
            <tbody>
                <?php if(empty($busDetails)){?>
                    <tr>
                       <td colspan='8' class='text-warning'><?php echo __('No Bus Detail found.')?></td>
                   </tr>
               <?php }else{?>

                <?php foreach ($busDetails as $busDetail): ?>
                   <tr>
                    <td><?php echo h($busDetail['Customer']['name']); ?>&nbsp;</td>
                    <td><?php echo h($busDetail['BusDetail']['company_name']); ?>&nbsp;</td>
                    <td><?php echo h($busDetail['BusDetail']['bus_no']); ?>&nbsp;</td>
                    <td><?php echo h($busDetail['BusDetail']['city_name']); ?>&nbsp;</td>
                    <td><?php echo h($busDetail['BusDetail']['price']); ?>&nbsp;</td>
                    <td><?php echo h($busDetail['BusDetail']['pnr_no']); ?>&nbsp;</td>
                    <td><?php echo h($busDetail['BusDetail']['source']); ?>&nbsp;</td>
                    <td><?php echo h($busDetail['BusDetail']['destination']); ?>&nbsp;</td>
                    <td><?php echo h($busDetail['BusDetail']['created']); ?>&nbsp;</td>
                    <td class="actions text-center">
                     <?php echo $this->Html->link(__(''), array('action' => 'view', $busDetail['BusDetail']['id']), array('icon'=>'view','title' => __('Click here to view this Bus Detail'))); ?>
                     <?php echo $this->Html->link(__(''), array('action' => 'edit', $busDetail['BusDetail']['id']), array('icon'=>'edit','title' => __('Click here to edit this Bus Detail'))); ?>
                     <?php echo $this->Html->link(__(''), array('action' => 'delete', $busDetail['BusDetail']['id']), array('icon'=>'delete','title' => __('Click here to delete this Bus Detail')), __('Are you sure you want to delete Bus Detail?')); ?>
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