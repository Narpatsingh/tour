<?php
$this->assign('pagetitle', __('Places'));
$this->Custom->addCrumb(__('Places'));
$this->start('top_links');
echo $this->Html->link(__('Add Place'),array('action'=>'add'),array('icon'=>'fa-plus','title'=>__('Add Place'),'class'=>'btn btn-primary','escape'=>false));
$this->end();
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body row">
                <div class="col-md-12">
                 <?php echo $this->Form->create('Place', array('autocomplete' => 'off', 'novalidate' => 'novalidate'));
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
                    <th><?php echo $this->Paginator->sort('city_id'); ?></th>
                    <th><?php echo $this->Paginator->sort('state_id'); ?></th>
                    <th><?php echo $this->Paginator->sort('photo'); ?></th>
                    <th><?php echo $this->Paginator->sort('name'); ?></th>
                    <th><?php echo $this->Paginator->sort('created'); ?></th>
                    <th><?php echo $this->Paginator->sort('updated'); ?></th>
                    <th class="actions text-center"><?php echo __('Actions'); ?></th>
                </tr>			
            </thead>		
            <tbody>
                <?php if(empty($places)){?>
                    <tr>
                       <td colspan='8' class='text-warning'><?php echo __('No Place found.')?></td>
                   </tr>
               <?php }else{?>

                <?php foreach ($places as $place): ?>
                   <tr>
                      <td><?php echo h($place['City']['name']); ?>&nbsp;</td>
                      <td><?php echo h($place['State']['name']); ?>&nbsp;</td>
                      
                      <td class="photo" style='width: 150px;height: 100px;'><?php echo $this->Html->image(PLACE_IMAGE.$place['Place']['id'].'/'.$place['Place']['photo'])?></td>
                      <td><?php echo h($place['Place']['name']); ?>&nbsp;</td>
                      <td><?php echo h($place['Place']['created']); ?>&nbsp;</td>
                      <td><?php echo h($place['Place']['updated']); ?>&nbsp;</td>
                      <td class="actions text-center">
                         <?php echo $this->Html->link(__(''), array('action' => 'view', $place['Place']['id']), array('icon'=>'view','title' => __('Click here to view this Place'))); ?>
                         <?php echo $this->Html->link(__(''), array('action' => 'edit', $place['Place']['id']), array('icon'=>'edit','title' => __('Click here to edit this Place'))); ?>
                         <?php echo $this->Html->link(__(''), array('action' => 'delete', $place['Place']['id']), array('icon'=>'delete','title' => __('Click here to delete this Place')), __('Are you sure you want to delete Place?')); ?>
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