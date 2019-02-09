<?php
$this->assign('pagetitle', __('Car Details'));
$this->Custom->addCrumb(__('Car Details'));
$this->start('top_links');
echo $this->Html->link(__('Add Car Detail'),array('action'=>'add'),array('icon'=>'fa-plus','title'=>__('Add Car Detail'),'class'=>'btn btn-primary','escape'=>false));
$this->end();
?>
<!-- <div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body row">
                <div class="col-md-12">
                    <?php 
                    echo $this->Form->create('CarDetail', array('autocomplete' => 'off', 'novalidate' => 'novalidate'));
                    ?>
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
                    <th><?php echo $this->Paginator->sort('car_no'); ?></th>
                    <th><?php echo $this->Paginator->sort('pnr_no'); ?></th>
                    <th><?php echo $this->Paginator->sort('price'); ?></th>
                    <th><?php echo $this->Paginator->sort('source'); ?></th>
                    <th><?php echo $this->Paginator->sort('destination'); ?></th>
                    <th><?php echo $this->Paginator->sort('created'); ?></th>
                    <th class="actions text-center"><?php echo __('Actions'); ?></th>
                </tr>			
            </thead>		
            <tbody>
                <?php if(empty($carDetails)){?>
                    <tr>
                       <td colspan='10' class='text-warning'><?php echo __('No Car Detail found.')?></td>
                   </tr>
                <?php }else{?>

                <?php foreach ($carDetails as $carDetail): ?>
                    <tr>
                      <td><?php echo h($carDetail['CarDetail']['customer_id']); ?>&nbsp;</td>
                      <td><?php echo h($carDetail['CarDetail']['company_name']); ?>&nbsp;</td>
                      <td><?php echo h($carDetail['CarDetail']['car_no']); ?>&nbsp;</td>
                      <td><?php echo h($carDetail['CarDetail']['pnr_no']); ?>&nbsp;</td>
                      <td><?php echo h($carDetail['CarDetail']['price']); ?>&nbsp;</td>
                      <td><?php echo h($carDetail['CarDetail']['source']); ?>&nbsp;</td>
                      <td><?php echo h($carDetail['CarDetail']['destination']); ?>&nbsp;</td>
                      <td><?php echo h($carDetail['CarDetail']['created']); ?>&nbsp;</td>
                      <td class="actions text-center">
                         <?php echo $this->Html->link(__(''), array('action' => 'view', $carDetail['CarDetail']['id']), array('icon'=>'view','title' => __('Click here to view this Car Detail'))); ?>
                         <?php echo $this->Html->link(__(''), array('action' => 'edit', $carDetail['CarDetail']['id']), array('icon'=>'edit','title' => __('Click here to edit this Car Detail'))); ?>
                         <?php echo $this->Html->link(__(''), array('action' => 'delete', $carDetail['CarDetail']['id']), array('icon'=>'delete','title' => __('Click here to delete this Car Detail')), __('Are you sure you want to delete Car Detail?')); ?>
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