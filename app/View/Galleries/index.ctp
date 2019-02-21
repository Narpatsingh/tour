<?php
$this->assign('pagetitle', __('Galleries'));
$this->Custom->addCrumb(__('Galleries'));
$this->start('top_links');
echo $this->Html->link(__('Add Gallery'),array('action'=>'add'),array('icon'=>'fa-plus','title'=>__('Add Gallery'),'class'=>'btn btn-primary','escape'=>false));
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
                    <th><?php echo $this->Paginator->sort('title'); ?></th>
                    <th><?php echo $this->Paginator->sort('photo'); ?></th>
                    <th><?php echo $this->Paginator->sort('description'); ?></th>
                    <th><?php echo $this->Paginator->sort('created'); ?></th>
                    <th><?php echo $this->Paginator->sort('updated'); ?></th>
                    <th class="actions text-center"><?php echo __('Actions'); ?></th>
                </tr>			
            </thead>		
            <tbody>
                <?php if(empty($galleries)){?>
                    <tr>
                       <td colspan='7' class='text-warning'><?php echo __('No Gallery found.')?></td>
                   </tr>
                <?php }else{?>

                <?php foreach ($galleries as $gallery): ?>
                   <tr>
                      <td><?php echo h($gallery['Gallery']['title']); ?>&nbsp;</td>
                      <td class="photo" style='width: 150px;height: 100px;'><?php echo $this->Html->image(GALLERY_IMAGE.$gallery['Gallery']['id'].'/'.$gallery['Gallery']['photo'])?></td>
                      <td><?php echo h($gallery['Gallery']['description']); ?>&nbsp;</td>
                      <td><?php echo h($gallery['Gallery']['created']); ?>&nbsp;</td>
                      <td><?php echo h($gallery['Gallery']['updated']); ?>&nbsp;</td>
                      <td class="actions text-center">
                         <?php //echo $this->Html->link(__(''), array('action' => 'view', $gallery['Gallery']['id']), array('icon'=>'view','title' => __('Click here to view this Gallery'))); ?>
                         <?php echo $this->Html->link(__(''), array('action' => 'edit', $gallery['Gallery']['id']), array('icon'=>'edit','title' => __('Click here to edit this Gallery'))); ?>
                         <?php echo $this->Html->link(__(''), array('action' => 'delete', $gallery['Gallery']['id']), array('icon'=>'delete','title' => __('Click here to delete this Gallery')), __('Are you sure you want to delete Gallery?')); ?>
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