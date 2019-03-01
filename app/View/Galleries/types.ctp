<?php
$this->assign('pagetitle', __('Gallery Types'));
$this->Custom->addCrumb(__('Gallery Types'));
$this->start('top_links');
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
                    <th><?php echo $this->Paginator->sort('created'); ?></th>
                    <th><?php echo $this->Paginator->sort('updated'); ?></th>
                    <th class="actions text-center"><?php echo __('Actions'); ?></th>
                </tr>			
            </thead>		
            <tbody>
                <?php if(empty($gallerytypes)){?>
                    <tr>
                       <td colspan='7' class='text-warning'><?php echo __('No Gallery Types found.')?></td>
                   </tr>
                <?php }else{?>

                <?php foreach ($gallerytypes as $gallery): ?>
                   <tr>
                        <td><?php echo h($gallery['GalleryType']['title']); ?>&nbsp;</td>
                        <td><?php echo h($gallery['GalleryType']['created']); ?>&nbsp;</td>
                        <td><?php echo h($gallery['GalleryType']['updated']); ?>&nbsp;</td>
                        <td class="actions text-center">
                        <?php echo $this->Html->link(__(''), array('action' => 'editTypes', $gallery['GalleryType']['id']), array('icon'=>'edit','title' => __('Click here to edit this Gallery Type'))); ?>
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