<?php
$this->assign('pagetitle', __('Hotels'));
$this->Custom->addCrumb(__('Hotels'));
$this->start('top_links');
echo $this->Html->link(__('Add Hotel'),array('action'=>'add'),array('icon'=>'fa-plus','title'=>__('Add Hotel'),'class'=>'btn btn-primary','escape'=>false));
$this->end();
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body row">
                <div class="col-md-12">
                 <?php echo $this->Form->create('Hotel', array('autocomplete' => 'off', 'novalidate' => 'novalidate'));
                 echo $this->Form->input('name', array('label' => __('Name'), 'placeholder' => __('name'), 'required' => false, 'class' => 'form-control', 'div' => array('class' => 'col-md-3')));
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
                    <th><?php echo $this->Paginator->sort('name'); ?></th>
                    <th><?php echo $this->Paginator->sort('price'); ?></th>
                    <th><?php echo $this->Paginator->sort('address'); ?></th>
                    <th><?php echo $this->Paginator->sort('photo'); ?></th>
                    <th><?php echo $this->Paginator->sort('type'); ?></th>
                    <th><?php echo $this->Paginator->sort('meal_plan'); ?></th>
                    <th><?php echo $this->Paginator->sort('created'); ?></th>
                    <th class="actions text-center"><?php echo __('Actions'); ?></th>
                </tr>			
            </thead>		
            <tbody>
                <?php if(empty($hotels)){?>
                    <tr>
                       <td colspan='9' class='text-warning'><?php echo __('No Hotel found.')?></td>
                   </tr>
               <?php }else{?>

                <?php foreach ($hotels as $hotel): ?>
                   <tr>
                      <td><?php echo h($hotel['Hotel']['name']); ?>&nbsp;</td>
                      <td><?php echo h($hotel['Hotel']['price']); ?>&nbsp;</td>
                      <td><?php echo h($hotel['Hotel']['address']); ?>&nbsp;</td>
                      <td class="photo" style='width: 150px;height: 100px;'><?php echo $this->Html->image('../'.$hotel['Hotel']['photo'])?></td>
                      <td><?php echo h($hotel['Hotel']['type']." Star"); ?>&nbsp;</td>
                      <td><?php echo h($hotel['Hotel']['meal_plan']); ?>&nbsp;</td>
                      <td><?php echo h($hotel['Hotel']['created']); ?>&nbsp;</td>
                      <td class="actions text-center">
                         <?php echo $this->Html->link(__(''), array('action' => 'view', $hotel['Hotel']['id']), array('icon'=>'view','title' => __('Click here to view this Hotel'))); ?>
                         <?php echo $this->Html->link(__(''), array('action' => 'edit', $hotel['Hotel']['id']), array('icon'=>'edit','title' => __('Click here to edit this Hotel'))); ?>
                         <?php echo $this->Html->link(__(''), array('action' => 'delete', $hotel['Hotel']['id']), array('icon'=>'delete','title' => __('Click here to delete this Hotel')), __('Are you sure you want to delete Hotel?')); ?>
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