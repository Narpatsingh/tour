<?php
$this->assign('pagetitle', __('Sliders'));
$this->Custom->addCrumb(__('Sliders'));
$this->start('top_links');
//echo $this->Html->link(__('Add Slider'),array('action'=>'add'),array('icon'=>'fa-plus','title'=>__('Add Slider'),'class'=>'btn btn-primary','escape'=>false));
$this->end();
?>
<div class="box box-primary">           
    <div class="box-footer clearfix">
        <?php echo $this->element('paginationtop'); ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th><?php echo $this->Paginator->sort('tour_id'); ?></th>
                    <th><?php echo $this->Paginator->sort('title'); ?></th>
                    <th><?php echo $this->Paginator->sort('created'); ?></th>
                    <th><?php echo $this->Paginator->sort('updated'); ?></th>
                    <th class="actions text-center"><?php echo __('Actions'); ?></th>
                </tr>			
            </thead>		
            <tbody>
                <?php if(empty($sliders)){?>
                    <tr>
                       <td colspan='6' class='text-warning'><?php echo __('No Slider found.')?></td>
                   </tr>
               <?php }else{?>

                <?php foreach ($sliders as $slider): ?>
                   <tr>
                      <td><?php echo h($slider['Tour']['name']); ?>&nbsp;</td>
                      <td><?php echo h($slider['Slider']['title']); ?>&nbsp;</td>
                      <td><?php echo h($slider['Slider']['created']); ?>&nbsp;</td>
                      <td><?php echo h($slider['Slider']['updated']); ?>&nbsp;</td>
                      <td class="actions text-center">
                         <?php echo $this->Html->link(__(''), array('action' => 'view', $slider['Slider']['id']), array('icon'=>'view','title' => __('Click here to view this Slider'))); ?>
                         <?php echo $this->Html->link(__(''), array('action' => 'edit', $slider['Slider']['id']), array('icon'=>'edit','title' => __('Click here to edit this Slider'))); ?>
                         <?php //echo $this->Html->link(__(''), array('action' => 'delete', $slider['Slider']['id']), array('icon'=>'delete','title' => __('Click here to delete this Slider')), __('Are you sure you want to delete Slider?')); ?>
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