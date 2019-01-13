<?php
	$this->assign('pagetitle', __('Train Details'));
	$this->Custom->addCrumb(__('Train Details'));
	$this->start('top_links');
		echo $this->Html->link(__('Add Train Detail'),array('action'=>'add'),array('icon'=>'fa-plus','title'=>__('Add Train Detail'),'class'=>'btn btn-primary','escape'=>false));
	$this->end();
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body row">
                <div class="col-md-12">
                    			<?php echo $this->Form->create('TrainDetail', array('autocomplete' => 'off', 'novalidate' => 'novalidate'));
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
</div>

<div class="box box-primary">           
    <div class="box-footer clearfix">
        <?php echo $this->element('paginationtop'); ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                                                                                                                                                                <th><?php echo $this->Paginator->sort('customer_id'); ?></th>
                                                                                                                        <th><?php echo $this->Paginator->sort('train_no'); ?></th>
                                                                                                                        <th><?php echo $this->Paginator->sort('pnr_no'); ?></th>
                                                                                                                        <th><?php echo $this->Paginator->sort('source'); ?></th>
                                                                                                                        <th><?php echo $this->Paginator->sort('destination'); ?></th>
                                                                                                                        <th><?php echo $this->Paginator->sort('created'); ?></th>
                                                                                        <th class="actions text-center"><?php echo __('Actions'); ?></th>
                </tr>			
            </thead>		
            <tbody>
                <?php if(empty($trainDetails)){?>
								<tr>
					<td colspan='6' class='text-warning'><?php echo __('No Train Detail found.')?></td>
								</tr>
<?php }else{?>

<?php foreach ($trainDetails as $trainDetail): ?>
	<tr>
		<td><?php echo h($trainDetail['Customer']['name']); ?>&nbsp;</td>
		<td><?php echo h($trainDetail['TrainDetail']['train_no']); ?>&nbsp;</td>
        <td><?php echo h($trainDetail['TrainDetail']['pnr_no']); ?>&nbsp;</td>
        <td><?php echo h($trainDetail['TrainDetail']['source']); ?>&nbsp;</td>
		<td><?php echo h($trainDetail['TrainDetail']['destination']); ?>&nbsp;</td>
		<td><?php echo h($trainDetail['TrainDetail']['created']); ?>&nbsp;</td>
		<td class="actions text-center">
			<?php echo $this->Html->link(__(''), array('action' => 'view', $trainDetail['TrainDetail']['id']), array('icon'=>'view','title' => __('Click here to view this Train Detail'))); ?>
			<?php echo $this->Html->link(__(''), array('action' => 'edit', $trainDetail['TrainDetail']['id']), array('icon'=>'edit','title' => __('Click here to edit this Train Detail'))); ?>
			<?php echo $this->Html->link(__(''), array('action' => 'delete', $trainDetail['TrainDetail']['id']), array('icon'=>'delete','title' => __('Click here to delete this Train Detail')), __('Are you sure you want to delete Train Detail?')); ?>
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