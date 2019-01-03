<?php

$this->assign('pagetitle', __('Reports'));
$this->Custom->addCrumb(__('Reports'));
$this->start('top_links');
echo $this->Html->link(__('Add Report'), array('action' => 'add'), array('icon' => 'fa-plus', 'title' => __('Add Report'), 'class' => 'btn btn-primary', 'escape' => false));
$this->end();

?>
<?php echo $this->element("backend/search",array('model'=>'Report'));?>

<div class="box box-primary">
    <div class="box-footer clearfix">
        <?php echo $this->element('paginationtop'); ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <table class="table table-hover table-bordered">
            <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('user_id'); ?></th>
                <th><?php echo $this->Paginator->sort('name'); ?></th>
                <th><?php echo $this->Paginator->sort('created',_('Added On')); ?></th>
                <th><?php echo $this->Paginator->sort('updated',__('Updated On')); ?></th>
                <th class="actions text-center"><?php echo __('Actions'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php if (empty($reports)) { ?>
                <tr>
                    <td colspan='6' class='text-warning'><?php echo __('No Report found.') ?></td>
                </tr>
            <?php } else { ?>

                <?php foreach ($reports as $report): ?>
                    <tr>
                        <td>
                            <?php echo $this->Html->link($report['User']['name'], array('controller' => 'users', 'action' => 'view', $report['User']['id'])); ?>
                        </td>
                        <td><?php echo h($report['Report']['name']); ?>&nbsp;</td>
                        <td><?php echo showdatetime($report['Report']['created']); ?>&nbsp;</td>
                        <td><?php echo showdatetime($report['Report']['updated']); ?>&nbsp;</td>
                        <td class="actions text-center">
                            <?php echo $this->Html->link(__(''), array('action' => 'download', $report['Report']['id']), array('icon' => 'fa-download', 'title' => __('Click here to download this Report'))); ?>
                            <?php echo $this->Html->link(__(''), array('action' => 'delete', $report['Report']['id']), array('icon' => 'delete', 'title' => __('Click here to delete this Report')), __('Are you sure you want to delete Report?')); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="box-footer clearfix">
        <?php echo $this->element('pagination'); ?>
    </div>
</div>